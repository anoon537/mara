@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-3 px-3">
        @if (session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="container-fluid p-4 rounded shadow-lg" style="background-color: #fefeff;">
            <form action="{{ route('admin.log.index') }}" method="GET" class="mb-3">
                <div class="input-group mb-2">
                    <input type="text" name="search" class="form-control"
                        placeholder="Search by Booking ID or User Name Or Booking Date" value="{{ request('search') }}">
                    <button type="submit" class="btn"><i class="fas fa-search me-2"></i>Search</button>
                </div>
            </form>
            <div class="table-responsive table-scrollable">
                <table class="table">
                    <thead style="vertical-align: middle;">
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                            <th>Entity</th>
                            <th>Details</th>
                            <th>Timestamp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activityLogs as $log)
                            <tr>
                                <td>{{ $log->user->name }}</td>
                                <td>{{ $log->action }}</td>
                                <td>{{ $log->entity }}</td>
                                <td>{{ $log->details }}</td>
                                <td>{{ \Carbon\Carbon::parse($log->created_at)->format('d F Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
