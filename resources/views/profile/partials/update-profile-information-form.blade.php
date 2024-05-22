<header class="mb-4">
    <p class="text-muted">
        {{ __("Update your account's profile information and email address.") }}
    </p>
</header>

<!-- Formulir untuk Mengirim Ulang Verifikasi Email -->
<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<!-- Formulir untuk Memperbarui Profil -->
<form method="post" action="{{ route('profile.update') }}" class="mt-4 needs-validation" novalidate>
    @csrf
    @method('patch')

    <!-- Nama -->
    <div class="form-group">
        <label for="name" class="font-weight-bold">{{ __('Name') }}</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}"
            required autofocus autocomplete="name" />
        @if ($errors->get('name'))
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
        @endif
    </div>

    <!-- Email -->
    <div class="form-group mt-3">
        <label for="email" class="font-weight-bold">{{ __('Email') }}</label>
        <input type="email" name="email" id="email" class="form-control"
            value="{{ old('email', $user->email) }}" required autocomplete="username" />
        @if ($errors->get('email'))
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
        @endif
    </div>

    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
        <div class="alert alert-warning mt-4">
            <p class="text-sm text-muted">
                {{ __('Your email address is unverified.') }}

                <button form="send-verification" class="btn btn-link">
                    {{ __('Click here to re-send the verification email.') }}
                </button>
            </p>

            @if (session('status') === 'verification-link-sent')
                <p class="text-success text-sm">
                    {{ __('A new verification link has been sent to your email address.') }}
                </p>
            @endif
        </div>
    @endif

    <!-- Nomor Telepon (Non-editable) -->
    <div class="form-group mt-3">
        <label for="phone" class="font-weight-bold">{{ __('Phone Number') }}</label>
        <input type="text" name="phone" id="phone" class="form-control"
            value="{{ old('phone', $user->phone) }}" required autofocus autocomplete="phone" readonly />
    </div>

    <!-- Tombol Simpan -->
    <div class="d-flex justify-content-between mt-3">
        <button type="submit" class="btn btn-secondary">
            {{ __('Save') }}
        </button>
    </div>
</form>
