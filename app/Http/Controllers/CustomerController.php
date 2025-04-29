<?php

namespace App\Http\Controllers;

use App\DataTables\CostumerDataTable;
use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CostumerDataTable $datatable)
    {
        $customer = Pelanggan::all();
        // dd($customer);
        return $datatable->render('pages.customer.index', compact('customer'));
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
            'nama_pelanggan' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'alamat' => 'nullable|string|max:255',
            'kota' => 'nullable|string|max:255',
            'telpon' => 'nullable|string|max:20',
        ]);

        $user = User::create([
            'name' => $request->nama_pelanggan,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        Pelanggan::create([
            'NmPelanggan' => $request->nama_pelanggan,
            'id_user' => $user->id,
            'Alamat' => $request->alamat,
            'Kota' => $request->kota,
            'Telpon' => $request->telpon,
        ]);

        return response()->json(['success' => 'Pelanggan berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Pelanggan::with('user')->findOrFail($id);
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
            'nama_pelanggan' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8',
            'alamat' => 'nullable|string|max:255',
            'kota' => 'nullable|string|max:255',
            'telpon' => 'nullable|string|max:20',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);
        $user = User::findOrFail($pelanggan->id_user);

        // Update tabel user
        $user->name = $request->nama_pelanggan;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password); // pastikan password di-hash
        }

        $user->save();

        $pelanggan->update([
            'NmPelanggan' => $request->nama_pelanggan,
            'Alamat' => $request->alamat,
            'Kota' => $request->kota,
            'Telpon' => $request->telpon,
        ]);

        return response()->json(['success' => 'Pelanggan berhasil diperbarui']);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Pelanggan::findOrFail($id)->delete();
        return response()->json(['success' => 'Pelanggan berhasil dihapus']);
    }
}
