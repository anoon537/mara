@extends('layouts.app1') <!-- Menggunakan layout utama -->

@section('title')
    Konfirmasi Booking
@endsection

@section('content')
    <div class="container my-5"> <!-- Kontainer untuk konfirmasi booking -->
        <h2>Konfirmasi Booking</h2> <!-- Judul halaman -->

        <p>Terima kasih telah melakukan booking untuk paket foto "{{ $package->name }}".</p>
        <p>Silakan transfer pembayaran ke rekening berikut:</p>

        <!-- Informasi pembayaran -->
        <ul>
            <li>Bank: BCA</li>
            <li>Nomor Rekening: 123-456-789</li>
            <li>Atas Nama: John Doe</li>
        </ul>

        <p>Setelah melakukan pembayaran, silakan unggah bukti pembayaran di bawah ini:</p>

        <!-- Formulir untuk mengunggah bukti pembayaran -->
        <form action="{{ route('home.booking.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf <!-- Token CSRF untuk keamanan -->

            <!-- Input untuk bukti pembayaran -->
            <div class="mb-3">
                <label for="payment_proof" class="form-label">Bukti Pembayaran</label> <!-- Label untuk bukti pembayaran -->
                <input type="file" id="payment_proof" name="payment_proof" class="form-control" required>
                <!-- Input untuk unggah bukti -->
            </div>

            <!-- Tombol untuk mengirim bukti -->
            <button type="submit" class="btn btn-secondary">Upload Bukti Pembayaran</button>
            <!-- Tombol untuk mengunggah -->
        </form>
    </div>
@endsection
