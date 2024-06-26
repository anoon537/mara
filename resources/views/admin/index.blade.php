@extends('admin.layouts.app')

@section('content')
    <main class="content px-3 py-4">
        <div class="container-fluid p-4 rounded shadow-lg bg-light">
            <div class="mb-3">
                <div class="row g-4">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 bg-white rounded-3">
                            <div class="card-body">
                                <h4 class="mb-2 fw-bold text-secondary">
                                    <i class="fas fa-camera-retro"></i>
                                    Photo Packages
                                </h4>
                                <p class="mb-2">{{ $total_photo_packages }} Total Photo Packages</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 bg-white rounded-3">
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

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 bg-white rounded-3">
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

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 bg-white rounded-3">
                            <div class="card-body">
                                <h4 class="mb-2 fw-bold text-secondary">
                                    <i class="fas fa-sack-dollar"></i>
                                    Monthly Income
                                </h4>
                                <p class="mb-2">Rp {{ number_format($total_revenue, 2, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 bg-white rounded-3">
                            <div class="card-body">
                                <h4 class="mb-2 fw-bold text-secondary">
                                    <i class="fas fa-images"></i>
                                    Total Gallery
                                </h4>
                                <p class="mb-2">{{ $total_galery }} Total Gallery</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 bg-white rounded-3">
                            <div class="card-body">
                                <h4 class="mb-2 fw-bold text-secondary">
                                    <i class="fas fa-history"></i>
                                    Log Activity
                                </h4>
                                <p class="mb-2">{{ $total_logs }} Total Log Activity</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <canvas id="revenueChart" width="400" height="400"></canvas>
                </div>
                <div class="col-md-6">
                    <canvas id="bookingChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <!-- Include Chart.js from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Generate array of colors
        function generateColors(length) {
            const colors = [];
            for (let i = 0; i < length; i++) {
                const color =
                    `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.2)`;
                colors.push(color);
            }
            return colors;
        }

        // Data for Revenue Chart
        var revenueCtx = document.getElementById('revenueChart').getContext('2d');
        var revenueChart = new Chart(revenueCtx, {
            type: 'bar', // Change to 'line', 'bar', etc. based on your need
            data: {
                labels: @json($daily_revenue_labels),
                datasets: [{
                    label: 'Daily Revenue',
                    data: @json($daily_revenue_data),
                    backgroundColor: generateColors(@json($daily_revenue_data).length),
                    borderColor: generateColors(@json($daily_revenue_data).length).map(color => color
                        .replace('0.2', '1')),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Data for Booking Chart
        var bookingCtx = document.getElementById('bookingChart').getContext('2d');
        var bookingChart = new Chart(bookingCtx, {
            type: 'bar', // Change to 'line', 'bar', etc. based on your need
            data: {
                labels: @json($daily_bookings_labels),
                datasets: [{
                    label: 'Daily Bookings',
                    data: @json($daily_bookings_data),
                    backgroundColor: generateColors(@json($daily_bookings_data).length),
                    borderColor: generateColors(@json($daily_bookings_data).length).map(color => color
                        .replace('0.2', '1')),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
