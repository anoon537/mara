@extends('admin.layouts.app')

@section('content')
    <main class="content px-3 py-4">
        <div class="container-fluid p-4 rounded shadow-lg" style="background-color: #fefeff;">
            <div class="mb-3">
                <div class="row g-4">
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card h-100 text-dark rounded-3" style="background-color: #fefeff;">
                            <div class="card-body">
                                <h4 class="mb-2 fw-bold text-secondary">
                                    <i class="fas fa-camera-retro"></i>
                                    Photo Packages
                                </h4>
                                <p class="mb-2">{{ $total_photo_packages }} Total Photo Packages</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card h-100 text-dark rounded-3" style="background-color: #fefeff;">
                            <div class="card-body">
                                <h4 class="mb-2 fw-bold text-secondary">
                                    <i class="fas fa-users"></i>
                                    Members
                                </h4>
                                <p class="mb-2">{{ $total_users }} Total Users</p>
                                <div class="mb-0">
                                    <span class="badge bg-success"><i class="fas fa-user-plus"></i>
                                        {{ $new_users }} New Users</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card h-100 text-dark rounded-3" style="background-color: #fefeff;">
                            <div class="card-body">
                                <h4 class="mb-2 fw-bold text-secondary">
                                    <i class="fas fa-calendar-alt"></i>
                                    Booking
                                </h4>
                                <p class="mb-2">{{ $total_all_orders }} Total Booking</p>
                                <span class="badge bg-warning"><i class="fas fa-clock"></i>
                                    {{ $pending_bookings }} Pending</span>
                                <span class="badge bg-primary"><i class="fas fa-check-circle"></i>
                                    {{ $approved_bookings }} Approved</span>
                                <span class="badge bg-success"><i class="fas fa-medal"></i>
                                    {{ $total_all_completed }} Completed</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card h-100 text-dark rounded-3" style="background-color: #fefeff;">
                            <div class="card-body">
                                <h4 class="mb-2 fw-bold text-secondary">
                                    <i class="fas fa-sack-dollar"></i>
                                    Total Revenue
                                </h4>
                                <p class="mb-2">Rp {{ number_format($total_revenue, 2, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
