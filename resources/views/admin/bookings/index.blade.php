@extends('admin.layouts.app')

@section('content')
    <div class="container py-3 px-3">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead style="vertical-align: middle;">
                    <tr>
                        <th>Booking ID</th>
                        <th>Booked By</th>
                        <th>Phone</th>
                        <th>Package</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Price</th>
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
                            <td>{{ $booking->photo_package->name }} Extra Person {{ $booking->additional_people }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d F Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }}</td>
                            <td>
                                @if ($booking->status == 'pending')
                                    <span class="text-warning">{{ ucfirst($booking->status) }}</span>
                                    <!-- Kuning untuk pending -->
                                @elseif ($booking->status == 'approved')
                                    <span class="text-primary">{{ ucfirst($booking->status) }}</span>
                                    <!-- Biru untuk approved -->
                                @elseif ($booking->status == 'completed')
                                    <span class="text-success">{{ ucfirst($booking->status) }}</span>
                                    <!-- Hijau untuk completed -->
                                @else
                                    <span>{{ ucfirst($booking->status) }}</span>
                                    <!-- Warna default jika ada status lain -->
                                @endif
                            </td>

                            <td>Rp {{ number_format($booking->price, 0, ',', '.') }}</td>

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
                                @if ($booking->status == 'pending' && $booking->payment && $booking->payment->payment_proof)
                                    <form method="POST"
                                        action="{{ route('admin.payments.approve', $booking->payment->id) }}"
                                        class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success my-1">Approve</button>
                                    </form>
                                @elseif ($booking->status == 'approved')
                                    <form method="POST" action="{{ route('admin.payments.markPending', $booking->id) }}"
                                        class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-warning my-1">Pending</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.bookings.complete', $booking->id) }}"
                                        class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-primary my-1">Completed</button>
                                    </form>
                                @elseif ($booking->status == 'completed')
                                    <span class="btn btn-success my-1"><i class="fas fa-check-circle"></i></span>
                                @endif

                                <!-- Opsi untuk mencetak invoice -->
                                <a href="{{ route('admin.bookings.printInvoice', $booking->id) }}" class="btn btn-primary"
                                    target="_blank">
                                    <i class="fas fa-print"></i>
                                </a>

                                <!-- Opsi untuk menghapus booking -->
                                <form method="POST" action="{{ route('admin.bookings.destroy', $booking->id) }}"
                                    class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this booking?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $bookings->links('pagination::bootstrap-5') }}
    </div>
@endsection
