@extends('layouts.app1')

@section('title')
    Unggah Bukti Pembayaran
@endsection

@section('content')
    <div class="container my-5"> <!-- Kontainer untuk formulir unggah bukti -->
        <h2>Unggah Bukti Pembayaran</h2> <!-- Judul halaman -->

        <!-- Formulir unggah bukti pembayaran -->
        <form action="{{ route('payment.store') }}" method="POST" enctype="multipart/form-data">
            <!-- Pastikan rute dan metode benar -->
            @csrf
            <!-- Input untuk file bukti pembayaran -->
            <input type="hidden" name="booking_id" value="{{ $booking->id }}"> <!-- Pastikan booking_id dikirim -->
            <input type="file" name="payment_proof" required> <!-- Unggah bukti pembayaran -->
            <button type="submit">Upload</button> <!-- Tombol untuk mengirim -->
        </form>

    </div>
@endsection
