<?php

namespace App\Http\Controllers;

use App\DataTables\TransactioDataTable;
use App\Models\Obat;
use App\Models\Pelanggan;
use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function beli(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            // Cari data obat
            $obat = Obat::findOrFail($id);
            $pelanggan = Pelanggan::where('id_user', Auth::id())->first();

            if (!$pelanggan) {
                return redirect()->back()->with('error', 'Pelanggan tidak ditemukan.');
            }


            // Buat Penjualan baru
            $penjualan = Penjualan::create([
                'TglNota' => now(),
                'KdPelanggan' => $pelanggan->id,
                'Diskon' => 0, // Misal diskon default 0
            ]);

            // Tambahkan detail penjualan
            PenjualanDetail::create([
                'Nota' => $penjualan->id,
                'KdObat' => $obat->id,
                'Jumlah' => 1, // Misal beli 1 item
            ]);

            // Kurangi stok obat
            $obat->decrement('Stok', 1);

            DB::commit();

            return redirect()->back()->with('success', 'Berhasil membeli produk!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membeli produk. ' . $e->getMessage());
        }
    }

    public function index()
    {
        $suppliers = Supplier::all();
        $customers = Pelanggan::all();
        return view('pages..transaction.index', compact('suppliers', 'customers'));
    }

    public function searchObat(Request $request)
    {
        $obat = Obat::where('NmObat', 'LIKE', '%' . $request->keyword . '%')->get();
        return response()->json($obat);
    }

    public function simpanTransaksi(Request $request)
    {
        if ($request->supplier_id) {
            // Pembelian -> Menambah stok
            $pembelian = Pembelian::create([
                'TglNota' => now(),
                'KdSupplier' => $request->supplier_id,
                'Diskon' => $request->diskon ?? 0,
            ]);

            foreach ($request->barang as $item) {
                PembelianDetail::create([
                    'Nota' => $pembelian->id,
                    'KdObat' => $item['id'],
                    'Jumlah' => $item['jumlah'],
                ]);

                // Tambah stok obat
                $obat = Obat::find($item['id']);
                if ($obat) {
                    $obat->Stok += $item['jumlah'];
                    $obat->save();
                }
            }
        } elseif ($request->customer_id) {
            // Penjualan -> Mengurangi stok
            foreach ($request->barang as $item) {
                $obat = Obat::find($item['id']);
                if (!$obat) {
                    return response()->json(['message' => 'Obat tidak ditemukan.'], 404);
                }
                if ($obat->Stok < $item['jumlah']) {
                    return response()->json([
                        'message' => "Stok obat {$obat->NmObat} tidak mencukupi. Stok tersedia: {$obat->Stok}, jumlah diminta: {$item['jumlah']}"
                    ], 400);
                }
            }

            // Jika semua stok cukup, baru simpan penjualan
            $penjualan = Penjualan::create([
                'TglNota' => now(),
                'KdPelanggan' => $request->customer_id,
                'Diskon' => $request->diskon ?? 0,
            ]);

            foreach ($request->barang as $item) {
                PenjualanDetail::create([
                    'Nota' => $penjualan->id,
                    'KdObat' => $item['id'],
                    'Jumlah' => $item['jumlah'],
                ]);

                // Kurangi stok obat
                $obat = Obat::find($item['id']);
                $obat->Stok -= $item['jumlah'];
                $obat->save();
            }
        } else {
            return response()->json(['message' => 'Pilih Supplier atau Customer'], 400);
        }

        return response()->json(['message' => 'Transaksi berhasil disimpan']);
    }
}
