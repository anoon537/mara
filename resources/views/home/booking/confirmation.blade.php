@extends('layouts.app1')

@section('title')
    Konfirmasi Booking
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

    <div class="container mt-5 pt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('homepage') }}" class="text-secondary">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('produk') }}" class="text-secondary">Photo Packages</a></li>
                <li class="breadcrumb-item active" aria-current="page">Confirmation</li>
            </ol>
        </nav>
    </div>
    <div class="container mt-2">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-center pb-5">
                    <div class="col-md-7 col-xl-5 mb-4 mb-md-0">
                        <div class="py-4 d-flex flex-row">
                            <h5><span class="far fa-check-square pe-2 text-secondary"></span><b>BOOKING</b> |</h5>
                            <span class="ps-2">Confirmation</span>
                        </div>
                        <h4 class="text-secondary">Rp {{ number_format($booking->price, 0, ',', '.') }}</h4>
                        <h4>{{ $package->name }}</h4>
                        <div class="d-flex pt-2">
                            <div>
                                <p>
                                    <b>Booking Date: <span
                                            class="text-secondary">{{ \Carbon\Carbon::parse($booking_date)->format('d F Y') }}</span></b>
                                </p>
                                <p>
                                    <b>Time: <span
                                            class="text-secondary">{{ \Carbon\Carbon::parse($booking_time)->format('H:i') }}</span></b>
                                </p>
                            </div>
                        </div>
                        <p>Additional People: {{ $booking->additional_people }}</p>
                        <div class="rounded d-flex bg-body-tertiary p-2">
                            <div>Total Price:</div>
                            <div class="ms-auto">Rp {{ number_format($booking->price, 0, ',', '.') }}</div>
                        </div>
                        <hr />
                        <div class="pt-2">
                            <p>Please transfer the payment to the following bank account:</p>
                            <ul>
                                <li>Bank: BCA</li>
                                <li>Account Number: 123-456-789</li>
                                <li>Account Name: John Doe</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-5 col-xl-4 offset-xl-1">
                        <div class="py-4 d-flex justify-content-end">
                            <h6><a href="{{ route('produk') }}" class="text-secondary">Cancel and return to website</a>
                            </h6>
                        </div>
                        <div class="rounded d-flex flex-column p-3 bg-body-tertiary">
                            <div class="me-3">
                                <p>After making the payment, please upload the payment proof using the form below:</p>
                            </div>
                            <form action="{{ route('payment.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                <div class="mb-3">
                                    <label for="payment_option">Choose Payment Method:</label><br>
                                    <input type="radio" id="dp" name="payment_option" value="dp" checked>
                                    <label for="dp">Deposit (50%) - Rp
                                        {{ number_format($booking->price * 0.5, 0, ',', '.') }}</label><br>
                                    <input type="radio" id="full" name="payment_option" value="full">
                                    <label for="full">Full Payment - Rp
                                        {{ number_format($booking->price, 0, ',', '.') }}</label><br>
                                </div>
                                <div class="mb-3">
                                    <label for="payment_proof" class="form-label">Upload Payment Proof</label>
                                    <input type="file" name="payment_proof" id="payment_proof" class="form-control"
                                        required>
                                </div>
                                <button type="submit" class="btn btn-secondary">Upload Payment Proof</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('layouts.footer')
@endsection
