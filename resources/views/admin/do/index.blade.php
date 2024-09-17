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
                            <th>Package</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // Function to convert phone number from 08 to +62
                            function convertPhoneNumber($phone)
                            {
                                // If the phone number starts with 08, replace it with +62
                                return substr($phone, 0, 2) === '08' ? '+62' . substr($phone, 1) : $phone;
                            }
                        @endphp

                        @foreach ($directOrders as $directOrder)
                            <tr data-bs-toggle="modal" data-bs-target="#orderModal{{ $directOrder->id }}"
                                style="cursor: pointer;">
                                <td>#{{ $directOrder->id }}</td>
                                <td>{{ $directOrder->name }}</td>
                                <td>{{ $directOrder->paket }}</td>
                                <td>{{ \Carbon\Carbon::parse($directOrder->booking_date)->format('d F Y') }}</td>
                                <td>
                                    @if ($directOrder->status === 'DP')
                                        <span class="badge bg-warning text-white">{{ ucfirst($directOrder->status) }}</span>
                                    @else
                                        <span class="badge bg-success text-white">{{ ucfirst($directOrder->status) }}</span>
                                    @endif
                                </td>
                            </tr>

                            <!-- Modal for Order Details -->
                            <div class="modal fade" id="orderModal{{ $directOrder->id }}" tabindex="-1"
                                aria-labelledby="orderModalLabel{{ $directOrder->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="orderModalLabel{{ $directOrder->id }}">Order
                                                Details: #{{ $directOrder->id }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Name:</strong> {{ $directOrder->name }}</p>
                                            <p><strong>Phone:</strong>
                                                @php
                                                    $convertedPhone = $directOrder->phone
                                                        ? convertPhoneNumber($directOrder->phone)
                                                        : 'No Phone';
                                                @endphp
                                                <a class="text-success" href="https://wa.me/{{ $convertedPhone }}"
                                                    target="_blank">
                                                    {{ $convertedPhone }}
                                                </a>
                                            </p>
                                            <p><strong>Package:</strong> {{ $directOrder->paket }}</p>
                                            <p><strong>Extra Person:</strong> {{ $directOrder->extra_person }}</p>
                                            <p><strong>Date:</strong>
                                                {{ \Carbon\Carbon::parse($directOrder->booking_date)->format('d F Y') }}
                                            </p>
                                            <p><strong>Time:</strong>
                                                {{ \Carbon\Carbon::parse($directOrder->booking_time)->format('H:i') }} WIB
                                            </p>
                                            <p><strong>Status:</strong> {{ ucfirst($directOrder->status) }}</p>
                                            <p><strong>Price:</strong>
                                                Rp.{{ number_format($directOrder->price, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{ route('admin.do.printInvoice', $directOrder->id) }}"
                                                class="btn btn-sm" target="_blank">
                                                <i class="fas fa-print"></i> Print Invoice
                                            </a>
                                            @if ($directOrder->status === 'DP')
                                                <form method="POST"
                                                    action="{{ route('admin.do.complete', $directOrder->id) }}"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm">Complete</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
