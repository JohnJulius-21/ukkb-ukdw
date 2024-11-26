<?php

namespace App\Http\Controllers;

use App\Models\Ukkb;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AkunController extends Controller
{
    public function index($id)
    {
        $userId = Auth::id();
        $selectedUkkb = Ukkb::findOrFail($id);
        $user = User::where('ukkb_id', $id)->get();
        // dd($user);
        return view('user.akun.index', compact('selectedUkkb','user'));
    }

    public function edit($id){
        $selectedUkkb = Ukkb::findOrFail($id);
        $user = User::where('ukkb_id', $id)->get();
        return view('user.akun.edit', compact('selectedUkkb','user'));
    }

    public function update(Request $request, $id)
{
    // Validasi input
    $validatedData = $request->validate([
        'nama_ukkb' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'nullable|string|min:6',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Ambil data UKKB berdasarkan ID
    $ukkb = Ukkb::findOrFail($id);

    // Update tabel UKKB
    $ukkb->nama_ukkb = $validatedData['nama_ukkb'];
    $ukkb->save();

    // Update tabel User berdasarkan relasi ukkb_id
    $user = User::where('ukkb_id', $id)->first(); // Ambil user terkait
    if ($user) {
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        // Jika password diisi, update password
        if (!empty($validatedData['password'])) {
            $user->password = bcrypt($validatedData['password']);
        }

        // Jika file logo diunggah, simpan file
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/logos'), $filename);
            $ukkb->logo = $filename; // Simpan nama file di tabel ukkbs
            $ukkb->save();
        }

        $user->save(); // Simpan perubahan pada tabel user
    }

    // Redirect dengan pesan sukses
    return redirect()->route('akun', ['id' => $id])
        ->with('success', 'Data akun berhasil diperbarui.');
}

}
