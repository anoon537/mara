@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-3 px-3">
        <div class="container-fluid p-4 rounded shadow-lg" style="background-color: #fefeff;">
            <h1 class="fw-bold text-center">LAPORAN TRANSAKSI MARA STUDIO</h1>
            <form action="{{ route('admin.reports.generate') }}" method="GET">
                <div class="mb-3">
                    <label for="start_date">Start Date</label>
                    <input type="date" name="start_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="end_date">End Date</label>
                    <input type="date" name="end_date" class="form-control" required>
                </div>
                <button type="submit" class="btn">Generate Report</button>
            </form>
        </div>
    </div>
@endsection
