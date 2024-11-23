<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PendataanController;
use App\Http\Controllers\AuthController;
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
        return redirect()->route('laporan'); // Ganti 'home' dengan rute halaman utama Anda
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

    route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    route::get('/laporan/create', [LaporanController::class, 'create'])->name('tambah.laporan');
    Route::post('/laporan/store', [LaporanController::class, 'store'])->name('laporan.store');
    Route::get('/laporan/{id}/edit', [LaporanController::class, 'edit'])->name('laporan.edit');
    Route::put('/laporan/{id}', [LaporanController::class, 'update'])->name('laporan.update');
    Route::delete('/laporan/{id}', [LaporanController::class, 'destroy'])->name('laporan.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/ukkb/index', [AdminController::class, 'index'])->name('ukkb.index');
    Route::get('/ukkb/create', [AdminController::class, 'create'])->name('ukkb.create');
    Route::get('/ukkb/showUkkb', [AdminController::class, 'showUkkb'])->name('ukkb.all');
    Route::get('ukkb/{id}/{tab?}', [AdminController::class, 'show'])->name('ukkb.show');
    Route::post('/ukkb/store', [AdminController::class, 'store'])->name('ukkb.store');
    Route::get('/ukkb/{id}/edit', [AdminController::class, 'edit'])->name('ukkb.edit');
    Route::put('/ukkb/{id}/update', [AdminController::class, 'update'])->name('ukkb.update');
    Route::delete('/ukkb/{id}/destroy', [AdminController::class, 'destroy'])->name('ukkb.destroy');
    
});