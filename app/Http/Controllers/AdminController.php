<?php

namespace App\Http\Controllers;

use App\Models\Ukkb;
use App\Models\User;
use App\Models\Laporan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $ukkb = Ukkb::all();
        return view('admin.index', compact('ukkb'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function showUKKB()
    {
        $ukkb = Ukkb::all();
        return view('admin.ukkb', compact('ukkb'));
    }

    public function show($id, $tab = 'show')
    {
        $ukkb = Ukkb::all(); // Memuat semua data UKKB
        $selectedUkkb = Ukkb::findOrFail($id); // Menampilkan UKKB berdasarkan ID yang diterima
        // dd($selectedUkkb);

        $edit = request()->has('edit'); // Cek apakah ada parameter 'edit'

        // Ambil pengguna berdasarkan ukkb_id yang sesuai dengan UKKB yang sedang dibuka
        $users = User::where('ukkb_id', $id)->get();

        // Ambil data laporan dan mahasiswa terkait dengan UKKB
        $laporans = Laporan::whereIn('user_id', $users->pluck('id'))->get();
        $mahasiswas = Mahasiswa::whereIn('user_id', $users->pluck('id'))->get();

        // Kirim data ke view
        return view('admin.show', compact('ukkb', 'selectedUkkb', 'users', 'laporans', 'mahasiswas', 'tab', 'edit'));

    }



    // Fungsi untuk menyimpan data baru (store)
    public function store(Request $request)
    {
        $request->validate([
            'nama_ukkb' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id',
        ]);

        // Upload logo UKKB (opsional)
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('ukkb_logos', 'public');
        }

        // Simpan UKKB
        $ukkb = Ukkb::create([
            'nama_ukkb' => $request->nama_ukkb,
            'logo' => $logoPath,
            'deskripsi' => $request->deskripsi,
        ]);

        // Assign user ke UKKB (jika ada)
        if ($request->user_id) {
            $user = User::find($request->user_id);
            $user->ukkb_id = $ukkb->id;
            $user->save();
        }

        return redirect()->route('ukkb.index')->with('success', 'UKKB berhasil ditambahkan!');
    }


    // Fungsi untuk menampilkan form edit
    public function edit($id)
    {
        $ukkb = Ukkb::findOrFail($id);
        return view('admin.edit', compact('ukkb'));
    }

    // Fungsi untuk memperbarui data (update)
    public function update(Request $request, $id)
    {
        $ukkb = Ukkb::findOrFail($id);

        // Validasi input
        $request->validate([
            'nama_ukkb' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'required|string',
        ]);

        // Handle file upload jika ada
        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($ukkb->logo) {
                Storage::disk('public')->delete($ukkb->logo);
            }

            // Simpan logo baru
            $ukkb->logo = $request->file('logo')->store('logos', 'public');
        }

        // Perbarui data di database
        $ukkb->update([
            'nama_ukkb' => $request->nama_ukkb,
            'deskripsi' => $request->deskripsi,
            'logo' => $ukkb->logo,
        ]);

        return redirect()->route('ukkb')->with('success', 'UKKB berhasil diperbarui!');
    }

    // Fungsi untuk menghapus data (destroy)
    public function destroy($id)
    {
        $ukkb = Ukkb::findOrFail($id);

        // Hapus logo jika ada
        if ($ukkb->logo) {
            Storage::disk('public')->delete($ukkb->logo);
        }

        // Hapus data dari database
        $ukkb->delete();

        return redirect()->route('ukkb')->with('success', 'UKKB berhasil dihapus!');
    }
}
