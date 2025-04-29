@extends('components.app')
@section('title', 'Home Page')
@section('konten')

    {{-- title konten --}}
    <div class="body-title">
        <h1 class="text-uppercase mt-2">Home Page</h1>
    </div>
    {{-- card --}}
    <div class="body-container">
        <div class="row">
            <!-- Card: Total Produk -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalProdukTerjual }}</h3>
                        <p>Total Produk Terjual</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <a href="{{ route('report.index') }}" class="small-box-footer">Info Lebih Lanjut <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Card: Total Uang Masuk -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>Rp {{ number_format($totalUangMasuk, 0, ',', '.') }}</h3>
                        <p>Total Uang Masuk</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <a href="{{ route('report.index') }}" class="small-box-footer">Info Lebih Lanjut <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Card: Total Uang Keluar -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>Rp {{ number_format($totalUangKeluar, 0, ',', '.') }}</h3>
                        <p>Total Uang Keluar</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                    <a href="{{ route('report.index') }}" class="small-box-footer">Info Lebih Lanjut <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Card: Total Laba -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3 class=" text-white">Rp {{ number_format($totalLaba, 0, ',', '.') }}</h3>
                        <p class=" text-white">Total Laba</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-coins"></i>
                    </div>
                    <a href="{{ route('report.index') }}" class="small-box-footer text-white">Info Lebih Lanjut <i
                            class="fas fa-arrow-circle-right" style="color: white"></i></a>
                </div>
            </div>
        </div>
    </div>
@endsection
