<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\Models\Obat;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detail($id)
    {
        $data = Obat::with('supplier')->findOrFail($id);
        return view('pages.product.detail', compact('data'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $datatable)
    {
        $product = Obat::all();
        $suppliers = Supplier::all();
        // dd($product);
        return $datatable->render('pages.product.index', compact('product', 'suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'jenis' => 'nullable|string',
            'satuan' => 'nullable|string',
            'harga_beli' => 'nullable|numeric',
            'harga_jual' => 'nullable|numeric',
            'stok' => 'nullable|numeric',
            'supplier' => 'required|exists:suppliers,id',
        ]);

        $send = Obat::create([
            'NmObat' => $validated['nama_obat'],
            'Jenis' => $validated['jenis'],
            'Satuan' => $validated['satuan'],
            'HargaBeli' => $validated['harga_beli'],
            'HargaJual' => $validated['harga_jual'],
            'Stok' => $validated['stok'],
            'KdSupplier' => $validated['supplier'],
        ]);

        // dd($send);

        return response()->json(['success' => 'Data obat berhasil ditambahkan.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Obat::with('supplier')->findOrFail($id);
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // $product = Product::findOrFail($id);
        // $product->gambar_url = asset('storage/' . $product->gambar);
        // $categories = Category::all();
        // return response()->json(['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'jenis' => 'nullable|string',
            'satuan' => 'nullable|string',
            'harga_beli' => 'nullable|numeric',
            'harga_jual' => 'nullable|numeric',
            'supplier' => 'required|exists:suppliers,id',
        ]);

        $obat = Obat::findOrFail($id);

        $obat->update([
            'NmObat' => $request->nama_obat,
            'Jenis' => $request->jenis,
            'Satuan' => $request->satuan,
            'HargaBeli' => $request->harga_beli,
            'HargaJual' => $request->harga_jual,
            'KdSupplier' => $request->supplier,
        ]);

        return response()->json(['success' => 'Data obat berhasil diperbarui']);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Obat::findOrFail($id)->delete();
        return response()->json(['success' => 'Data obat berhasil dihapus']);
    }
}
