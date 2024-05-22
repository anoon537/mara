@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-3 px-3">
        @if (session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="container-fluid p-4 rounded shadow-lg" style="background-color: #fefeff;">
            <form action="{{ route('admin.bookings.index') }}" method="GET" class="mb-3">
                <div class="input-group mb-2">
                    <input type="text" name="search" class="form-control"
                        placeholder="Search by Booking ID or User Name Or Booking Date" value="{{ request('search') }}">
                    <button type="submit" class="btn"><i class="fas fa-search me-2"></i>Search</button>
                </div>
            </form>
            <div class="table-responsive table-scrollable">
                <table class="table">
                    <thead style="vertical-align: middle;">
                        <tr>
                            <th>Booking ID</th>
                            <th>Booked By</th>
                            <th>Phone</th>
                            <th>Package | Extra Person</th>
                            <th>Date | Time</th>
                            <th>Status</th>
                            <th>Payment | Payment Option</th>
                            <th>Proof of Payment</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>#{{ $booking->id }}</td>
                                <td>{{ $booking->user->name }}</td>
                                <td>{{ $booking->user->phone }}</td>
                                <td>{{ $booking->photo_package->name }} | Extra Person {{ $booking->additional_people }}
                                </td>
                                <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d F Y') }} |
                                    {{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }}</td>
                                <td>
                                    @if ($booking->status == 'waiting for confirmation')
                                        <span class="badge bg-warning text-white">{{ ucfirst($booking->status) }}</span>
                                        <!-- Kuning untuk pending -->
                                    @elseif ($booking->status == 'confirmed')
                                        <span class="badge bg-primary text-white">{{ ucfirst($booking->status) }}</span>
                                        <!-- Biru untuk approved -->
                                    @elseif ($booking->status == 'completed')
                                        <span class="badge bg-success text-white">{{ ucfirst($booking->status) }}</span>
                                        <!-- Hijau untuk completed -->
                                    @else
                                        <span>{{ ucfirst($booking->status) }}</span>
                                        <!-- Warna default jika ada status lain -->
                                    @endif
                                </td>
                                <td>
                                    @if ($booking->payment)
                                        @if ($booking->status == 'completed')
                                            Rp.{{ number_format($booking->photo_package->price, 0, ',', '.') }} |
                                            {{ $booking->payment->payment_option }}
                                        @else
                                            Rp.{{ number_format($booking->payment->price, 0, ',', '.') }} |
                                            {{ $booking->payment->payment_option }}
                                        @endif
                                    @else
                                        Rp 0
                                    @endif
                                </td>
                                @if ($booking->payment && $booking->payment->payment_proof)
                                    <td>
                                        <a href="{{ Storage::url($booking->payment->payment_proof) }}"
                                            data-lightbox="payment-proof-{{ $booking->id }}" title="Proof of Payment">
                                            <img src="{{ Storage::url($booking->payment->payment_proof) }}"
                                                style="max-width: 100px; cursor: pointer;" alt="Payment Proof"
                                                class="img-thumbnail">
                                        </a>
                                    </td>
                                @else
                                    <td>No Proof</td>
                                @endif

                                <td>
                                    @if ($booking->status == 'waiting for confirmation' && $booking->payment && $booking->payment->payment_proof)
                                        <form method="POST"
                                            action="{{ route('admin.payments.approve', $booking->payment->id) }}"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm my-1">Confirm</button>
                                        </form>
                                    @elseif ($booking->status == 'confirmed')
                                        <form method="POST"
                                            action="{{ route('admin.payments.markPending', $booking->id) }}"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm my-1">Reject</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.bookings.complete', $booking->id) }}"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm my-1">Completed</button>
                                        </form>
                                    @elseif ($booking->status == 'completed')
                                        <span class="btn btn-sm my-1"><i class="fas fa-check-circle"></i></span>
                                    @endif
                                    <!-- Opsi untuk mencetak invoice -->
                                    <a href="{{ route('admin.bookings.printInvoice', $booking->id) }}" class="btn btn-sm"
                                        target="_blank">
                                        <i class="fas fa-print"></i>
                                    </a>
                                    <!-- Opsi untuk menghapus booking -->
                                    <form method="POST" action="{{ route('admin.bookings.destroy', $booking->id) }}"
                                        class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#confirmDeleteModal" data-id="{{ $booking->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
