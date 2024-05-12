@extends('admin.layouts.app')

@section('content')
    <div class="container py-3">
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('photo_packages.create') }}" class="btn btn-success">Add New Item</a>
            <a href="{{ route('produk') }}" target="_blank" class="btn btn-info">View on Landing Page</a>
        </div>
        <div class="table-responsive table-scrollable">
            <table class="table table-bordered">
                <thead>
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
                            <td>{{ $package->price }}</td>
                            <td>
                                <ul>
                                    @foreach ((array) $package->description as $descItem)
                                        <!-- Konversi JSON ke array -->
                                        <li>{{ $descItem }}</li> <!-- Tampilkan setiap item sebagai list -->
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                @if ($package->image_url)
                                    <a href="{{ $package->image_url }}" data-lightbox="photo_package_{{ $package->id }}"
                                        data-title="{{ $package->name }}">
                                        <img class="img-fluid img-thumbnail" src="{{ $package->image_url }}"
                                            alt="{{ $package->name }}" style="max-width: 100px;">
                                    </a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('photo_packages.edit', $package->id) }}"
                                    class="btn btn-primary btn-sm my-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('photo_packages.destroy', $package->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this package?')">
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
@endsection
