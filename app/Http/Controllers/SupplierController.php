<?php

namespace App\Http\Controllers;

use App\DataTables\SupplierDataTable;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SupplierDataTable $datatable)
    {
        $supplier = Supplier::all();
        // dd($supplier);
        return $datatable->render('pages.supplier.index', compact('supplier'));
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
        $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'kota' => 'nullable|string|max:255',
            'telpon' => 'nullable|string|max:20',
        ]);

        Supplier::create([
            'NmSupplier' => $request->nama_supplier,
            'Alamat' => $request->alamat,
            'Kota' => $request->kota,
            'Telpon' => $request->telpon,
        ]);

        return response()->json(['success' => 'Data supplier berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Supplier::findOrFail($id);
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
            'nama_supplier' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'kota' => 'nullable|string|max:255',
            'telpon' => 'nullable|string|max:20',
        ]);

        $supplier = Supplier::findOrFail($id);

        $supplier->update([
            'NmSupplier' => $request->nama_supplier,
            'Alamat' => $request->alamat,
            'Kota' => $request->kota,
            'Telpon' => $request->telpon,
        ]);

        return response()->json(['success' => 'Data supplier berhasil diperbarui']);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Supplier::findOrFail($id)->delete();
        return response()->json(['success' => 'Data supplier berhasil dihapus']);
    }
}
