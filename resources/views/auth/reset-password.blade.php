@extends('layouts.app1')

@section('title')
    Mara Studio - Reset Password
@endsection

@section('content')
    <div class="container py-5 my-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <!-- Form Section -->
                        <div class="col-lg-6">
                            <div class="card-body p-md-4 mx-md-4">
                                <div class="d-flex align-items-center mb-4">
                                    <a href="{{ route('homepage') }}">
                                        <img src="https://github.com/anoon537/image/blob/main/logo1.png?raw=true"
                                            alt="Logo" style="width: 120px; height: 50px; border-radius: 2.5px;">

                                    </a>
                                    <h1 class="ms-3">Reset Password</h1>
                                </div>

                                <!-- Display Errors -->
                                @if ($errors->any())
                                    <div class="text-danger mt-1">
                                        @foreach ($errors->all() as $error)
                                            <p>{{ $error }}</p>
                                        @endforeach
                                    </div>
                                @endif

                                <!-- Reset Password Form -->
                                <form method="POST" action="{{ route('password.store') }}">
                                    @csrf

                                    <!-- Password Reset Token -->
                                    <input type="hidden" name="token" value="{{ request()->route('token') }}">

                                    <!-- Email Address -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control"
                                            value="{{ old('email', request()->email) }}" required autofocus
                                            autocomplete="username" />
                                    </div>

                                    <!-- Password -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" name="password" class="form-control" required
                                            autocomplete="new-password" />
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="password_confirmation">Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control" required
                                            autocomplete="new-password" />
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="d-flex justify-content-end mt-4">
                                        <button type="submit" class="btn btn-secondary">
                                            {{ __('Reset Password') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Additional Section -->
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
