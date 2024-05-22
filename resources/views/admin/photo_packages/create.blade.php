@extends('admin.layouts.app')

@section('content')
    <div class="container py-3 px-3">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container-fluid p-4 rounded shadow-lg" style="background-color: #fefeff;">
            <form action="{{ route('photo_packages.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Input untuk Nama Paket -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <!-- Input untuk Harga -->
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" step="0.01" id="price" name="price" class="form-control" required>
                </div>
                <!-- Input untuk Deskripsi, dengan saran untuk entri daftar -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description" class="form-control" rows="8" cols="50"
                        placeholder="Enter description, use commas to separate items"></textarea>
                </div>
                <!-- Input untuk Gambar -->
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" id="image" name="image" class="form-control">
                </div>
                <!-- Tombol Simpan dan Kembali -->
                <div class="justify-content-between">
                    <button type="submit" class="btn">Save</button>
                    <a href="{{ route('photo_packages.index') }}" class="btn">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection
