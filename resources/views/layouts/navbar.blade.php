<div class="container">
    <a href="{{ url('/') }}" class="navbar-brand">
        <h1 class="text-white bg-secondary py-2 px-4 d-block d-lg-none">Mara Studio</h1>
        <h1 class="text-white bg-secondary py-2 px-4 d-none d-lg-block">Mara Studio</h1>
    </a>
    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav me-auto mb-2 mb-lg-0">
            <a href="{{ url('/') }}" class="nav-item nav-link{{ request()->is('/') ? ' active' : '' }}">Home</a>
            <a href="{{ route('about') }}"
                class="nav-item nav-link{{ request()->is('about') ? ' active' : '' }}">About</a>
            <a href="{{ route('produk') }}"
                class="nav-item nav-link{{ request()->routeIs('produk') ? ' active' : '' }}">Photo Package</a>
            <a href="{{ route('galery') }}"
                class="nav-item nav-link{{ request()->is('galery') ? ' active' : '' }}">Galery</a>
            <a href="{{ route('contact') }}"
                class="nav-item nav-link{{ request()->is('contact') ? ' active' : '' }}">Contact</a>
        </div>
        <div class="navbar-nav ms-auto">
            @if (Route::has('login'))
                @auth
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fa-solid fa-user-gear"></i></a>
                        <div class="dropdown-menu dropdown-menu-end rounded-0 shadow-sm border-0 m-0">
                            <p class="dropdown-item">{{ Auth::user()->name }}</p>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fa-solid fa-user"></i>
                                {{ __('Profile') }}</a>
                            <a class="dropdown-item" href="{{ route('payment.history') }}"><i
                                    class="fa-solid fa-history"></i> History Pembayaran</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="fa-solid fa-right-from-bracket"></i>
                                    {{ __('Log Out') }}</button>
                            </form>
                        </div>

                    </div>
                @else
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fa-solid fa-user"></i></a>
                        <div class="dropdown-menu dropdown-menu-end rounded-0 shadow-sm border-0 m-0">
                            <a href="{{ route('login') }}" class="dropdown-item">{{ __('Login') }}</a>
                            <a href="{{ route('register') }}" class="dropdown-item">{{ __('Register') }}</a>
                        </div>
                    </div>
                @endauth
            @endif
        </div>
    </div>
</div>
