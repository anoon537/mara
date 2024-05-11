@extends('layouts.app1')

@section('title')
    Booking Paket Foto
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container my-5">
        <h2>Booking Paket Foto</h2>
        <form action="{{ route('booking.store') }}" method="POST">
            @csrf
            <input type="hidden" name="package_id" value="{{ $package->id }}"> <!-- Pastikan ada package_id -->
            <div class="mb-3">
                <label for="booking_date">Tanggal</label>
                <input type="date" name="booking_date" id="booking_date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="booking_time">Waktu</label>
                <select name="booking_time" id="booking_time" class="form-control" required>
                    <option value="09:00">09:00 - 10:00</option>
                    <option value="10:00">10:00 - 11:00</option>
                    <option value="11:00">11:00 - 12:00</option>
                    <option value="12:00">12:00 - 13:00</option>
                    <option value="13:00">13:00 - 14:00</option>
                    <option value="14:00">14:00 - 15:00</option>
                    <option value="15:00">15:00 - 16:00</option>
                    <option value="16:00">16:00 - 17:00</option>
                    <option value="17:00">17:00 - 18:00</option>
                    <option value="18:00">18:00 - 19:00</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Book Now</button> <!-- Tombol untuk mengirim -->
        </form>

    </div>
@endsection
