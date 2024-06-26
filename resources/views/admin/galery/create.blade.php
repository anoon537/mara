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
            <form method="POST" action="{{ route('admin.galery.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="images" class="form-label">Images</label>
                    <input type="file" name="images[]" class="form-control" multiple required>
                </div>
                <button type="submit" class="btn">Add Item</button>
                <a href="{{ route('admin.galery') }}" class="btn">Back</a>
            </form>
        </div>
    </div>
@endsection
