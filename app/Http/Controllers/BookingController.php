<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\PhotoPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function generateBookingId($booking_date)
    {
        $formattedDate = \Carbon\Carbon::parse($booking_date)->format('Ymd');
        $countOnDate = Booking::whereDate('booking_date', $booking_date)->count();
        $nextNumber = $countOnDate + 1;
        $bookingId = $formattedDate . str_pad($nextNumber, 2, '0', STR_PAD_LEFT); // Misalnya 2024050402

        return $bookingId;
    }

    public function create($package_id)
    {
        $package = PhotoPackage::findOrFail($package_id);
        $existingBookings = Booking::where('photo_package_id', $package_id)
            ->where('status', '!=', 'completed')
            ->get();
        $bookedTimes = $existingBookings->pluck('booking_time')->toArray();

        return view('home.booking.create', compact('package', 'bookedTimes'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'package_id' => 'required|exists:photo_packages,id',
            'booking_date' => 'required|date',
            'booking_time' => 'required|date_format:H:i',
            'additional_people' => 'required|integer|min:0', // Validasi jumlah orang tambahan
        ]);

        $existingBooking = Booking::where('photo_package_id', $validatedData['package_id'])
            ->where('booking_date', $validatedData['booking_date'])
            ->where('booking_time', $validatedData['booking_time'])
            ->exists();

        if ($existingBooking) {
            return back()->withErrors(['booking_time' => 'Slot waktu ini sudah dipesan. Silakan pilih waktu lain.']);
        }

        $package = PhotoPackage::findOrFail($validatedData['package_id']);
        $original_price = $package->price; // Periksa harga asli
        $additional_people = $validatedData['additional_people']; // Jumlah orang tambahan
        $additional_price_per_person = 15000; // Harga tambahan per orang
        $additional_cost = $additional_people * $additional_price_per_person; // Hitung biaya tambahan
        $price = $original_price + $additional_cost; // Tambahkan biaya tambahan ke harga asli
        $booking = new Booking();
        $booking->id = $this->generateBookingId($validatedData['booking_date']); // ID booking
        $booking->user_id = Auth::id();
        $booking->photo_package_id = $package->id;
        $booking->booking_date = $validatedData['booking_date'];
        $booking->booking_time = $validatedData['booking_time'];
        $booking->additional_people = $additional_people; // Simpan jumlah orang tambahan

        // Periksa harga yang dihitung
        dump("Original Price: $original_price");
        dump("Additional Cost: $additional_cost");
        dump("Total Price: $price");

        $booking->price = $price; // Harga total
        $booking->status = 'pending';
        $booking->save();
        return redirect()->route('booking.confirmation', ['booking_id' => $booking->id]);
    }


    public function confirmation($booking_id)
    {
        $booking = Booking::findOrFail($booking_id);
        $package = PhotoPackage::findOrFail($booking->photo_package_id);
        $booking->save();

        $booking_date = $booking->booking_date;
        $booking_time = $booking->booking_time;

        return view('home.booking.confirmation', compact('booking', 'package', 'booking_date', 'booking_time'));
    }
}
