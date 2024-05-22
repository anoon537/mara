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
        <div class="container my-5 py-5 rounded shadow-sm">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Purchase History</h2>
            </div>

            @if ($payments->isEmpty())
                <p class="text-center text-muted">make transactions first</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Photo Package</th>
                                <th>Date & Time</th>
                                <th>Price | Payment Option</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $payment->booking->photo_package->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($payment->booking->booking_date)->format('d F Y') }} at
                                        {{ \Carbon\Carbon::parse($payment->booking->booking_time)->format('H:i') }}</td>
                                    <td>
                                        @if ($payment->booking->status === 'completed')
                                            Rp {{ number_format($payment->booking->price, 0, ',', '.') }} |
                                            {{ $payment->payment_option }}
                                        @else
                                            Rp {{ number_format($payment->price, 0, ',', '.') }} |
                                            {{ $payment->payment_option }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($payment->booking->status == 'waiting for confirmation')
                                            <span
                                                class="badge bg-warning text-white">{{ ucfirst($payment->booking->status) }}</span>
                                            <!-- Kuning untuk pending -->
                                        @elseif ($payment->booking->status == 'confirmed')
                                            <span
                                                class="badge bg-primary text-white">{{ ucfirst($payment->booking->status) }}</span>
                                            <!-- Biru untuk approved -->
                                        @elseif ($payment->booking->status == 'completed')
                                            <span
                                                class="badge bg-success text-white">{{ ucfirst($payment->booking->status) }}</span>
                                            <!-- Hijau untuk completed -->
                                        @else
                                            <span>{{ ucfirst($payment->booking->status) }}</span>
                                            <!-- Warna default jika ada status lain -->
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    @include('layouts.footer')
@endsection
