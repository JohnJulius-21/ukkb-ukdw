<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Fungsi untuk menampilkan form registrasi
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Fungsi untuk menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Fungsi untuk registrasi
    public function register(Request $request)
    {
        // Validasi data yang diterima
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Jika validasi gagal, kembalikan ke form registrasi dengan pesan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Buat user baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Berhasil mendaftarkan akun! Silakan login.');
    }


    // Fungsi untuk login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Cek kredensial
        if (!Auth::attempt($request->only('email', 'password'))) {
            return redirect()->back()->with('error', 'Kredensial tidak valid.')->withInput();
        }

        // Ambil user yang login
        $user = Auth::user();

        // Ambil data UKKB yang terkait
        $ukkb = $user->ukkb;

        // Simpan logo di session
        
        // dd($logo);

        // Redirect sesuai peran
        if ($user->role === 'admin') {
            return redirect()->route('admin.index')->with('success', 'Login berhasil sebagai Admin!');
        } elseif ($user->role === 'mahasiswa') {
            
            return redirect()->route('beranda', ['id' => $user->ukkb->id])->with([
                'success' => 'Login berhasil sebagai Mahasiswa!',
                'ukkb' => $ukkb, // Kirim data UKKB jika diperlukan
            ]);
        } else {
            return redirect()->back()->with('error', 'Peran pengguna tidak valid.')->withInput();
        }
    }


    // Fungsi untuk logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'User telah Logout!');
    }
}
