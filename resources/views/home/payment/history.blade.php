@extends('layouts.app1')

@section('title', 'History Pembayaran')

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
                    <a href="{{ route('home') }}" class="text-secondary">Home</a> <!-- Link ke homepage -->
                </li>
                <li class="breadcrumb-item active" aria-current="page">History</li> <!-- Nama paket -->
            </ol>
        </nav>
        <div class="container my-5">
            <h2>History Pembayaran</h2>

            @if ($payments->isEmpty())
                <p>Tidak ada riwayat pembayaran yang ditemukan.</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Paket Foto</th>
                            <th>Tanggal Booking</th>
                            <th>Waktu</th>
                            <th>Harga</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td>{{ $payment->booking->photo_package->name }}</td>
                                <td>{{ $payment->booking->booking_date }}</td>
                                <td>{{ $payment->booking->booking_time }}</td>
                                <td>
                                    @if ($payment->booking->status === 'completed')
                                        Rp {{ number_format($payment->booking->price, 0, ',', '.') }}
                                    @else
                                        Rp {{ number_format($payment->price, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td>{{ ucfirst($payment->booking->status) }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
