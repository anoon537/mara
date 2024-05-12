@extends('layouts.app1') <!-- Layout utama -->
@section('title')
    {{ $package->name }} - Photo Package
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

    <!-- Detail Paket Foto -->
    <div class="container mt-5 pt-5">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li> <!-- Tampilkan setiap error -->
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Breadcrumbs untuk navigasi -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('homepage') }}" class="text-secondary">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('produk') }}" class="text-secondary">Photo Packages</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $package->name }}</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Gambar Utama -->
            <div class="col-md-6 text-center mt-5">
                <img src="{{ $package->image_url }}" alt="{{ $package->name }}" class="img-fluid rounded"
                    style="height: 500px; object-fit: cover;">
            </div>

            <!-- Informasi dan Harga -->
            <div class="col-md-6 mt-5">
                <h2 class="fw-bold">{{ $package->name }}</h2>
                <h2 class="fw-bold text-muted" style="font-size: 2rem;">Rp.
                    {{ number_format($package->price, 0, ',', '.') }}</h2>

                <!-- Deskripsi sebagai daftar -->
                <ul>
                    @foreach ($descriptionArray as $descItem)
                        <li>{{ trim($descItem) }}</li> <!-- Hilangkan spasi tambahan -->
                    @endforeach
                </ul>

                <!-- Tombol untuk booking -->
                <button class="btn btn-secondary btn-lg" data-bs-toggle="modal" data-bs-target="#bookingModal">Book
                    Now</button>
            </div>
        </div>

        <!-- Modal untuk booking -->
        <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bookingModalLabel">Book {{ $package->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulir booking -->
                        <form action="{{ route('booking.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="package_id" value="{{ $package->id }}">

                            <!-- Nama Pengguna -->
                            <div class="mb-3">
                                <label for="user_name">Name</label>
                                <input type="text" name="user_name" id="user_name" class="form-control"
                                    value="{{ isset($user) ? $user->name : '' }}" readonly>
                            </div>

                            <!-- Nomor Telepon -->
                            <div class="mb-3">
                                <label for="user_phone">Phone</label>
                                <input type="text" name="user_phone" id="user_phone" class="form-control"
                                    value="{{ isset($user) ? $user->phone : '' }}" readonly>
                            </div>


                            <!-- Tanggal -->
                            <div class="mb-3">
                                <label for="booking_date">Date</label>
                                <input type="date" name="booking_date" id="booking_date" class="form-control" required>
                            </div>

                            <!-- Waktu -->
                            <div class="mb-3">
                                <label for="booking_time">Time</label>
                                <select name="booking_time" id="booking_time" class="form-control" required>
                                    <option value="">Select Time</option>
                                    <!-- Waktu yang belum terbooking -->
                                    @for ($hour = 9; $hour <= 18; $hour++)
                                        @php
                                            $timeSlot = sprintf('%02d:00', $hour);
                                        @endphp
                                        @if (!in_array($timeSlot, $existingBookings))
                                            <option value="{{ $timeSlot }}">{{ $timeSlot }} -
                                                {{ sprintf('%02d:00', $hour + 1) }}</option>
                                        @endif
                                    @endfor
                                </select>
                            </div>

                            <!-- Extra Person -->
                            <div class="mb-3">
                                <label for="additional_people">Extra Person? Rp.15.000,-/person<span
                                        class="text-muted mx-1">(Optional)</span></label>
                                <input type="number" name="additional_people" id="additional_people" min="0"
                                    step="1" class="form-control" value="0">
                            </div>

                            <!-- Tombol untuk submit -->
                            <button type="submit" class="btn btn-primary">Book Now</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection
