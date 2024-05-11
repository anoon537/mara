<?php

namespace App\Http\Controllers;

use App\Models\PhotoPackage;
use App\Models\Booking;
use App\Models\Galery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class PhotoPackageController extends Controller
{
    public function index()
    {
        $title = 'Photo Packages';
        $photoPackages = PhotoPackage::all();
        return view('admin.photo_packages.index', compact('photoPackages', 'title'));
    }

    public function create()
    {
        $title = 'Add New Photo Package';
        return view('admin.photo_packages.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string', // Ubah jika menerima daftar
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('photo_packages', 'public');
        }
        $description = $request->input('description');

        // Jika deskripsi dikirim sebagai daftar, ubah ke JSON
        if (is_array($description)) {
            $description = json_encode($description);
        }


        PhotoPackage::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $description, // Simpan dalam format JSON
            'image_url' => $imagePath ? Storage::url($imagePath) : null,
        ]);

        return redirect()->route('photo_packages.index')->with('success', 'Photo Package created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0|max:99999999',
            'description' => 'nullable|string', // Ubah jika menerima daftar
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $photoPackage = PhotoPackage::findOrFail($id);
        if ($request->hasFile('image')) {
            if ($photoPackage->image_url) {
                Storage::delete('public/' . $photoPackage->image_url);
            }

            $imagePath = $request->file('image')->store('photo_packages', 'public');
            $photoPackage->image_url = Storage::url($imagePath);
        }

        $description = $request->input('description');

        if (is_array($description)) {
            $description = json_encode($description);
        }

        $photoPackage->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $description, // Simpan dalam format JSON
            'image_url' => $photoPackage->image_url,
        ]);

        return redirect()->route('photo_packages.index')->with('success', 'Photo Package updated successfully.');
    }

    public function edit($id)
    {
        $title = 'Edit Photo Package';
        $photoPackage = PhotoPackage::findOrFail($id);
        return view('admin.photo_packages.edit', compact('photoPackage', 'title'));
    }

    public function destroy($id)
    {
        $photoPackage = PhotoPackage::findOrFail($id);
        $photoPackage->delete();

        return redirect()->route('photo_packages.index')->with('success', 'Photo Package deleted successfully.');
    }

    public function show($id)
    {
        $user = Auth::user();
        $package = PhotoPackage::findOrFail($id);
        // Temukan existing bookings yang belum selesai
        $existingBookings = Booking::where('photo_package_id', $package->id)
            ->where('status', '!=', 'completed')
            ->pluck('booking_time')
            ->toArray();

        // Konversi deskripsi ke array
        $descriptionString = $package->description;
        $descriptionArray = preg_split('/\r?\n/', $descriptionString); // Pisahkan berdasarkan newline

        return view('home.detail', compact('package', 'existingBookings', 'descriptionArray', 'user'));
    }
}
