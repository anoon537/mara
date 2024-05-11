@extends('layouts.app1')

@section('title')
    Mara Studio
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
    <div class="container-fluid hero-header bg-light py-5 mb-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <p class="text-uppercase mb-2 animated slideInDown">Selamat Datang di Mara Studio</p>
                    <h1 class="display-4 mb-3 animated slideInDown">Studio Foto di Purwokerto</h1>
                    <p class="animated slideInDown">Tempat fotografi menjadi seni. Ingin tahu lebih banyak? Jelajahi layanan
                        kami dan lihat bagaimana kami dapat membantu Anda menangkap momen terbaik. Hubungi kami untuk
                        memulai perjalanan fotografi Anda.</p>
                    <div class="d-flex align-items-center pt-4 animated slideInDown">
                        <button type="button" class="btn-play" data-bs-toggle="modal" data-src=""
                            data-bs-target="#videoModal">
                            <span></span>
                        </button>
                        <h5 class="ms-4 mb-0 d-none d-sm-block">Play Video</h5>
                    </div>
                </div>
                <div class="col-lg-6 animated fadeIn">
                    <div class="row g-3">
                        <div class="col-6 text-end">
                            <img class="img-fluid bg-white p-3 w-100 mb-3"
                                src="{{ asset('img/mara/wedding (1).jpg') }}"alt="">
                            <img class="img-fluid bg-white p-3 w-50" src="{{ asset('img/mara/wedding (2).jpg') }}"
                                alt="">
                        </div>
                        <div class="col-6">
                            <img class="img-fluid bg-white p-3 w-50 mb-3" src="{{ asset('img/mara/wedding (3).jpg') }}"
                                alt="">
                            <img class="img-fluid bg-white p-3 w-100" src="{{ asset('img/mara/wedding (5).jpg') }}"
                                alt="">
                        </div>
                    </div>
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
                        <a class="btn btn-secondary py-3 px-5" href="{{ route('about') }}">Pelajari Lebih Lanjut</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Facts Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="text-uppercase mb-2">Mengapa Memilih Kami?</p>
                <h1 class="display-6 mb-5">Studio Foto Terbaik di Purwokerto</h1>
            </div>
            <div class="row g-3">
                <div class="col-lg-4 col-md-6 pt-lg-5 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="fact-item bg-light text-center h-100 p-5">
                        <h1 class="display-2 mb-3" data-toggle="counter-up"></h1>
                        <h4 class="mb-3">Harga Terjangkau</h4>
                        <span>Kami menawarkan paket fotografi dengan harga yang kompetitif tanpa mengorbankan kualitas.
                            Tujuan kami adalah memberikan nilai terbaik untuk klien kami.</span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="fact-item bg-light text-center h-100 p-5">
                        <h1 class="display-2 mb-3" data-toggle="counter-up"></h1>
                        <h4 class="mb-3">Layanan Terbaik</h4>
                        <span>Tim kami berdedikasi untuk memberikan layanan pelanggan yang luar biasa. Dengan pengalaman
                            puluhan tahun, kami memastikan setiap klien mendapatkan perhatian dan hasil terbaik.</span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 pt-lg-5 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="fact-item bg-light text-center h-100 p-5">
                        <h1 class="display-2 mb-3" data-toggle="counter-up"></h1>
                        <h4 class="mb-3">Hasil Memuaskan</h4>
                        <span>Lebih dari 1000 klien telah mempercayai kami untuk menangkap momen berharga mereka. Kepuasan
                            mereka menunjukkan dedikasi kami terhadap kualitas dan kepuasan pelanggan.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Facts End -->


    <!-- Service Start -->
    <div class="container-xxl bg-light py-5 my-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="text-uppercase mb-2">Photo Package</p>
                <h1 class="display-6 mb-4">We Provide Best Professional Services</h1>
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
                                    <img class="img-fluid" src="{{ $package->image_url }}" alt="{{ $package->name }}">
                                @endif
                                <div class="service-overlay">
                                    <a class="btn btn-lg-square btn-outline-light rounded-circle" href="#"><i
                                            class="fa fa-link"></i></a>
                                </div>
                            </div>
                            <div class="text-center p-4">
                                <!-- Menampilkan nama dan harga paket -->
                                <h4>{{ $package->name }}</h4> <!-- Nama paket foto -->
                                <p class="text-muted">Rp. {{ number_format($package->price, 0, ',', '.') }}</p>
                                <!-- Harga paket foto -->
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Service End -->
    @include('layouts.footer')
@endsection
