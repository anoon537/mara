<nav class="navbar navbar-expand px-4 py-3 text-white" style="background-color: #0e2238;">
    <div class="navbar-collapse collapse">
        <h3 class="fw-bold fs-4 mt-2">{{ $title }}</h3>
        <ul class="navbar-nav ms-auto">
            <h4 class="fw-bold fs-4 mt-2 mx-2">{{ Auth::user()->name }}</h4>
            <li class="nav-item dropdown">
                <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                    <img src="{{ asset('admin/account.png') }}" class="avatar img-fluid" alt="">
                </a>
                <div class="dropdown-menu dropdown-menu-end rounded">
                    <a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user"></i>
                        {{ __('Profile') }}</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item"><i class="fa-solid fa-right-from-bracket"></i>
                            {{ __('Log Out') }}</button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
