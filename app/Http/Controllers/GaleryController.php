<?php

namespace App\Http\Controllers;

use App\Models\Galery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class GaleryController extends Controller
{
    public function index()
    {
        $title = 'Galery';
        $galeryItems = Galery::all();

        return view('admin.galery.index', compact('galeryItems', 'title'));
    }

    public function create()
    {
        $title = 'Add New Galery Item';
        return view('admin.galery.create', compact('title'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('galery', 'public');

        Galery::create([
            'title' => $request->input('title'),
            'image_url' => $imagePath,
        ]);

        return redirect()->route('admin.galery')->with('success', 'Galery item created successfully.');
    }

    public function edit($id)
    {
        $title = 'Edit Galery Item';
        $galeryItem = Galery::findOrFail($id);

        return view('admin.galery.edit', compact('galeryItem', 'title'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $galeryItem = Galery::findOrFail($id);

        if ($request->hasFile('image')) {
            Storage::delete('public/' . $galeryItem->image_url);

            $imagePath = $request->file('image')->store('galery', 'public');
            $galeryItem->image_url = $imagePath;
        }

        $galeryItem->update([
            'title' => $request->input('title'),
            'image_url' => $galeryItem->image_url,
        ]);

        return redirect()->route('admin.galery')->with('success', 'Galery item updated successfully.');
    }

    public function destroy($id)
    {
        $galeryItem = Galery::findOrFail($id);
        Storage::delete('public/' . $galeryItem->image_url);
        $galeryItem->delete();

        return redirect()->route('admin.galery')->with('success', 'Galery item deleted successfully.');
    }
}
