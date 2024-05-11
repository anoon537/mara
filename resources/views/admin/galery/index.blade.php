@extends('admin.layouts.app')

@section('content')
    <div class="container py-3 px-3">
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('admin.galery.create') }}" class="btn btn-success">Add New Item</a>
            <a href="{{ route('galery') }}" target="_blank" class="btn btn-info">View on Landing Page</a>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead style="vertical-align: middle;">
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($galeryItems as $item)
                        <tr>
                            <td>
                                <a href="{{ Storage::url($item->image_url) }}" data-lightbox="galery"
                                    data-title="{{ $item->title }}">
                                    <img src="{{ Storage::url($item->image_url) }}" class="img-thumbnail"
                                        style="max-width: 100px;" alt="{{ $item->title }}">
                                </a>
                            </td>
                            <td>{{ $item->title }}</td>
                            <td>
                                <a href="{{ route('admin.galery.edit', $item->id) }}" class="btn btn-primary"><i
                                        class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('admin.galery.destroy', $item->id) }}"
                                    class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this item?');">
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
    </div>
@endsection
