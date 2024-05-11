@extends('admin.layouts.app')

@section('content')
    <div class="container py-my-3">
        <h1 class="fw-bold text-center">LAPORAN FOTO STUDIO DI MARA STUDIO</h1>
        <p class="text-center">Laporan dari {{ \Carbon\Carbon::parse($start_date)->format('d F Y') }} hingga
            {{ \Carbon\Carbon::parse($end_date)->format('d F Y') }}</p>
        <div class="text-center mb-3">
            <a href="{{ route('admin.reports.generate-pdf', ['start_date' => $start_date, 'end_date' => $end_date]) }}"
                class="btn btn-primary" target="_blank"><i class="fas fa-print"> CETAK</i>
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order ID</th> <!-- Mengubah Booking ID menjadi Order ID -->
                        <th>Booked By</th>
                        <th>Package</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Iterasi untuk semua pesanan yang selesai -->
                    @foreach ($allCompletedOrders as $order)
                        <!-- Ubah dari completedBookings ke allCompletedOrders -->
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->user->name ?? $order->name }}</td> <!-- Jika Direct Order, gunakan name -->
                            <td>
                                @if (isset($order->photo_package))
                                    {{ $order->photo_package->name }}
                                @else
                                    N/A <!-- Jika tidak ada paket foto -->
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($order->booking_date)->format('d F Y') }}</td>
                            <!-- Format tanggal -->
                            <td>{{ \Carbon\Carbon::parse($order->booking_time)->format('H:i') }}</td> <!-- Format waktu -->
                            <td>Rp {{ number_format($order->price ?? 0, 0, ',', '.') }}</td>
                            <!-- Harga dengan format Rupiah -->
                        </tr>
                    @endforeach

                    <!-- Baris Total Revenue -->
                    <tr>
                        <td colspan="5" class="text-end fw-bold">Total Revenue</td>
                        <td class="fw-bold">Rp {{ number_format($total_revenue, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
