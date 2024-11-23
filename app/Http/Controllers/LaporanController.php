<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index()
    {
        // Ambil ID user yang sedang login
        $userId = Auth::id();
        $laporan = Laporan::where('user_id',$userId)->get();
        // dd($laporan);
        return view("user.laporan.index", compact('laporan'));
    }

    public function create()
    {
        return view("user.laporan.create");
    }

    public function store(Request $request)
    {
        // Step 1: Validate the form data
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'files.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048', // Adjust types as needed
            'deskripsi' => 'required',
        ]);

        // Step 2: Save the main report data in the database
        $laporan = new Laporan();
        $laporan->user_id = Auth::id(); // atau auth()->id()
        $laporan->judul_laporan = $validatedData['judul'];
        $laporan->tanggal_laporan = $validatedData['tanggal'];
        $laporan->deskripsi_laporan = $validatedData['deskripsi'];
        $laporan->save();

        // Step 3: Handle file uploads, if any
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                // Store each file and get its path
                $path = $file->store('laporan_files');

                // Save each file entry in the `files` table
                $laporan->files()->create([
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                ]);
            }
        }


        // Step 4: Redirect or return success response
        return redirect()->route('laporan')->with('success', 'Laporan berhasil disimpan.');
    }

    public function edit($id)
    {
        // Mencari laporan berdasarkan ID
        $laporan = Laporan::findOrFail($id);

        // Menampilkan view edit dengan data laporan
        return view("user.laporan.edit", compact('laporan'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data form
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'files.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048', // Adjust types as needed
            'deskripsi' => 'required',
        ]);

        // Cari laporan berdasarkan ID
        $laporan = Laporan::findOrFail($id);

        // Update data laporan
        $laporan->judul_laporan = $validatedData['judul'];
        $laporan->tanggal_laporan = $validatedData['tanggal'];
        $laporan->deskripsi_laporan = $validatedData['deskripsi'];
        $laporan->save();

        // Handle file upload if any (optional)
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('laporan_files');

                // Jika Anda ingin menyimpan file baru, sesuaikan logika di bawah
                $laporan->files()->create([
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                ]);
            }
        }

        // Redirect ke halaman laporan dengan pesan sukses
        return redirect()->route('laporan')->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Cari laporan berdasarkan ID
        $laporan = Laporan::findOrFail($id);

        // Hapus laporan
        $laporan->delete();

        // Redirect ke halaman laporan dengan pesan sukses
        return redirect()->route('laporan')->with('success', 'Laporan berhasil dihapus.');
    }


}
