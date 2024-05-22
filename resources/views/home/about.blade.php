@extends('layouts.app1')

@section('title')
    About - Mara Studio
@endsection

@section('content')
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow" role="status"></div>
    </div>
    <nav class="navbar navbar-expand-lg bg-white navbar-light fixed-top shadow py-lg-0 px-4 px-lg-5 wow fadeIn"
        data-wow-delay="0.1s">
        @include('layouts.navbar')
    </nav>
    <div class="container mt-5 pt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" class="text-secondary">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="text-secondary">About</span>
                </li>
            </ol>
        </nav>
    </div>

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="row g-3 img-twice position-relative h-100">
                        <div class="col-6">
                            <img class="img-fluid bg-light p-3" src="{{ asset('img/mara/about1.jpg') }}" alt="">
                        </div>
                        <div class="col-6 align-self-end">
                            <img class="img-fluid bg-light p-3" src="{{ asset('img/mara/about2.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                        <p class="text-uppercase mb-2">About Us</p>
                        <h1 class="display-6 mb-4">Kami adalah Fotografer Kreatif dan Profesional</h1>
                        <p>Di Mara Studio, kami mengutamakan kreativitas dan profesionalisme dalam setiap sesi fotografi.
                            Dengan pengalaman bertahun-tahun, kami siap menangkap momen-momen berharga Anda dengan hasil
                            yang memuaskan. Tim kami yang berdedikasi akan memastikan bahwa setiap proyek, baik potret
                            pribadi, pernikahan, maupun acara khusus, memenuhi harapan Anda.</p>
                        <p>Studio kami dikenal karena penggunaan peralatan canggih dan inovatif. Kami berkomitmen untuk
                            memberikan layanan berkualitas tinggi, serta menawarkan produk khusus yang dapat disesuaikan
                            dengan kebutuhan Anda.</p>
                        <div class="row g-2 mb-4">
                            <div class="col-sm-6">
                                <i class="fa fa-check me-3"></i>Produk Berkualitas
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check me-3"></i>Produk Kustom
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check me-3"></i>Pemesanan Online
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check me-3"></i>Harga Terjangkau
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
