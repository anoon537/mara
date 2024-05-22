@extends('admin.layouts.app')

@section('content')
    <div class="container py-3">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="container-fluid p-4 rounded shadow-lg" style="background-color: #fefeff;">
            <form action="{{ route('admin.do.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="photo_package_id">Photo Package</label>
                    <select name="photo_package_id" id="photo_package_id" class="form-control" required>
                        @foreach ($photoPackages as $package)
                            <option value="{{ $package->id }}">{{ $package->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="extra_person">Extra Person <span class="text-muted">(optional)</span></label>
                    <input type="number" name="extra_person" id="extra_person" class="form-control" value="0">
                </div>

                <div class="mb-3">
                    <label for="booking_date">Booking Date</label>
                    <input type="date" name="booking_date" id="booking_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="booking_time">Booking Time</label>
                    <select name="booking_time" id="booking_time" class="form-control" required>
                        @for ($hour = 9; $hour <= 18; $hour++)
                            <option value="{{ $hour }}:00">{{ $hour }}:00 - {{ $hour + 1 }}:00</option>
                        @endfor
                    </select>
                </div>
                <button type="submit" class="btn">Submit</button>
                <a href="{{ route('admin.do.index') }}" class="btn">Back</a>
            </form>
        </div>
    </div>
@endsection
