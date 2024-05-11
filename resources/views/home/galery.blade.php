@extends('layouts.app1') <!-- Layout utama -->

@section('title', 'Galeri - Mara Studio')

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
                    <span class="text-secondary">Galery</span> <!-- Link ke daftar paket foto -->
                </li>
            </ol>
        </nav>

        <!-- Galeri berdasarkan judul -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                    <h1 class="display-6 mb-0">Explore Our Gallery by Title</h1>
                </div>
                @foreach ($galeryByTitle as $key => $items)
                    <!-- Untuk setiap kelompok berdasarkan judul -->
                    <div class="mb-4"> <!-- Menampilkan judul kelompok -->
                        <h3 class="text-secondary"> {{ ucfirst($items->first()->title) }} Photo</h3>
                        <div class="row g-3"> <!-- Menampilkan item dalam kelompok -->
                            @foreach ($items as $item)
                                <div class="col-lg-3 col-md-6">
                                    <div class="project-item">
                                        <img class="img-fluid" src="{{ Storage::url($item->image_url) }}"
                                            alt="{{ $item->title }}">
                                        <a class="project-title h5 mb-0" href="{{ Storage::url($item->image_url) }}"
                                            data-lightbox="galery" data-title="{{ $item->title }}">
                                            {{ $item->title }}
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('layouts.footer') <!-- Footer -->
@endsection
