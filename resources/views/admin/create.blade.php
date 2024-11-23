@extends('layouts.admin')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@section('content')
    <div class="container-fluid">
        <h3 class="main-title mb-5">Tambah UKKB</h3>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Forms Tambah UKKB</h5>
                <form action="{{ route('ukkb.store') }}" method="POST" class="container" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <!-- Nama UKKB -->
                            <div class="mb-3">
                                <label for="nama_ukkb" class="form-label">Nama UKKB</label>
                                <input name="nama_ukkb" type="text" class="form-control" id="nama_ukkb"
                                    placeholder="Masukan Nama UKKB" value="{{ old('nama_ukkb') }}">
                                @error('nama_ukkb')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi UKKB</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="3">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Sejarah -->
                            <div class="mb-3">
                                <label for="sejarah" class="form-label">Sejarah UKKB</label>
                                <textarea class="form-control" name="sejarah" id="sejarah" cols="30" rows="3">{{ old('sejarah') }}</textarea>
                                @error('sejarah')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Visi -->
                            <div class="mb-3">
                                <label for="visi" class="form-label">Visi UKKB</label>
                                <textarea class="form-control" name="visi" id="visi" cols="30" rows="3">{{ old('visi') }}</textarea>
                                @error('visi')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Misi -->
                            <div class="mb-3">
                                <label for="misi" class="form-label">Misi UKKB</label>
                                <textarea class="form-control" name="misi" id="misi" cols="30" rows="3">{{ old('misi') }}</textarea>
                                @error('misi')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Logo -->
                            <div class="mb-3">
                                <label for="logo" class="form-label">Logo UKKB</label>
                                <input class="form-control" type="file" id="logo" name="logo">
                                @error('logo')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Foto Struktur Organisasi -->
                            <div class="mb-3">
                                <label for="foto_struktur_organisasi" class="form-label">Foto Struktur Organisasi</label>
                                <input class="form-control" type="file" id="foto_struktur_organisasi"
                                    name="foto_struktur_organisasi">
                                @error('foto_struktur_organisasi')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Badan Pengurus Harian -->
                            <div class="mb-3">
                                <label for="badan_pengurus_harian" class="form-label">Badan Pengurus Harian</label>
                                <textarea class="form-control" name="badan_pengurus_harian" id="badan_pengurus_harian" cols="30" rows="3">{{ old('badan_pengurus_harian') }}</textarea>
                                @error('badan_pengurus_harian')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Instagram -->
                            <div class="mb-3">
                                <label for="instagram" class="form-label">Instagram</label>
                                <input type="text" class="form-control" name="instagram" id="instagram"
                                    placeholder="Masukkan URL Instagram" value="{{ old('instagram') }}">
                                @error('instagram')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Masukkan Email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Nomor WA -->
                            <div class="mb-3">
                                <label for="nomor_wa" class="form-label">Nomor WhatsApp</label>
                                <input type="text" class="form-control" name="nomor_wa" id="nomor_wa"
                                    placeholder="Masukkan Nomor WhatsApp" value="{{ old('nomor_wa') }}">
                                @error('nomor_wa')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-secondary" href="{{ route('ukkb.all') }}">Kembali</a>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </form>

            </div>
        </div>
    </div>
@endsection
