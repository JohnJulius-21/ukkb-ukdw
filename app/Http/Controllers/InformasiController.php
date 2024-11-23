<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

class InformasiController extends Controller
{
    public function index()
    {
        $data = Laporan::all();
        $laporan = Laporan::with('user', 'files')->orderBy('created_at', 'desc')->paginate(3); // 4 laporan per halaman
        // dd($laporan);
        $latestLaporan = $data->sortByDesc('created_at')->take(4);
        return view('informasi.index', compact(['laporan', 'latestLaporan']));
    }

    public function show($id)
    {
        // Mengambil laporan dengan relasi 'user' dan 'files' berdasarkan id
        $laporan = Laporan::with('user', 'files')->findOrFail($id);
        // dd($laporan);
        // Mengembalikan view dengan data laporan
        return view('informasi.show', compact('laporan'));
    }

    public function formapa()
    {
        // Fetch laporan where user_id = 1
        $laporanUser1 = Laporan::with('user', 'files')->where('user_id', 1)->orderBy('created_at', 'desc')->paginate(3);
        return view('informasi.formapa', compact('laporanUser1'));
    }

    public function imt()
    {
        // Fetch laporan where user_id = 2
        $laporanUser2 = Laporan::with('user', 'files')->where('user_id', 2)->orderBy('created_at', 'desc')->paginate(3);
        return view('informasi.imt', compact('laporanUser2'));
    }


}
