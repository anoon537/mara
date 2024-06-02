@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-3 px-3">
        <div class="container-fluid p-4 rounded shadow-lg" style="background-color: #fefeff;">
            <div class="d-flex justify-content-start mb-3">
                <!-- Tombol untuk membuat Direct Order baru -->
                <a href="{{ route('admin.users.create') }}" class="btn me-2">Add New User</a>
                <form action="{{ route('admin.users.index') }}" method="GET" class="flex-grow-1">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search by Name"
                            value="{{ request('search') }}">
                        <button type="submit" class="btn"><i class="fas fa-search me-2"></i>Search</button>
                    </div>
                </form>
            </div>
            <div class="table-responsive table-scrollable">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Verified</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // Fungsi untuk mengubah nomor telepon dari 08 ke +62
                            function convertPhoneNumber($phone)
                            {
                                // Jika nomor telepon dimulai dengan 08, ganti dengan +62
                                if (substr($phone, 0, 2) == '08') {
                                    return '+62' . substr($phone, 1);
                                }
                                return $phone;
                            }
                        @endphp
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @php
                                        // Mengonversi nomor telepon
                                        $convertedPhone = $user->phone ? convertPhoneNumber($user->phone) : 'No Phone';
                                    @endphp
                                    <a class="text-success" href="https://wa.me/{{ $convertedPhone }}" target="_blank">
                                        {{ $convertedPhone }}
                                    </a>
                                </td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->email_verified_at ? 'Yes' : 'No' }}</td>
                                <td>{{ $user->status }}</td>
                                <td>
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm my-1"><i
                                            class="fas fa-edit"></i></a>
                                    <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}"
                                        class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#confirmDeleteModal" data-id="{{ $user->id }}">
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
