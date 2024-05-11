@extends('admin.layouts.app')

@section('content')
    <div class="container py-3 px-3">
        <h1>Generate Report</h1>

        <form action="{{ route('admin.reports.generate') }}" method="GET">
            <div class="mb-3">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Generate Report</button>
        </form>
    </div>
@endsection
