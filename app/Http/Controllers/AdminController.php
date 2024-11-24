<?php

namespace App\Http\Controllers;

use App\Models\Ukkb;
use App\Models\User;
use App\Models\Laporan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $ukkb = Ukkb::all();
        $kegiatan = Laporan::all();
        $totalUkkb = Ukkb::count();
        $totalMahasiswa = Mahasiswa::count();
        $totalKegiatan = Laporan::count();
        return view('admin.index', compact('ukkb', 'kegiatan', 'totalUkkb', 'totalMahasiswa', 'totalKegiatan'));
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

    public function show($id, Request $request, $tab = 'show')
    {
        $ukkb = Ukkb::all(); // Memuat semua data UKKB
        $selectedUkkb = Ukkb::findOrFail($id); // Menampilkan UKKB berdasarkan ID yang diterima

        $edit = request()->has('edit'); // Cek apakah ada parameter 'edit'
        $create = request()->has('create'); // Cek apakah ada parameter 'create'

        // Ambil pengguna berdasarkan ukkb_id yang sesuai dengan UKKB yang sedang dibuka
        $users = User::where('ukkb_id', $id)->get();
        $totalUkkb = Ukkb::count();
        $kegiatan = Laporan::whereIn('user_id', $users->pluck('id'))->get();

        // Ambil data laporan terkait dengan UKKB
        $laporans = Laporan::where('ukkb_id', $selectedUkkb->id)->get();

        // dd($laporans);
        // Ambil data mahasiswa berdasarkan `ukkb_id` dari selectedUkkb
        $mahasiswas = Mahasiswa::where('ukkb_id', $selectedUkkb->id)->get();
        // dd($mahasiswas);
        // Mengambil data mahasiswa terbaru berdasarkan waktu pembuatan
        $mahasiswaTerbaru = Mahasiswa::where('ukkb_id', $selectedUkkb->id)
            ->whereDate('created_at', now()->toDateString())
            ->count();

        // Tambahkan data mahasiswa yang spesifik untuk update
        $editMode = $request->input('edit');
        $mahasiswaId = $request->input('mahasiswa_id'); // Ambil mahasiswa_id

        $mahasiswa = null;
        if ($editMode && $mahasiswaId) {
            // Ambil data mahasiswa yang akan diedit
            $mahasiswa = Mahasiswa::where('ukkb_id', $selectedUkkb->id)
                ->where('mahasiswa_id', $mahasiswaId)
                ->first();
        }

        $laporanId = $request->input('laporan_id'); // Ambil laporan_id

        $laporanEdit = null; // Variabel untuk data laporan yang akan diedit
        if ($editMode && $laporanId) {
            // Ambil data laporan yang akan diedit
            $laporanEdit = Laporan::where('ukkb_id', $selectedUkkb->id)
                ->where('laporan_id', $laporanId)
                ->first();
        }


        // Menghitung jumlah anggota dan kegiatan
        $jumlahAnggota = $mahasiswas->count();
        $jumlahKegiatan = Laporan::where('ukkb_id', $selectedUkkb->id)->count();

        // Kirim data ke view
        return view('admin.show', compact(
            'ukkb',
            'selectedUkkb',
            'users',
            'laporans',
            'mahasiswas',
            'mahasiswa',
            'laporanEdit',
            'tab',
            'edit',
            'create',
            'jumlahAnggota',
            'jumlahKegiatan',
            'totalUkkb',
            'kegiatan',
            'mahasiswaTerbaru' // Ditambahkan variabel mahasiswa terbaru
        ));
    }

    public function storeAnggota(Request $request, $ukkbId)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|unique:mahasiswas',
            'fakultas' => 'required',
            'prodi' => 'required',
            'nomor_hp' => 'required|string|max:15',
        ]);

        // Pastikan UKKB ada
        $ukkb = Ukkb::findOrFail($ukkbId);

        // Simpan data mahasiswa
        $mahasiswa = new Mahasiswa();
        $mahasiswa->ukkb_id = $ukkb->id; // Relasi dengan UKKB
        $mahasiswa->user_id = Auth::id(); // Relasi dengan user (admin)
        $mahasiswa->nama_mahasiswa = $validatedData['nama'];
        $mahasiswa->nim = $validatedData['nim'];
        $mahasiswa->fakultas = $validatedData['fakultas'];
        $mahasiswa->prodi = $validatedData['prodi'];
        $mahasiswa->nomor_hp = $validatedData['nomor_hp'];
        $mahasiswa->save();

        // Redirect ke halaman pendataan UKKB
        return redirect()->route('ukkb.show', ['id' => $ukkb->id, 'tab' => 'anggota'])
            ->with('success', 'Mahasiswa berhasil ditambahkan ke UKKB.');
    }

    public function updateAnggota(Request $request, $id)
    {
        $ukkb = Ukkb::findOrFail($id);
        // Validasi input dari form
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Validasi input
        $validatedData = $request->validate([
            'nama_mahasiswa' => 'string|max:255',
            'nim' => 'string',
            'fakultas' => 'string|max:255',
            'prodi' => 'string|max:255',
            'nomor_hp' => 'string|max:15',
        ]);

        // Update data mahasiswa
        $mahasiswa->nama_mahasiswa = $validatedData['nama_mahasiswa'];
        $mahasiswa->nim = $validatedData['nim'];
        $mahasiswa->fakultas = $validatedData['fakultas'];
        $mahasiswa->prodi = $validatedData['prodi'];
        $mahasiswa->nomor_hp = $validatedData['nomor_hp'];
        $mahasiswa->update();

        // Redirect ke halaman tentang dengan pesan sukses
        return redirect()->route('ukkb.show', ['id' => $ukkb->id, 'tab' => 'anggota'])
            ->with('success', 'Data UKKB berhasil diperbarui.');
    }

    public function destroyAnggota(Request $request, $id)
    {
        // Ambil mahasiswa_id dari request
        $mahasiswaId = $request->input('mahasiswa_id');

        // Temukan mahasiswa berdasarkan ukkb_id dan mahasiswa_id
        $mahasiswa = Mahasiswa::where('ukkb_id', $id)
            ->where('mahasiswa_id', $mahasiswaId)
            ->first();

        if ($mahasiswa) {
            // Hapus data mahasiswa
            $mahasiswa->delete();

            return redirect()->route('ukkb.show', ['id' => $id, 'tab' => 'anggota'])
                ->with('success', 'Mahasiswa berhasil dihapus.');
        }

        // Jika mahasiswa tidak ditemukan
        return redirect()->route('ukkb.show', ['id' => $id, 'tab' => 'anggota'])
            ->with('error', 'Mahasiswa tidak ditemukan.');
    }

    public function storeKegiatan(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'tempat' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Dokumentasi opsional
        ]);

        // Ambil UKKB yang sesuai
        $ukkb = Ukkb::findOrFail($id);

        // Buat laporan kegiatan baru
        $kegiatan = new Laporan();
        $kegiatan->user_id = Auth::id(); // atau auth()->id()
        $kegiatan->ukkb_id = $ukkb->id;
        $kegiatan->judul_laporan = $validated['judul'];
        $kegiatan->tanggal_laporan = $validated['tanggal'];
        $kegiatan->deskripsi_laporan = $validated['deskripsi'];
        $kegiatan->tempat_kegiatan = $validated['tempat'];
        $kegiatan->save();

        // Simpan file dokumentasi jika ada
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                // Store each file and get its path
                $path = $file->store('laporan_files');

                // Save each file entry in the `files` table
                $kegiatan->files()->create([
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                ]);
            }
        }

        return redirect()->route('ukkb.show', ['id' => $id, 'tab' => 'kegiatan'])
            ->with('success', 'Laporan kegiatan berhasil ditambahkan.');
    }

    public function updateKegiatan(Request $request, $id)
    {
        // Temukan UKKB berdasarkan ID
        $ukkb = Ukkb::findOrFail($id);

        // Cari laporan yang ingin diperbarui berdasarkan ID UKKB
        $laporan = Laporan::where('ukkb_id', $id)->firstOrFail();  // Menggunakan relasi ukkb_id

        // Validasi input
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'tempat' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Update data laporan
        $laporan->update([
            'judul_laporan' => $validated['judul'],
            'tanggal_laporan' => $validated['tanggal'],
            'tempat_kegiatan' => $validated['tempat'],
            'deskripsi_kegiatan' => $validated['deskripsi'],
        ]);

        // Update file dokumentasi jika ada
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filePath = $file->store('dokumentasi', 'public');
                $laporan->files()->create([
                    'file_path' => $filePath,
                    'file_name' => $file->getClientOriginalName(),
                ]);
            }
        }

        return redirect()->route('ukkb.show', ['id' => $ukkb->id, 'tab' => 'kegiatan'])
            ->with('success', 'Laporan kegiatan berhasil diperbarui.');
    }

    public function destroyKegiatan(Request $request, $id)
    {
        // Ambil laporan_id dari request
        $laporanId = $request->input('laporan_id');

        // Temukan laporan berdasarkan ukkb_id dan laporan_id
        $laporan = Laporan::where('ukkb_id', $id)
            ->where('laporan_id', $laporanId)
            ->first();

        if ($laporan) {
            // Hapus data laporan
            $laporan->delete();

            return redirect()->route('ukkb.show', ['id' => $id, 'tab' => 'kegiatan'])
                ->with('success', 'Kegiatan berhasil dihapus.');
        }

        // Jika mahasiswa tidak ditemukan
        return redirect()->route('ukkb.show', ['id' => $id, 'tab' => 'kegiatan'])
            ->with('error', 'Kegiatan tidak ditemukan.');
    }


    public function updateTentang(Request $request, $id)
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
        return redirect()->route('ukkb.show', ['id' => $ukkb->id, 'tab' => 'tentang'])
            ->with('success', 'Data UKKB berhasil diperbarui.');
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
