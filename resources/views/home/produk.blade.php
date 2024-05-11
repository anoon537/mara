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
        @include('layouts.navbar')
    </nav>
    <!-- Navbar End -->

    <!-- Header Start -->
    <div class="container-fluid hero-header bg-light py-5 my-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <nav aria-label="breadcrumb animated slideInDown">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                            <li class="breadcrumb-item active">Photo Package</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="text-Secondary text-uppercase mb-2">Photo Packages</p>
                <h1 class="display-6 mb-4"></h1>
            </div>

            <!-- Menampilkan data PhotoPackage -->
            <div class="row g-3">
                @foreach ($photoPackages as $package)
                    <!-- Iterasi melalui daftar paket foto -->
                    <div class="col-lg-3 col-md-6">
                        <div class="service-item d-flex flex-column bg-white p-3 pb-0">
                            <div class="position-relative">
                                <!-- Menampilkan gambar paket foto -->
                                @if ($package->image_url)
                                    <a href="{{ route('home.detail', $package->id) }}">
                                        <img class="img-fluid" src="{{ $package->image_url }}" alt="{{ $package->name }}">
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
                                <h4> {{ $package->name }}</h4>
                                <p class="text-muted">Rp. {{ number_format($package->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Service End -->

    @include('layouts.footer') <!-- Footer -->
@endsection
