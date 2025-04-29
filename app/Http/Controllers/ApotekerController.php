<?php

namespace App\Http\Controllers;

use App\DataTables\ApotekerDataTable;
use App\DataTables\CostumerDataTable;
use App\Models\Apoteker;
use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Http\Request;

class ApotekerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ApotekerDataTable $datatable)
    {
        $apoteker = Apoteker::all();
        // dd($customer);
        return $datatable->render('pages.apoteker.index', compact('apoteker'));
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
            'nama_apoteker' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'alamat' => 'nullable|string|max:255',
            'kota' => 'nullable|string|max:255',
            'telpon' => 'nullable|string|max:20',
        ]);

        $user = User::create([
            'name' => $request->nama_apoteker,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        Apoteker::create([
            'NmApoteker' => $request->nama_apoteker,
            'id_user' => $user->id,
            'Alamat' => $request->alamat,
            'Kota' => $request->kota,
            'Telpon' => $request->telpon,
        ]);

        return response()->json(['success' => 'Apoteker berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Apoteker::with('user')->findOrFail($id);
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
            'nama_apoteker' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8',
            'alamat' => 'nullable|string|max:255',
            'kota' => 'nullable|string|max:255',
            'telpon' => 'nullable|string|max:20',
        ]);

        $apoteker = Apoteker::findOrFail($id);
        $user = User::findOrFail($apoteker->id_user);

        // Update tabel user
        $user->name = $request->nama_apoteker;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password); // pastikan password di-hash
        }

        $user->save();

        // Update tabel apoteker
        $apoteker->update([
            'NmApoteker' => $request->nama_apoteker,
            'Alamat' => $request->alamat,
            'Kota' => $request->kota,
            'Telpon' => $request->telpon,
        ]);

        return response()->json(['success' => 'Apoteker berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Apoteker::findOrFail($id)->delete();
        return response()->json(['success' => 'Apoteker berhasil dihapus']);
    }
}
