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

    <!-- Main Content Start -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Update Profile Information -->
                <div class="card my-5">
                    <div class="card-header">
                        {{ __('Update Profile Information') }}
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Update Password -->
                <div class="card my-5">
                    <div class="card-header">
                        {{ __('Update Password') }}
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Delete Account -->
                <div class="card my-5">
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
