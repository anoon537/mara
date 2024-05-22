@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-3 px-3">
        <div class="container-fluid p-4 rounded shadow-lg" style="background-color: #fefeff;">
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('admin.galery.create') }}" class="btn">Add New Item</a>
                <a href="{{ route('galery') }}" target="_blank" class="btn">View on Landing Page</a>
            </div>
            <div class="row row-cols-1 row-cols-md-4 g-4">
                @foreach ($galeryItems as $item)
                    <div class="col">
                        <div class="card h-100 img-wrapper" style="max-height: 300px; overflow: hidden;">
                            <a href="{{ Storage::url($item->image_url) }}" data-lightbox="galery"
                                data-title="{{ $item->title }}">
                                <img src="{{ Storage::url($item->image_url) }}" class="card-img-top"
                                    alt="{{ $item->title }}">
                            </a>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('admin.galery.edit', $item->id) }}" class="btn btn-sm me-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.galery.destroy', $item->id) }}"
                                    class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#confirmDeleteModal" data-id="{{ $item->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
