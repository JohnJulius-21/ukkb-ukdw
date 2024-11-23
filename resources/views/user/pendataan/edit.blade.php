@extends('layouts.user')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@section('content')
    <div class="container-fluid">
        <h3 class="main-title mb-5">Edit Anggota</h3>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Form Edit Anggota</h5>
                <form action="{{ route('pendataan.update', $mahasiswa->mahasiswa_id) }}" method="POST" class="container">
                    <div class="card">
                        <div class="card-body">

                            @csrf
                            @method('PUT') <!-- Method untuk update -->

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Mahasiswa</label>
                                <input name="nama" type="text" class="form-control" id="exampleFormControlInput1"
                                    style="border: 1px" placeholder="Masukan Nama Mahasiswa"
                                    value="{{ old('nama', $mahasiswa->nama_mahasiswa) }}">
                                @error('nama')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nim" class="form-label">NIM</label>
                                <input name="nim" type="text" class="form-control" id="exampleFormControlInput1"
                                    style="border: 1px" placeholder="Masukan NIM Mahasiswa"
                                    value="{{ old('nim', $mahasiswa->nim) }}">
                                @error('nim')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="fakultas" class="form-label">Fakultas</label>
                                <select name="fakultas" class="form-select">
                                    <option value="">Pilih Fakultas</option>
                                    <option value="Fakultas Teologi"
                                        {{ old('fakultas', $mahasiswa->fakultas) == 'Fakultas Teologi' ? 'selected' : '' }}>
                                        Fakultas Teologi</option>
                                    <option value="Fakultas Kedokteran"
                                        {{ old('fakultas', $mahasiswa->fakultas) == 'Fakultas Kedokteran' ? 'selected' : '' }}>
                                        Fakultas Kedokteran</option>
                                    <option value="Fakultas Arsitektur dan Desain"
                                        {{ old('fakultas', $mahasiswa->fakultas) == 'Fakultas Arsitektur dan Desain' ? 'selected' : '' }}>
                                        Fakultas Arsitektur dan Desain</option>
                                    <option value="Fakultas Bioteknologi"
                                        {{ old('fakultas', $mahasiswa->fakultas) == 'Fakultas Bioteknologi' ? 'selected' : '' }}>
                                        Fakultas Bioteknologi</option>
                                    <option value="Fakultas Bisnis"
                                        {{ old('fakultas', $mahasiswa->fakultas) == 'Fakultas Bisnis' ? 'selected' : '' }}>
                                        Fakultas Bisnis</option>
                                    <option value="Fakultas Teknologi Informasi"
                                        {{ old('fakultas', $mahasiswa->fakultas) == 'Fakultas Teknologi Informasi' ? 'selected' : '' }}>
                                        Fakultas Teknologi Informasi</option>
                                    <option value="Fakultas Kependidikan & Humaniora"
                                        {{ old('fakultas', $mahasiswa->fakultas) == 'Fakultas Kependidikan & Humaniora' ? 'selected' : '' }}>
                                        Fakultas Kependidikan & Humaniora</option>
                                </select>
                                @error('fakultas')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="prodi" class="form-label">Prodi</label>
                                <select name="prodi" class="form-select">
                                    <option value="">Pilih Prodi</option>
                                    <option value="Akuntansi"
                                        {{ old('prodi', $mahasiswa->prodi) == 'Akuntansi' ? 'selected' : '' }}>Akuntansi
                                    </option>
                                    <option value="Arsitektur"
                                        {{ old('prodi', $mahasiswa->prodi) == 'Arsitektur' ? 'selected' : '' }}>Arsitektur
                                    </option>
                                    <option value="Biologi"
                                        {{ old('prodi', $mahasiswa->prodi) == 'Biologi' ? 'selected' : '' }}>Biologi
                                    </option>
                                    <option value="Desain Produk"
                                        {{ old('prodi', $mahasiswa->prodi) == 'Desain Produk' ? 'selected' : '' }}>Desain
                                        Produk</option>
                                    <option value="Filsafat Keilahian"
                                        {{ old('prodi', $mahasiswa->prodi) == 'Filsafat Keilahian' ? 'selected' : '' }}>
                                        Filsafat Keilahian</option>
                                    <option value="Ilmu Teologi"
                                        {{ old('prodi', $mahasiswa->prodi) == 'Ilmu Teologi' ? 'selected' : '' }}>Ilmu
                                        Teologi</option>
                                    <option value="Informatika"
                                        {{ old('prodi', $mahasiswa->prodi) == 'Informatika' ? 'selected' : '' }}>
                                        Informatika</option>
                                    <option value="Kedokteran"
                                        {{ old('prodi', $mahasiswa->prodi) == 'Kedokteran' ? 'selected' : '' }}>Kedokteran
                                    </option>
                                    <option value="Manajemen"
                                        {{ old('prodi', $mahasiswa->prodi) == 'Manajemen' ? 'selected' : '' }}>Manajemen
                                    </option>
                                    <option value="Sistem Informasi"
                                        {{ old('prodi', $mahasiswa->prodi) == 'Sistem Informasi' ? 'selected' : '' }}>
                                        Sistem Informasi</option>
                                    <option value="Studi Humanitas"
                                        {{ old('prodi', $mahasiswa->prodi) == 'Studi Humanitas' ? 'selected' : '' }}>Studi
                                        Humanitas</option>
                                </select>
                                @error('prodi')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nomor_hp" class="form-label">Nomor Hp Mahasiswa</label>
                                <input name="nomor_hp" type="text" class="form-control" id="exampleFormControlInput1"
                                    style="border: 1px" value="{{ old('nomor_hp', $mahasiswa->nomor_hp) }}">
                                @error('nomor_hp')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-secondary" href="{{ route('pendataan') }}">Kembali</a>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
