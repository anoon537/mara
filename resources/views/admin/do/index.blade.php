@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-3 px-3">
        <div class="container-fluid p-4 rounded shadow-lg" style="background-color: #fefeff;">
            <div class="d-flex justify-content-start mb-3">
                <a href="{{ route('admin.do.create') }}" class="btn me-2">Add New Direct Order</a>
                <form action="{{ route('admin.do.index') }}" method="GET" class="flex-grow-1">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                            placeholder="Search by Booking ID, User Name, or Booking Date" value="{{ request('search') }}">
                        <button type="submit" class="btn"><i class="fas fa-search me-2"></i>Search</button>
                    </div>
                </form>
            </div>

            <!-- Tabel dengan Bootstrap 5 -->
            <div class="table-responsive">
                <table class="table">
                    <thead style="vertical-align: middle;">
                        <tr>
                            <th>Booking ID</th>
                            <th>Booked By</th>
                            <th>Phone</th>
                            <th>Package | Extra Person</th>
                            <th>Date | Time</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // Fungsi untuk mengubah nomor telepon dari 08 ke +62
                            function convertPhoneNumber($phone)
                            {
                                // Jika nomor telepon dimulai dengan 08, ganti dengan +62
                                if (substr($phone, 0, 2) == '08') {
                                    return '+62' . substr($phone, 1);
                                }
                                return $phone;
                            }
                        @endphp
                        @foreach ($directOrders as $directOrder)
                            <tr>
                                <td>#{{ $directOrder->id }}</td>
                                <td>{{ $directOrder->name }}</td>
                                <td>
                                    @php
                                        // Mengonversi nomor telepon
                                        $convertedPhone = $directOrder->phone
                                            ? convertPhoneNumber($directOrder->phone)
                                            : 'No Phone';
                                    @endphp
                                    <a class="text-success" href="https://wa.me/{{ $convertedPhone }}" target="_blank">
                                        {{ $convertedPhone }}
                                    </a>
                                </td>

                                <td>{{ $directOrder->paket }} |
                                    {{ $directOrder->extra_person }} person</td>
                                <td>{{ \Carbon\Carbon::parse($directOrder->booking_date)->format('d F Y') }} at
                                    {{ \Carbon\Carbon::parse($directOrder->booking_time)->format('H:i') }} WIB</td>
                                <td>
                                    @if ($directOrder->status == 'dp 30%' || $directOrder->status == 'dp 50%')
                                        <span
                                            class="badge bg-warning text-white">{{ ucfirst($directOrder->status) }}</span>
                                    @else
                                        <span
                                            class="badge bg-success text-white">{{ ucfirst($directOrder->status) }}</span>
                                    @endif

                                </td>
                                <td>Rp.{{ number_format($directOrder->price, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('admin.do.printInvoice', $directOrder->id) }}" class="btn btn-sm"
                                        target="_blank">
                                        <i class="fas fa-print"></i>
                                    </a>
                                    @if ($directOrder->status == 'dp')
                                        <form method="POST" action="{{ route('admin.do.complete', $directOrder->id) }}"
                                            class="d-inline complete-form">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-success">Complete</button>
                                        </form>
                                    @endif
                                    <form method="POST" action="{{ route('admin.do.destroy', $directOrder->id) }}"
                                        class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#confirmDeleteModal" data-id="{{ $directOrder->id }}">
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
