@extends('layouts.app1')

@section('title')
    Profile - Mara Studio
@endsection

@section('content')
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow" role="status"></div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light fixed-top shadow py-lg-0 px-4 px-lg-5 wow fadeIn"
        data-wow-delay="0.1s">
        @include('layouts.navbar')
    </nav>
    <!-- Navbar End -->
    <div class="container mt-5 pt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" class="text-secondary">Home</a> <!-- Link ke homepage -->
                </li>
                <li class="breadcrumb-item active" aria-current="page">History</li> <!-- Nama paket -->
            </ol>
        </nav>
        <!-- Main Content Start -->
        <div class="row justify-content-center">
            <div class="col-md-8 mt-3">
                <!-- Update Profile Information -->
                <div class="card mb-2">
                    <div class="card-header me-2">
                        {{ __('Update Profile Information') }}
                        @if (session('status') === 'profile-updated')
                            <p class="text-success text-sm">
                                {{ __('Profile updated successfully.') }}
                            </p>
                        @endif
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Update Password -->
                <div class="card mb-2">
                    <div class="card-header me-2">
                        {{ __('Change Password') }}
                        @if (session('status') === 'password-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                class="text-success text-sm">
                                {{ __('Password changed successfully.') }}</p>
                        @endif
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Delete Account -->
                <div class="card">
                    <div class="card-header text-danger">
                        {{ __('Delete Account') }}
                    </div>
                    <div class="card-body">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Content End -->
    @include('layouts.footer')
@endsection
