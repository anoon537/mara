@extends('admin.layouts.app')

@section('content')
    <div class="container py-3 px-3">
        <div class="d-flex justify-content-start mb-3">
            <!-- Tombol untuk membuat Direct Order baru -->
            <a href="{{ route('admin.do.create') }}" class="btn btn-success">Buat Direct Order Baru</a>
        </div>

        <!-- Tabel dengan Bootstrap 5 -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead style="vertical-align: middle;"> <!-- Baris header dengan latar gelap -->
                    <tr>
                        <th>Booking ID</th>
                        <th>Nama</th>
                        <th>Telepon</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Waktu Pemesanan</th>
                        <th>Paket Foto</th>
                        <th>Status</th>
                        <th>Price</th>
                        <th>Aksi</th> <!-- Kolom untuk aksi -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($directOrders as $directOrder)
                        <tr>
                            <td>{{ $directOrder->id }}</td>
                            <td>{{ $directOrder->name }}</td>
                            <td>{{ $directOrder->phone }}</td>
                            <td>{{ \Carbon\Carbon::parse($directOrder->booking_date)->format('d F Y') }}</td>
                            <!-- Format tanggal -->
                            <td>{{ \Carbon\Carbon::parse($directOrder->booking_time)->format('H:i') }}</td>
                            <!-- Format waktu -->
                            <td>{{ $directOrder->photo_package->name }}</td>
                            <td>{{ ucfirst($directOrder->status) }}</td> <!-- Ubah status ke Title Case -->
                            <td>Rp {{ number_format($directOrder->price, 0, ',', '.') }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.do.destroy', $directOrder->id) }}"
                                    class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this order?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tambahkan navigasi halaman jika diperlukan -->

    </div>
@endsection
