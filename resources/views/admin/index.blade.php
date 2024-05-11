@extends('admin.layouts.app')

@section('content')
    <main class="content px-3 py-4">
        <div class="container-fluid">
            <div class="mb-3">
                <div class="row g-4">
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="mb-2 fw-bold">
                                    <i class="fas fa-users"></i>
                                    Members Progress
                                </h5>
                                <p class="mb-2 fw-bold">{{ $total_users }} Total Users</p>
                                <div class="mb-0">
                                    <span class="badge text-success"><i class="fas fa-user-plus"></i>
                                        {{ $new_users }} New Users</span>
                                    <span class="badge text-black">Since Last Month</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="mb-2 fw-bold">
                                    <i class="fas fa-camera-retro"></i>
                                    Photo Packages
                                </h5>
                                <p class="mb-2 fw-bold">{{ $total_photo_packages }} Total Photo Packages</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="mb-2 fw-bold">
                                    <i class="fas fa-images"></i>
                                    Galery
                                </h5>
                                <p class="mb-2 fw-bold">{{ $total_galery }} Total Photos</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="mb-2 fw-bold">
                                    <i class="fas fa-calendar-alt"></i>
                                    Booking
                                </h5>
                                <p class="mb-2 fw-bold">{{ $total_all_orders }} Total Booking</p>
                                <span class="badge text-warning"><i class="fas fa-clock"></i>
                                    {{ $pending_bookings }} Pending</span>
                                <span class="badge text-primary"><i class="fas fa-check-circle"></i>
                                    {{ $approved_bookings }} Approved</span>
                                <span class="badge text-success"><i class="fas fa-medal"></i>
                                    {{ $total_all_completed }} Completed</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
