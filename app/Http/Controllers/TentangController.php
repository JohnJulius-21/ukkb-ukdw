<?php

namespace App\Http\Controllers;

use App\Models\Ukkb;
use Illuminate\Http\Request;

class TentangController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function indexTentang($id)
    {
        $ukkb = Ukkb::all(); // Memuat semua data UKKB
        $selectedUkkb = Ukkb::findOrFail($id);
        return view('user.tentang.index', compact('ukkb', 'selectedUkkb'));
    }

    // Fungsi untuk menampilkan form edit UKKB
    public function edit($id)
    {
        // Ambil data UKKB berdasarkan ID
        $ukkb = Ukkb::findOrFail($id);

        // Tampilkan form edit dengan data UKKB yang dipilih
        return view('user.tentang.edit', compact('ukkb'));
    }

    // Fungsi untuk memperbarui data UKKB
    public function update(Request $request, $id)
    {
        // Validasi input dari form
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        // Cari data UKKB berdasarkan ID
        $ukkb = Ukkb::findOrFail($id);

        // Perbarui data UKKB
        $ukkb->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
        ]);

        // Redirect ke halaman tentang dengan pesan sukses
        return redirect()->route('tentang.index', $id)
            ->with('success', 'Data UKKB berhasil diperbarui.');
    }
}
