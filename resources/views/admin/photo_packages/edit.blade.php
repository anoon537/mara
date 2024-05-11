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

        <form action="{{ route('photo_packages.update', $photoPackage->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $photoPackage->name }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" id="price" name="price" class="form-control"
                    value="{{ $photoPackage->price }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control" rows="10" cols="50"
                    placeholder="Enter description, use commas to separate items"></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image (optional)</label>
                <input type="file" id="image" name="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('photo_packages.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
