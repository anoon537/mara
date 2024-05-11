@extends('admin.layouts.app')

@section('content')
    <div class="container py-3">
        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" value="{{ $user->phone }}" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('admin.users.user-settings') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
