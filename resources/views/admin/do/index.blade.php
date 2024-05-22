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
                    <thead style="vertical-align: middle;"> <!-- Baris header dengan latar gelap -->
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
                        @foreach ($directOrders as $directOrder)
                            <tr>
                                <td>#{{ $directOrder->id }}</td>
                                <td>{{ $directOrder->name }}</td>
                                <td>{{ $directOrder->phone }}</td>
                                <td>{{ $directOrder->photo_package->name }} |
                                    {{ $directOrder->extra_person }}</td>
                                <td>{{ \Carbon\Carbon::parse($directOrder->booking_date)->format('d F Y') }} |
                                    {{ \Carbon\Carbon::parse($directOrder->booking_time)->format('H:i') }}</td>
                                <td><span class=" badge bg-success text-white">{{ ucfirst($directOrder->status) }}</span>
                                </td>
                                <td>Rp.{{ number_format($directOrder->price, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('admin.do.printInvoice', $directOrder->id) }}" class="btn btn-sm"
                                        target="_blank">
                                        <i class="fas fa-print"></i>
                                    </a>
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
