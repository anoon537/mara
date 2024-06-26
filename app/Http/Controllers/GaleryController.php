<?php

namespace App\Http\Controllers;

use App\Models\Galery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class GaleryController extends Controller
{
    public function index()
    {
        $title = 'Gallery';
        $galeryItems = Galery::all();

        return view('admin.galery.index', compact('galeryItems', 'title'));
    }

    public function create()
    {
        $title = 'Add New Gallery Item';
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
        $title = 'Edit Gallery Item';
        $galeryItem = Galery::findOrFail($id);

        return view('admin.galery.edit', compact('galeryItem', 'title'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'title' => 'required|string|max:255',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Temukan item galeri yang akan diperbarui
        $galeryItem = Galery::findOrFail($id);

        // Jika ada file gambar baru yang diunggah
        if ($request->hasFile('images')) {
            // Hapus gambar lama dari penyimpanan
            if ($galeryItem->image_url) {
                $oldImagePath = str_replace('storage/', '', $galeryItem->image_url);
                Storage::disk('public')->delete($oldImagePath);
            }

            // Simpan gambar baru ke dalam penyimpanan
            $imagePath = $request->file('images')->store('gallery/' . $request->title, 'public');
            $galeryItem->image_url = $imagePath;
        }

        // Perbarui judul item galeri
        $galeryItem->title = $request->input('title');
        $galeryItem->save();

        return redirect()->route('admin.galery')->with('success', 'Item galeri berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $galeryItem = Galery::findOrFail($id);
        Storage::delete('public/' . $galeryItem->image_url);
        $galeryItem->delete();

        return redirect()->route('admin.galery')->with('success', 'Galery item deleted successfully.');
    }
}
