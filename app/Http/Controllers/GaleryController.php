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
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Simpan judul galeri dari form
        $title = $request->title;

        // Iterasi semua file gambar yang diunggah
        foreach ($request->file('images') as $image) {
            // Simpan setiap gambar ke dalam penyimpanan
            $imagePath = $image->store('gallery/' . $title, 'public');

            // Simpan informasi galeri ke dalam database
            Galery::create([
                'title' => $title,
                'image_url' => $imagePath,
            ]);
        }

        return redirect()->route('admin.galery')->with('success', 'Gallery items added successfully.');
    }

    public function edit($id)
    {
        $title = 'Edit Galery Item';
        $galeryItem = Galery::findOrFail($id);

        return view('admin.galery.edit', compact('galeryItem', 'title'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'title' => 'required|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Temukan item galeri yang akan diperbarui
        $galeryItem = Galery::findOrFail($id);

        // Jika ada file gambar baru yang diunggah
        if ($request->hasFile('images')) {
            // Hapus gambar lama dari penyimpanan
            $existingImages = Galery::where('title', $galeryItem->title)->get();
            foreach ($existingImages as $image) {
                // Convert the URL to a relative path
                $oldImagePath = str_replace('/storage/', '', $image->image_url);
                Storage::disk('public')->delete($oldImagePath);
                $image->delete();
            }

            // Iterasi semua file gambar yang diunggah
            foreach ($request->file('images') as $image) {
                // Simpan setiap gambar baru ke dalam penyimpanan
                $imagePath = $image->store('gallery/' . $request->title, 'public');

                // Simpan informasi galeri ke dalam database
                Galery::create([
                    'title' => $request->title,
                    'image_url' => Storage::url($imagePath),
                ]);
            }
        }

        // Perbarui judul item galeri
        $galeryItem->title = $request->input('title');
        $galeryItem->save();

        return redirect()->route('admin.galery')->with('success', 'Gallery item updated successfully.');
    }


    public function destroy($id)
    {
        $galeryItem = Galery::findOrFail($id);
        Storage::delete('public/' . $galeryItem->image_url);
        $galeryItem->delete();

        return redirect()->route('admin.galery')->with('success', 'Galery item deleted successfully.');
    }
}
