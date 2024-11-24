<?php

namespace App\Http\Controllers;

use App\Models\Ukkb;
use App\Models\Laporan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TentangController extends Controller
{
    public function index($id)
    {
        $userId = Auth::id();
        $kegiatan = Laporan::where('user_id', $userId)->get();
        // Mengambil jumlah anggota berdasarkan user_id
        $jumlahAnggota = Mahasiswa::where('user_id', $userId)->count();
        // Mengambil jumlah kegiatan berdasarkan user_id
        $jumlahKegiatan = Laporan::where('user_id', $userId)->count();
        $ukkb = Ukkb::all(); // Memuat semua data UKKB
        $selectedUkkb = Ukkb::findOrFail($id);
        return view('user.index', compact('ukkb', 'selectedUkkb', 'jumlahAnggota', 'jumlahKegiatan', 'kegiatan'));
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
            'sejarah' => 'required|string|max:1000',
            'visi' => 'required|string|max:1000',
            'misi' => 'required|string|max:1000',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_struktur_organisasi' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'badan_pengurus_harian' => 'required|string|max:1000',
            'instagram' => 'nullable',
            'email' => 'nullable|email|max:255',
            'nomor_wa' => 'nullable|string|max:15',
        ]);

        // Cari data UKKB berdasarkan ID
        $ukkb = Ukkb::findOrFail($id);

        // Upload file jika ada
        $logoPath = $ukkb->logo;
        $strukturPath = $ukkb->foto_struktur_organisasi;

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        if ($request->hasFile('foto_struktur_organisasi')) {
            $strukturPath = $request->file('foto_struktur_organisasi')->store('struktur_organisasi', 'public');
        }

        // Perbarui data UKKB
        $ukkb->update([
            'sejarah' => $request->sejarah,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'logo' => $logoPath,
            'foto_struktur_organisasi' => $strukturPath,
            'badan_pengurus_harian' => $request->badan_pengurus_harian,
            'instagram' => $request->instagram,
            'email' => $request->email,
            'nomor_wa' => $request->nomor_wa,
        ]);

        // Redirect ke halaman tentang dengan pesan sukses
        return redirect()->route('tentang.index', ['id' => $id])
            ->with('success', 'Data UKKB berhasil diperbarui.');
    }

}
