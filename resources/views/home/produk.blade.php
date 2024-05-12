@extends('layouts.app1')

@section('title')
    Photo Package - Mara Studio
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
                    <a href="{{ route('homepage') }}" class="text-secondary">Home</a> <!-- Link ke homepage -->
                </li>
                <li class="breadcrumb-item">
                    <span class="text-secondary">Photo Package</span> <!-- Link ke daftar paket foto -->
                </li>
            </ol>
        </nav>
        <!-- Header End -->

        <!-- Service Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5">
                    <h1 class="display-6">Explore Our Photo Package</h1>
                </div>
                <div class="row g-3">
                    @foreach ($photoPackages as $package)
                        <div class="col-lg-3 col-md-6">
                            <div class="service-item d-flex flex-column bg-white p-3 pb-0">
                                <div class="position-relative img-wrapper" style="max-height: 300px; overflow: hidden;">
                                    @if ($package->image_url)
                                        <a href="{{ route('home.detail', $package->id) }}">
                                            <img class="img-fluid img-cover" src="{{ $package->image_url }}"
                                                alt="{{ $package->name }}">
                                        </a>
                                    @endif
                                    <div class="service-overlay">
                                        <a class="btn btn-lg-square btn-outline-light rounded-circle"
                                            href="{{ route('home.detail', $package->id) }}">
                                            <i class="fa fa-link"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="text-center p-4">
                                    <!-- Menampilkan nama dan harga paket -->
                                    <h5>{{ $package->name }}</h5>
                                    <h5 class="text-muted">Rp. {{ number_format($package->price, 0, ',', '.') }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

        <!-- Service End -->
    </div>

    @include('layouts.footer') <!-- Footer -->
@endsection
