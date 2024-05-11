@extends('admin.layouts.app')

@section('content')
    <div class="container py-3 px-3">
        <form method="POST" action="{{ route('admin.galery.update', $galeryItem->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $galeryItem->title }}" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Update Item</button>
            <a href="{{ route('admin.galery') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
