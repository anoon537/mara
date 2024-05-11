@extends('layouts.app1')

@section('title', 'Booking Success')

@section('content')
    <div class="container my-5">
        <h2>Booking Successful!</h2> <!-- Pesan sukses -->
        <p>Thank you for booking with us. Your booking has been confirmed.</p> <!-- Detail tambahan -->
        <a href="{{ route('homepage') }}" class="btn btn-primary">Back to Home</a> <!-- Tautan kembali ke home -->
    </div>
@endsection
