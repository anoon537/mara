@extends('layouts.app1')

@section('title')
    About - Mara Studio
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
    <div class="container-fluid hero-header bg-light py-5 my-5 ">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <nav aria-label="breadcrumb animated slideInDown">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">About Us</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="row g-3 img-twice position-relative h-100">
                        <div class="col-6">
                            <img class="img-fluid bg-light p-3" src="{{ asset('img/mara/about (1).jpg') }}" alt="">
                        </div>
                        <div class="col-6 align-self-end">
                            <img class="img-fluid bg-light p-3" src="{{ asset('img/mara/about (2).jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                        <p class="text-secondary text-uppercase mb-2">Tentang Kami</p>
                        <h1 class="display-6 mb-4">Kami Adalah Fotografer Kreatif dan Profesional</h1>
                        <p>Di Mara Studio, kami menggabungkan kreativitas dan profesionalisme untuk memberikan pengalaman
                            fotografi yang tak terlupakan. Dari pemotretan keluarga hingga sesi foto pernikahan, tim kami
                            siap menangkap momen berharga Anda dengan hasil yang berkualitas tinggi.</p>
                        <p>Kami juga menyediakan layanan kustom untuk memastikan hasil sesuai dengan keinginan Anda. Dengan
                            produk berkualitas dan tim yang berpengalaman, kami berkomitmen untuk memberikan kepuasan
                            pelanggan yang maksimal.</p>
                        <div class="row g-2 mb-4">
                            <div class="col-sm-6">
                                <i class="fa fa-check text-secondary me-3"></i>Produk Berkualitas
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-secondary me-3"></i>Produk Kustom
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-secondary me-3"></i>Pemesanan Online
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-secondary me-3"></i>Harga Terjangkau
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    @include('layouts.footer')
@endsection
