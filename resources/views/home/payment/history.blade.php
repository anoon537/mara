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
                <div class="list-group">
                    @foreach ($payments as $payment)
                        <a href="#" class="list-group-item list-group-item-action" data-bs-toggle="modal"
                            data-bs-target="#paymentModal{{ $payment->id }}">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ $payment->booking->photo_package->name }}</h5>
                                <small>{{ \Carbon\Carbon::parse($payment->booking->booking_date)->format('d F Y') }}</small>
                            </div>
                            <small>
                                @if ($payment->booking->status == 'waiting for confirmation')
                                    <span
                                        class="badge bg-warning text-white">{{ ucfirst($payment->booking->status) }}</span>
                                @elseif ($payment->booking->status == 'confirmed')
                                    <span
                                        class="badge bg-primary text-white">{{ ucfirst($payment->booking->status) }}</span>
                                @elseif ($payment->booking->status == 'completed')
                                    <span
                                        class="badge bg-success text-white">{{ ucfirst($payment->booking->status) }}</span>
                                @else
                                    <span>{{ ucfirst($payment->booking->status) }}</span>
                                @endif
                            </small>
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="paymentModal{{ $payment->id }}" tabindex="-1"
                            aria-labelledby="paymentModalLabel{{ $payment->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="paymentModalLabel{{ $payment->id }}">Payment Details
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Booking ID:</strong> #{{ $payment->booking->id }}</p>
                                        <p><strong>Photo Package:</strong> {{ $payment->booking->photo_package->name }}</p>
                                        <p><strong>Date & Time:</strong>
                                            {{ \Carbon\Carbon::parse($payment->booking->booking_date)->format('d F Y') }}
                                            at {{ \Carbon\Carbon::parse($payment->booking->booking_time)->format('H:i') }}
                                        </p>
                                        <p><strong>Price:</strong> Rp {{ number_format($payment->price, 0, ',', '.') }}</p>
                                        <p><strong>Payment Option:</strong> {{ $payment->payment_option }}</p>
                                        <p><strong>Status:</strong>
                                            @if ($payment->booking->status == 'waiting for confirmation')
                                                <span
                                                    class="badge bg-warning text-white">{{ ucfirst($payment->booking->status) }}</span>
                                            @elseif ($payment->booking->status == 'confirmed')
                                                <span
                                                    class="badge bg-primary text-white">{{ ucfirst($payment->booking->status) }}</span>
                                            @elseif ($payment->booking->status == 'completed')
                                                <span
                                                    class="badge bg-success text-white">{{ ucfirst($payment->booking->status) }}</span>
                                            @else
                                                <span>{{ ucfirst($payment->booking->status) }}</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    @include('layouts.footer')
@endsection
