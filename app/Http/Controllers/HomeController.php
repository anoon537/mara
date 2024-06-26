<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\PhotoPackage;
use App\Models\Galery;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;

class HomeController extends Controller
{
    public function index()
    {
        $photoPackages = PhotoPackage::all();

        return view('home.homepage', compact('photoPackages'));
    }

    // PHOTO PACKAGE
    public function showPhotoPackages()
    {
        $photoPackages = PhotoPackage::all();

        return view('home.produk', compact('photoPackages'));
    }

    // GALERY
    public function showGalery()
    {
        // Mengelompokkan item galeri berdasarkan judul
        $galeryByTitle = Galery::all()->groupBy(function ($item) {
            return substr($item->title, 0, 1); // Mengelompokkan berdasarkan huruf pertama judul
        });

        return view('home.galery', compact('galeryByTitle'));
    }

    // ABOUT
    public function about()
    {
        return view('home.about');
    }

    // CONTACT
    public function contact()
    {
        return view('home.contact');
    }

    // GALERY
    public function galery()
    {
        return view('home.galery');
    }

    public function terms()
    {
        return view('home.terms');
    }

    public function howShop()
    {
        return view('home.how-shop');
    }

    public function sendContactMessage(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        // Kirim email notifikasi
        Mail::to(config('mail.from.address'))->send(new ContactMessage($validatedData));

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
