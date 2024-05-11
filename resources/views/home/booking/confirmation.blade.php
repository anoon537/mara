@extends('layouts.app1')

@section('title')
    Konfirmasi Booking
@endsection

@section('content')
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow" role="status"></div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light fixed-top shadow py-lg-0 px-4 px-lg-5 wow fadeIn"
        data-wow-delay="0.1s">
        @include('layouts.navbar') <!-- Navbar -->
    </nav>
    <!-- Navbar End -->

    <!-- Detail Paket Foto -->
    <div class="container mt-5 pt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('homepage') }}">Home</a> <!-- Link ke homepage -->
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('produk') }}">Photo Packages</a> <!-- Link ke daftar paket foto -->
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $package->name }}</li> <!-- Nama paket -->
            </ol>
        </nav>
        <div class="container my-5">
            <h2>Konfirmasi Booking</h2>

            <p>Booking Anda untuk paket "{{ $package->name }}" pada {{ $booking_date }} jam {{ $booking_time }} berhasil.
            </p>
            <p>Jumlah Orang Tambahan: {{ $booking->additional_people }}</p>
            <p>Harga total: Rp {{ number_format($booking->price, 0, ',', '.') }}</p>

            <!-- Instruksi pembayaran -->
            <p>Silakan transfer pembayaran ke rekening berikut:</p>
            <ul>
                <li>Bank: BCA</li>
                <li>Nomor Rekening: 123-456-789</li>
                <li>Atas Nama: John Doe</li>
            </ul>

            <p>Setelah melakukan pembayaran, silakan unggah bukti pembayaran dengan formulir di bawah ini:</p>

            <!-- Formulir untuk unggah bukti pembayaran -->
            <form action="{{ route('payment.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="booking_id" value="{{ $booking->id }}"> <!-- Pastikan booking_id disertakan -->

                <div class="mb-3">
                    <label for="payment_proof" class="form-label">Upload</label>
                    <input type="file" name="payment_proof" id="payment_proof" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Unggah Bukti Pembayaran</button>
                <!-- Tombol untuk mengirim -->
            </form>

        </div>
    </div>
@endsection
