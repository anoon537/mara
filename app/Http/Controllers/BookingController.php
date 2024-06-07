<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\PhotoPackage;
use App\Models\DirectOrder;
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
            'additional_people' => 'required|integer|min:0', // Validate additional people
        ]);

        $existingBooking = Booking::where('photo_package_id', $validatedData['package_id'])
            ->where('booking_date', $validatedData['booking_date'])
            ->where('booking_time', $validatedData['booking_time'])
            ->exists();

        $existingDirectOrder = DirectOrder::where('booking_date', $validatedData['booking_date'])
            ->where('booking_time', $validatedData['booking_time'])
            ->exists();

        if ($existingBooking || $existingDirectOrder) {
            return redirect()->back()->withErrors(['booking_time' => 'The selected time slot is already booked.']);
        }

        $package = PhotoPackage::findOrFail($validatedData['package_id']);
        $original_price = $package->price; // Check the original price
        $additional_people = $validatedData['additional_people']; // Number of additional people
        $additional_price_per_person = 15000; // Additional cost per person
        $additional_cost = $additional_people * $additional_price_per_person; // Calculate additional cost
        $price = $original_price + $additional_cost; // Add additional cost to original price

        $booking = new Booking();
        $booking->id = $this->generateBookingId($validatedData['booking_date']); // Booking ID
        $booking->user_id = Auth::id();
        $booking->photo_package_id = $package->id;
        $booking->booking_date = $validatedData['booking_date'];
        $booking->booking_time = $validatedData['booking_time'];
        $booking->additional_people = $additional_people; // Save the number of additional people
        $booking->price = $price; // Total price
        $booking->status = 'waiting for confirmation';
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
