<?php

namespace App\Http\Controllers;

use App\Models\PembelianDetail;
use App\Models\PenjualanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function index()
    {
        // Total Produk Terjual
        $totalProdukTerjual = PenjualanDetail::sum('Jumlah');

        // Total Uang Masuk
        $totalUangMasuk = PenjualanDetail::join('obats', 'penjualan_details.KdObat', '=', 'obats.id')
            ->select(DB::raw('SUM(obats.HargaJual * penjualan_details.Jumlah) as total'))
            ->value('total');

        // Total Uang Keluar
        $totalUangKeluar = PembelianDetail::join('obats', 'pembelian_details.KdObat', '=', 'obats.id')
            ->select(DB::raw('SUM(obats.HargaBeli * pembelian_details.Jumlah) as total'))
            ->value('total');

        // Total Laba
        $totalLaba = $totalUangMasuk - $totalUangKeluar;

        return view('index', compact('totalProdukTerjual', 'totalUangMasuk', 'totalUangKeluar', 'totalLaba'));
    }
}
