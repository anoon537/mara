<header>
    <h2 class="font-weight-bold">
        {{ __('Update Password') }}
    </h2>
    <p class="text-muted">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </p>
</header>

<!-- Formulir untuk Memperbarui Kata Sandi -->
<form method="post" action="{{ route('password.update') }}" class="mt-4 needs-validation" novalidate>
    @csrf
    @method('put')

    <!-- Kata Sandi Saat Ini -->
    <div class="form-group">
        <label for="update_password_current_password">{{ __('Current Password') }}</label>
        <input type="password" name="current_password" id="update_password_current_password" class="form-control"
            autocomplete="current-password" required />
        @if ($errors->updatePassword->get('current_password'))
            <div class="invalid-feedback">
                {{ $errors->updatePassword->get('current_password') }}
            </div>
        @endif
    </div>

    <!-- Kata Sandi Baru -->
    <div class="form-group mt-3">
        <label for="update_password_password">{{ __('New Password') }}</label>
        <input type="password" name="password" id="update_password_password" class="form-control"
            autocomplete="new-password" required />
        @if ($errors->updatePassword->get('password'))
            <div class="invalid-feedback">
                {{ $errors->updatePassword->get('password') }}
            </div>
        @endif
    </div>

    <!-- Konfirmasi Kata Sandi Baru -->
    <div class="form-group mt-3">
        <label for="update_password_password_confirmation">{{ __('Confirm Password') }}</label>
        <input type="password" name="password_confirmation" id="update_password_password_confirmation"
            class="form-control" autocomplete="new-password" required />
        @if ($errors->updatePassword->get('password_confirmation'))
            <div class="invalid-feedback">
                {{ $errors->updatePassword->get('password_confirmation') }}
            </div>
        @endif
    </div>

    <!-- Tombol Simpan -->
    <div class="mt-3">
        <button type="submit" class="btn btn-secondary">
            {{ __('Save') }}
        </button>

        @if (session('status') === 'password-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-success text-sm">
                {{ __('Saved.') }}</p>
        @endif
    </div>
</form>
