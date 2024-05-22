@extends('admin.layouts.app')

@section('content')
    <div class="container py-3">
        <div class="container-md p-4 rounded shadow-lg" style="background-color: #fefeff;">
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

                <button type="submit" class="btn">Save</button>
                <a href="{{ route('admin.users.index') }}" class="btn">Back</a>
            </form>
        </div>
    </div>
@endsection
