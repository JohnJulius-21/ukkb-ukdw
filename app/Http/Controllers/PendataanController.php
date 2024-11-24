<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendataanController extends Controller
{
    public function index()
    {
        // Ambil ID user yang sedang login
        $userId = Auth::id();
        $mahasiswa = Mahasiswa::where('user_id',$userId)->get();
        return view("user.pendataan.index", compact('mahasiswa'));
    }

    public function create()
    {
        return view("user.pendataan.create");
    }

    // Menyimpan data mahasiswa
    public function store(Request $request)
    {
        // dd($request->all());
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|unique:mahasiswas',
            'fakultas' => 'required',
            'prodi' => 'required',
            'nomor_hp' => 'required|string|max:15',
        ]);

        // Menyimpan data mahasiswa
        $mahasiswa = new Mahasiswa();
        $mahasiswa->user_id = Auth::id();
        $mahasiswa->nama_mahasiswa = $validatedData['nama'];
        $mahasiswa->nim = $validatedData['nim'];
        $mahasiswa->fakultas = $validatedData['fakultas'];
        $mahasiswa->prodi = $validatedData['prodi'];
        $mahasiswa->nomor_hp = $validatedData['nomor_hp'];
        $mahasiswa->save();

        // Redirect ke halaman pendataan dengan pesan sukses
        return redirect()->route('pendataan')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        // dd($mahasiswa);
        return view('user.pendataan.edit', compact('mahasiswa'));
    }

    // Memperbarui data mahasiswa
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string',
            'fakultas' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:15',
        ]);

        // Update data mahasiswa
        $mahasiswa->nama_mahasiswa = $validatedData['nama'];
        $mahasiswa->nim = $validatedData['nim'];
        $mahasiswa->fakultas = $validatedData['fakultas'];
        $mahasiswa->prodi = $validatedData['prodi'];
        $mahasiswa->nomor_hp = $validatedData['nomor_hp'];
        $mahasiswa->update();

        // Redirect ke halaman pendataan dengan pesan sukses
        return redirect()->route('pendataan')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    // Menghapus data mahasiswa
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        // Redirect ke halaman pendataan dengan pesan sukses
        return redirect()->route('pendataan')->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
