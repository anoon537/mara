@extends('layouts.app1')

@section('title')
    Mara Studio - Forgot Password
@endsection

@section('content')
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow" role="status"></div>
    </div>
    <!-- Spinner End -->

    <div class="container py-5 my-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="card-body p-md-4 mx-md-4">
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('homepage') }}">
                                        <img src="{{ asset('img/mara/logo1.png') }}" class="py-2 px-2 bg-secondary"
                                            style="width: 120px; height: 50px; border-radius: 2.5px;" alt="logo">
                                    </a>
                                    <h2 class="ms-3">Forgot Password</h2>
                                </div>

                                <!-- Session Status -->
                                @if (session('status'))
                                    <div class="text-success mt-1" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <!-- Display Errors -->
                                @if ($errors->any())
                                    <div class="text-danger mt-1">
                                        @foreach ($errors->all() as $error)
                                            <p>{{ $error }}</p>
                                        @endforeach
                                    </div>
                                @endif

                                <!-- Password Reset Form -->
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <div class="form-outline mt-4 mb-4">
                                        <label class="form-label" for="inputEmail">Email</label>
                                        <input type="email" name="email" id="inputEmail" class="form-control"
                                            placeholder="Email Address" value="{{ old('email') }}" required />
                                    </div>

                                    <!-- Submit Button -->
                                    <button class="btn btn-secondary"
                                        type="submit">{{ __('Email Password Reset Link') }}</button>
                                </form>
                            </div>
                        </div>

                        <!-- Right Section -->
                        <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                            <div class="text-white px-3 py-4 mx-md-4">
                                <h4 class="mb-4">We are more than just a company</h4>
                                <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                                    do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                    veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
