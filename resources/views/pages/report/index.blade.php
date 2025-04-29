@extends('components.app')

@section('title', 'Laporan Transaksi')

@section('konten')
    <!-- Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">Laporan Transaksi</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('landing.index') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Laporan Transaksi</li>
                </ol>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    {{ $dataTable->table(['class' => 'table table-striped table-hover table-bordered align-middle fw-semibold fs-5']) }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
