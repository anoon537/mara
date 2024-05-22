@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-3">
        <div class="container-fluid p-4 rounded shadow-lg" style="background-color: #fefeff;">
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('photo_packages.create') }}" class="btn me-2">Add New Item</a>
                <a href="{{ route('produk') }}" target="_blank" class="btn me-2">View on Landing Page</a>
                <form action="{{ route('photo_packages.index') }}" method="GET" class="flex-grow-1">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search by Name Package"
                            value="{{ request('search') }}">
                        <button type="submit" class="btn"><i class="fas fa-search me-2"></i>Search</button>
                    </div>
                </form>
            </div>
            <div class="table-responsive table-scrollable">
                <table class="table">
                    <thead style="vertical-align: middle;"> <!-- Baris header dengan latar gelap -->
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($photoPackages as $package)
                            <tr>
                                <td>{{ $package->name }}</td>
                                <td>Rp.{{ number_format($package->price, 0, ',', '.') }}</td>
                                <td>
                                    @foreach ((array) $package->description as $descItem)
                                        <!-- Konversi JSON ke array -->
                                        <li>{{ $descItem }}</li> <!-- Tampilkan setiap item sebagai list -->
                                    @endforeach
                                </td>
                                <td>
                                    @if ($package->image_url)
                                        <a href="{{ $package->image_url }}"
                                            data-lightbox="photo_package_{{ $package->id }}"
                                            data-title="{{ $package->name }}">
                                            <img class="img-fluid img-thumbnail" src="{{ $package->image_url }}"
                                                alt="{{ $package->name }}" style="max-width: 100px;">
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('photo_packages.edit', $package->id) }}" class="btn btn-sm my-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('photo_packages.destroy', $package->id) }}"
                                        class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#confirmDeleteModal" data-id="{{ $package->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>
@endsection
