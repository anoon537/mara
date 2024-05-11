@extends('layouts.app1')

@section('title')
    Mara Studio - Login
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
                                <div class="d-flex">
                                    <a href="{{ url('/') }}"> <img src="{{ asset('img/mara/logo1.png') }}"
                                            class="py-2 px-2 bg-secondary"
                                            style="width: 120px; height: 50px; border-radius: 2.5px;" alt="logo"></a>
                                    <h1 class="ms-3">Log in</h1>
                                </div>

                                {{-- Display errors if any --}}
                                @if ($errors->any())
                                    <div class="text-danger mt-1">
                                        @foreach ($errors->all() as $error)
                                            <p>{{ $error }}</p>
                                        @endforeach
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-outline mt-4 mb-4">
                                        <label class="form-label" for="inputEmail">Email</label>
                                        <input type="email" name="email" id="inputEmail" class="form-control"
                                            placeholder="Email Address" value="{{ old('email') }}" />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="inputPassword">Password</label>
                                        <input type="password" name="password" id="inputPassword" class="form-control"
                                            placeholder="Password" />
                                    </div>

                                    <div class="d-flex justify-content-between pt-1 mb-4 pb-1">
                                        <a class="text-muted" href="{{ route('password.request') }}">Forgot
                                            password?</a>
                                        <button class="btn btn-secondary" type="submit">Log in</button>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <p class="me-2">Don't have an account?</p>
                                        <a class="text-muted" href="{{ route('register') }}">Create One!</a>
                                    </div>
                                </form>
                            </div>
                        </div>
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
