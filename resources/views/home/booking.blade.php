@extends('layouts.app1') <!-- Menggunakan layout utama -->

@section('title')
    Booking Paket Foto
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
        @include('layouts.navbar')
    </nav>
    <!-- Navbar End -->

    <!-- Header Start -->
    <div class="container-fluid hero-header bg-light py-5 my-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <!-- Rute ke halaman utama -->
                            <li class="breadcrumb-item">
                                <a href="{{ route('homepage') }}">Home</a>
                            </li>
                            <!-- Rute ke daftar paket foto -->
                            <li class="breadcrumb-item">
                                <a href="{{ route('produk') }}">Photo Packages</a>
                            </li>
                            <!-- Nama paket foto spesifik -->
                            <li class="breadcrumb-item active" aria-current="page">{{ $package->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
    <div class="container my-5"> <!-- Kontainer utama untuk formulir booking -->
        <h2>Booking Paket Foto</h2> <!-- Judul halaman -->

        <!-- Formulir booking -->
        <form action="{{ route('home.booking.store') }}" method="POST"> <!-- Menggunakan metode POST -->
            @csrf <!-- Token CSRF untuk keamanan -->

            <!-- Paket Foto yang dipesan -->
            <div class="mb-3">
                <label for="photo_package" class="form-label">Paket Foto</label> <!-- Label untuk paket foto -->
                <input type="text" id="photo_package" class="form-control" value="{{ $package->name }}" readonly>
                <!-- Nama paket foto, hanya bisa dibaca -->
            </div>

            <!-- Tanggal Booking -->
            <div class="mb-3">
                <label for="booking_date" class="form-label">Tanggal Booking</label> <!-- Label untuk tanggal booking -->
                <input type="date" id="booking_date" name="booking_date" class="form-control" required>
                <!-- Input untuk memilih tanggal -->
            </div>

            <!-- Waktu Booking -->
            <div class="mb-3">
                <label for="booking_time" class="form-label">Waktu Booking</label> <!-- Label untuk waktu booking -->
                <select id="booking_time" name="booking_time" class="form-control" required> <!-- Pilihan waktu -->
                    <option value="09:00">09:00 - 10:00</option>
                    <option value="10:00">10:00 - 11:00</option>
                    <option value="11:00">11:00 - 12:00</option>
                    <option value="12:00">12:00 - 13:00</option>
                    <option value="13:00">13:00 - 14:00</option>
                    <option value="14:00">14:00 - 15:00</option>
                    <option value="15:00">15:00 - 16:00</option>
                    <option value="16:00">16:00 - 17:00</option>
                    <option value="17:00">17:00 - 18:00</option>
                    <option value="18:00">18:00 - 19:00</option>
                </select>
            </div>

            <!-- Tombol Booking -->
            <button type="submit" class="btn btn-primary">Book Now</button> <!-- Tombol untuk mengirim formulir -->
        </form>
    </div>
@endsection
