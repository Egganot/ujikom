@extends('components.app')
@section('title', 'Detail ' . $data->NmObat . ' Page')
@section('konten')
    {{-- title konten --}}
    <div class="body-title">
        <div class="row">
            <div class="col-md-6">
                <h1 class="text-uppercase mt-2">Detail Produk</h1>
            </div>
            <div class="col-md-6">
                <h4 class="text-end mt-3"><a href="/">Home</a> / {{ $data->NmObat }}
                </h4>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <button type="button" class="btn btn-secondary">
                    <a href="/" class="text-white" style="text-decoration: none">
                        <i class="fas fa-long-arrow-alt-left"></i> Kembali</a>
                </button>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <h1>{{ $data->NmObat }}</h1>
                <h2>Obat {{ $data->Jenis }}</h2>
                <p>{{ $data->HargaBeli }}</p>
                @if (Auth::check())
                <form action="{{ route('produk.beli', $data->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-cart-plus"></i> Beli Sekarang
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
@endsection
