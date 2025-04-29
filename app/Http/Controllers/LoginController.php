<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    function index()
    {
        return view('pages.login.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email Wajib Diisi',
            'email.email' => 'Format Email Tidak Valid',
            'password.required' => 'Password Wajib Diisi'
        ]);

        Log::info('Login attempt for email: ' . $request->email);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // ✅ Hindari session fixation
            $user = Auth::user();
            Log::info('Login success. User ID: ' . $user->id . ', Role: ' . $user->role);

            switch ($user->role) {
                case 'superAdmin':
                    return redirect()->intended('/dashboard');
                case 'admin':
                case 'user':
                    return redirect()->intended('/');
                default:
                    Auth::logout();
                    return redirect('login')->withErrors(['login' => 'Role pengguna tidak dikenali.']);
            }
        }

        Log::warning('Login failed for email: ' . $request->email);
        return redirect('login')->withErrors(['login' => 'Username atau password salah'])->withInput();
    }

    function regis()
    {
        return view('pages.register.index');
    }

    public function register(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'nama' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'alamat' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
        ]);

        DB::beginTransaction();
        try {
            // Simpan ke tabel users
            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'user',
            ]);

            // Simpan ke tabel pelanggans
            Pelanggan::create([
                'NmPelanggan' => $request->nama,
                'Alamat' => $request->alamat,
                'Kota' => $request->kota,
                'Telpon' => $request->telepon,
                'id_user' => $user->id,
            ]);

            DB::commit();

            return redirect()->route('login.index')->with('success', 'Registrasi berhasil. Silakan login.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat registrasi.'])->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
