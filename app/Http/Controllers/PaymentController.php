<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Booking;
use App\Models\PhotoPackage;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create($booking_id)
    {
        $booking = Booking::findOrFail($booking_id);
        return view('home.payment.create', compact('booking'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $booking = Booking::findOrFail($validatedData['booking_id']);
        $total_price = $booking->price;
        $payment = new Payment();
        $payment->booking_id = $validatedData['booking_id'];
        $payment->payment_proof = $validatedData['payment_proof']->store('payment_proofs', 'public');
        $payment->price = $total_price;
        $payment->save();

        return redirect()->route('payment.history')->with('success', 'Payment received');
    }

    public function history()
    {
        $user = Auth::user();
        $payments = Payment::whereHas('booking', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('booking.photo_package')->get();

        return view('home.payment.history', compact('payments'));
    }
}
