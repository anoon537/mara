@php
    $currentRoute = request()->route()->getName();

    $sidebarActiveRoute = match (true) {
        str_contains($currentRoute, 'photo_packages') => 'photo_packages.index',
        str_contains($currentRoute, 'admin.galery') => 'admin.galery',
        str_contains($currentRoute, 'users') => 'admin.users.index',
        str_contains($currentRoute, 'bookings') => 'admin.bookings.index',
        str_contains($currentRoute, 'reports') => 'admin.reports.index',
        str_contains($currentRoute, 'do') => 'admin.do.index',

        default => 'admin.index',
    };
@endphp

<aside id="sidebar">
    <div class="d-flex mt-2 ms-1">
        <button class="toggle-btn" type="button">
            <i class="fas fa-bars-staggered" style="color:#6c757d;"></i>
        </button>
        <div class="sidebar-logo">
            <a href="#"><img src="https://i.ibb.co/dpW9NPS/logo1-1.png" alt="logo1-1"
                    style="width: 120px; height: 50px;" /></a>
        </div>
    </div>
    <ul class="sidebar-nav">
        <li class="sidebar-item {{ $sidebarActiveRoute == 'admin.index' ? 'active' : '' }}">
            <a href="{{ route('admin.index') }}" class="sidebar-link">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="sidebar-item {{ $sidebarActiveRoute == 'photo_packages.index' ? 'active' : '' }}">
            <a href="{{ route('photo_packages.index') }}" class="sidebar-link">
                <i class="fas fa-camera-retro"></i>
                <span>Photo Package</span>
            </a>
        </li>
        <li class="sidebar-item {{ $sidebarActiveRoute == 'admin.galery' ? 'active' : '' }}">
            <a href="{{ route('admin.galery') }}" class="sidebar-link">
                <i class="fas fa-images"></i>
                <span>Galery</span>
            </a>
        </li>
        <li class="sidebar-item {{ $sidebarActiveRoute == 'admin.bookings.index' ? 'active' : '' }}">
            <a href="{{ route('admin.bookings.index') }}" class="sidebar-link">
                <i class="fas fa-calendar-alt"></i>
                <span>Booking</span>
            </a>
        </li>
        <li class="sidebar-item {{ $sidebarActiveRoute == 'admin.do.index' ? 'active' : '' }}">
            <a href="{{ route('admin.do.index') }}" class="sidebar-link">
                <i class="fas fa-pen"></i>
                <span>Direct Order</span>
            </a>
        </li>
        <li class="sidebar-item {{ $sidebarActiveRoute == 'admin.reports.index' ? 'active' : '' }}">
            <a href="{{ route('admin.reports.index') }}" class="sidebar-link">
                <i class="fas fa-book"></i>
                <span>Report</span>
            </a>
        </li>
        <li class="sidebar-item {{ $sidebarActiveRoute == 'admin.users.index' ? 'active' : '' }}">
            <a href="{{ route('admin.users.index') }}" class="sidebar-link">
                <i class="fas fa-users"></i>
                <span>User Data</span>
            </a>
        </li>
    </ul>
    <div class="sidebar-footer">
        <a class="sidebar-link">
            <img src="{{ asset('img/mara/logofot.png') }}" style="width: 75%" alt="">
        </a>
    </div>
</aside>
