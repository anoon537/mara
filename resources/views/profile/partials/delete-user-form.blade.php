<header>
    <h2 class="fw-bold">
        {{ __('Delete Account') }}
    </h2>
    <p class="text-muted">
        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
    </p>
</header>

<!-- Button to Trigger Modal -->
<button class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#confirm-user-deletion">
    {{ __('Delete Account') }}
</button>

<!-- Modal Confirmation for Deleting Account -->
<div id="confirm-user-deletion" class="modal fade" tabindex="-1" aria-labelledby="confirm-user-deletion-title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="confirm-user-deletion-title">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>
            </div>
            <div class="modal-body">
                <p class="text-muted">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <!-- Form to Confirm Deletion -->
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <!-- Password Input for Confirmation -->
                    <div class="form-group mt-3">
                        <input type="password" name="password" id="confirm-user-deletion-password" class="form-control"
                            placeholder="{{ __('Password') }}" required />
                        @if ($errors->userDeletion->get('password'))
                            <div class="invalid-feedback">
                                {{ $errors->userDeletion->get('password') }}
                            </div>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-4 d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            {{ __('Cancel') }}
                        </button>

                        <button type="submit" class="btn btn-danger ms-3">
                            {{ __('Delete Account') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
