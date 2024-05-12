@extends('admin.layouts.app')

@section('content')
    <div class="container py-3 px-3">
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('admin.galery.create') }}" class="btn btn-success">Add New Item</a>
            <a href="{{ route('galery') }}" target="_blank" class="btn btn-info">View on Landing Page</a>
        </div>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            @foreach ($galeryItems as $item)
                <div class="col">
                    <div class="card h-100 img-wrapper" style="max-height: 300px; overflow: hidden;">
                        <a href="{{ Storage::url($item->image_url) }}" data-lightbox="galery"
                            data-title="{{ $item->title }}">
                            <img src="{{ Storage::url($item->image_url) }}" class="card-img-top" alt="{{ $item->title }}">
                        </a>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('admin.galery.edit', $item->id) }}" class="btn btn-sm btn-primary me-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.galery.destroy', $item->id) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this item?');">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
