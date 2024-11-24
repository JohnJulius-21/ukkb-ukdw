<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\PendataanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TentangController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('beranda'); // Ganti 'home' dengan rute halaman utama Anda
    }
    return redirect()->route('login');
});


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi');
Route::get('/informasi/{id}/show', [InformasiController::class, 'show'])->name('informasi.show');
Route::get('/informasi/formapa', [InformasiController::class, 'formapa'])->name('formapa');
Route::get('/informasi/imt', [InformasiController::class, 'imt'])->name('imt');

Route::middleware(['auth', 'mahasiswa'])->group(function () {
    Route::get('/pendataan', [PendataanController::class, 'index'])->name('pendataan');
    Route::get('/pendataan/create', [PendataanController::class, 'create'])->name('pendataan.create');
    Route::post('/pendataan', [PendataanController::class, 'store'])->name('pendataan.store');
    Route::get('/pendataan/{id}/edit', [PendataanController::class, 'edit'])->name('pendataan.edit');
    Route::put('/pendataan/{id}', [PendataanController::class, 'update'])->name('pendataan.update');
    Route::delete('/pendataan/{id}', [PendataanController::class, 'destroy'])->name('pendataan.destroy');

    route::get('/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan');
    route::get('/kegiatan/create', [KegiatanController::class, 'create'])->name('tambah.kegiatan');
    Route::post('/kegiatan/store', [KegiatanController::class, 'store'])->name('kegiatan.store');
    Route::get('/kegiatan/{id}/edit', [KegiatanController::class, 'edit'])->name('kegiatan.edit');
    Route::put('/kegiatan/{id}', [KegiatanController::class, 'update'])->name('kegiatan.update');
    Route::delete('/kegiatan/{id}', [KegiatanController::class, 'destroy'])->name('kegiatan.destroy');

    route::get('/beranda/{id}', [TentangController::class, 'index'])->name('beranda');
    route::get('/tentang/{id}/index', [TentangController::class, 'indexTentang'])->name('tentang.index');
    Route::get('/tentang/{id}/edit', [TentangController::class, 'edit'])->name('tentang.edit');
    Route::put('/tentang/{id}', [TentangController::class, 'update'])->name('tentang.update');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/ukkb/create', [AdminController::class, 'create'])->name('ukkb.create');
    Route::get('/ukkb/showUkkb', [AdminController::class, 'showUkkb'])->name('ukkb.all');
    Route::get('ukkb/{id}/{tab?}', [AdminController::class, 'show'])->name('ukkb.show');
    Route::post('/ukkb/store', [AdminController::class, 'store'])->name('ukkb.store');
    Route::get('/ukkb/{id}/edit', [AdminController::class, 'edit'])->name('ukkb.edit');
    Route::put('/ukkb/{id}/update', [AdminController::class, 'update'])->name('ukkb.update');
    Route::delete('/ukkb/{id}/destroy', [AdminController::class, 'destroy'])->name('ukkb.destroy');
    Route::put('/ukkb/{id}/update', [AdminController::class, 'updateTentang'])->name('ukkb.updateTentang');
    Route::post('/ukkb/{id}/store-anggota', [AdminController::class, 'storeAnggota'])->name('ukkb.storeAnggota');
    Route::put('/ukkb/{id}/update-anggota', [AdminController::class, 'updateAnggota'])->name('ukkb.updateAnggota');
    Route::delete('/ukkb/{id}/destroy-anggota', [AdminController::class, 'destroyAnggota'])->name('ukkb.destroyAnggota');
    Route::post('/ukkb/{id}/store-kegiatan', [AdminController::class, 'storeKegiatan'])->name('ukkb.storeKegiatan');
    Route::put('/ukkb/{id}/update-kegiatan', [AdminController::class, 'updateKegiatan'])->name('ukkb.updateKegiatan');
    Route::delete('/ukkb/{id}/destroy-kegiatan', [AdminController::class, 'destroyKegiatan'])->name('ukkb.destroyKegiatan');

});