@extends('layouts.admin')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link @if ($tab == 'show') active @endif"
                href="{{ route('ukkb.show', ['id' => $selectedUkkb->id, 'tab' => 'show']) }}">Beranda</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if ($tab == 'anggota') active @endif"
                href="{{ route('ukkb.show', ['id' => $selectedUkkb->id, 'tab' => 'anggota']) }}">Anggota</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if ($tab == 'kegiatan') active @endif"
                href="{{ route('ukkb.show', ['id' => $selectedUkkb->id, 'tab' => 'kegiatan']) }}">Kegiatan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if ($tab == 'tentang') active @endif"
                href="{{ route('ukkb.show', ['id' => $selectedUkkb->id, 'tab' => 'tentang']) }}">Tentang</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if ($tab == 'akun') active @endif"
                href="{{ route('ukkb.show', ['id' => $selectedUkkb->id, 'tab' => 'akun']) }}">Akun</a>
        </li>
    </ul>


    <div class="tab-content mt-3">
        @if ($tab == 'show')
            <div class="tab-pane active" id="beranda">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3 align-items-center">
                            <!-- Kolom kiri (elemen vertikal) -->
                            <div class="col-md-6">
                                <div class="row g-2">
                                    <!-- Total UKKB -->
                                    <div class="col-md-6">
                                        <div class="p-3 border text-center">
                                            <h4>{{ $totalUkkb }}</h4>
                                            <p>Total UKKB</p>
                                        </div>
                                    </div>
                                    <!-- Total Anggota UKKB -->
                                    <div class="col-md-6">
                                        <div class="p-3 border text-center">
                                            <h4>{{ $jumlahAnggota }}</h4>
                                            <p>Total Anggota UKKB</p>
                                        </div>
                                    </div>
                                    <!-- Jumlah Kegiatan -->
                                    {{-- <div class="col-md-4">
                                        <div class="p-3 border text-center">
                                            <h4>3</h4>
                                            <p>Jumlah Kegiatan</p>
                                        </div>
                                    </div> --}}
                                    <div class="col-md-6">
                                        <div class="p-3 border text-center">
                                            <h4>{{ $jumlahKegiatan }}</h4>
                                            <p>Jumlah Kegiatan</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kolom kanan (canvas) -->
                            <div class="col-md-6">
                                <div class="p-3">
                                    <label for="" class="text-center">Anggota Baru</label>
                                    <canvas id="myChart"></canvas>
                                </div>
                            </div>
                        </div>


                        <!-- Baris ketiga: Jadwal Kegiatan -->
                        <div class="row mt-4">
                            <div class="col-sm-12">
                                <div class="p-3 border">
                                    <h5>Jadwal Kegiatan</h5>
                                    <table class="table table-bordered table-striped display" id="datatable"
                                        style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Kegiatan</th>
                                                <th>Tanggal</th>
                                                <th>Tempat Pelaksanaan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($kegiatanAll as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item['judul_laporan'] }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item['tanggal_laporan'])->format('d F Y') }}
                                                    </td>
                                                    <td>{{ $item['tempat_kegiatan'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif ($tab == 'anggota')
            <div class="tab-pane active" id="anggota">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @if ($create)
                                {{-- FORM EDIT --}}
                                <form action="{{ route('ukkb.storeAnggota', $selectedUkkb->id) }}" method="POST"
                                    class="container">
                                    @csrf
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama Mahasiswa</label>
                                                <input name="nama" type="text" class="form-control"
                                                    id="exampleFormControlInput1" style="border: 1px"
                                                    placeholder="Masukan Nama Mahasiswa" value="{{ old('nama') }}">
                                                @error('nama')
                                                    <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="nim" class="form-label">NIM</label>
                                                <input name="nim" type="text" class="form-control"
                                                    id="exampleFormControlInput1" style="border: 1px"
                                                    placeholder="Masukan NIM Mahasiswa" value="{{ old('nim') }}">
                                                @error('nim')
                                                    <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="fakultas" class="form-label">Fakultas</label>
                                                <select name="fakultas" class="form-select">
                                                    <option value="">Pilih Fakultas</option>
                                                    <option value="Fakultas Teologi"
                                                        {{ old('fakultas') == 'Fakultas Teologi' ? 'selected' : '' }}>
                                                        Fakultas Teologi
                                                    </option>
                                                    <option value="Fakultas Kedokteran"
                                                        {{ old('fakultas') == 'Fakultas Kedokteran' ? 'selected' : '' }}>
                                                        Fakultas Kedokteran
                                                    </option>
                                                    <option value="Fakultas Arsitektur dan Desain"
                                                        {{ old('fakultas') == 'Fakultas Arsitektur dan Desain' ? 'selected' : '' }}>
                                                        Fakultas
                                                        Arsitektur dan Desain</option>
                                                    <option value="Fakultas Bioteknologi"
                                                        {{ old('fakultas') == 'Fakultas Bioteknologi' ? 'selected' : '' }}>
                                                        Fakultas
                                                        Bioteknologi</option>
                                                    <option value="Fakultas Bisnis"
                                                        {{ old('fakultas') == 'Fakultas Bisnis' ? 'selected' : '' }}>
                                                        Fakultas Bisnis
                                                    </option>
                                                    <option value="Fakultas Teknologi Informasi"
                                                        {{ old('fakultas') == 'Fakultas Teknologi Informasi' ? 'selected' : '' }}>
                                                        Fakultas
                                                        Teknologi Informasi</option>
                                                    <option value="Fakultas Kependidikan & Humaniora"
                                                        {{ old('fakultas') == 'Fakultas Kependidikan & Humaniora' ? 'selected' : '' }}>
                                                        Fakultas Kependidikan & Humaniora</option>
                                                </select>
                                                @error('fakultas')
                                                    <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="prodi" class="form-label">Prodi</label>
                                                <select name="prodi" class="form-select">
                                                    <option value="">Pilih Prodi</option>
                                                    <option value="Akuntansi"
                                                        {{ old('prodi') == 'Akuntansi' ? 'selected' : '' }}>Akuntansi
                                                    </option>
                                                    <option value="Arsitektur"
                                                        {{ old('prodi') == 'Arsitektur' ? 'selected' : '' }}>
                                                        Arsitektur</option>
                                                    <option value="Biologi"
                                                        {{ old('prodi') == 'Biologi' ? 'selected' : '' }}>Biologi
                                                    </option>
                                                    <option value="Desain Produk"
                                                        {{ old('prodi') == 'Desain Produk' ? 'selected' : '' }}>
                                                        Desain Produk</option>
                                                    <option value="Filsafat Keilahian"
                                                        {{ old('prodi') == 'Filsafat Keilahian' ? 'selected' : '' }}>
                                                        Filsafat Keilahian
                                                    </option>
                                                    <option value="Ilmu Teologi"
                                                        {{ old('prodi') == 'Ilmu Teologi' ? 'selected' : '' }}>
                                                        Ilmu Teologi</option>
                                                    <option value="Informatika"
                                                        {{ old('prodi') == 'Informatika' ? 'selected' : '' }}>
                                                        Informatika</option>
                                                    <option value="Kedokteran"
                                                        {{ old('prodi') == 'Kedokteran' ? 'selected' : '' }}>
                                                        Kedokteran</option>
                                                    <option value="Manajemen"
                                                        {{ old('prodi') == 'Manajemen' ? 'selected' : '' }}>Manajemen
                                                    </option>
                                                    <option value="Sistem Informasi"
                                                        {{ old('prodi') == 'Sistem Informasi' ? 'selected' : '' }}>Sistem
                                                        Informasi
                                                    </option>
                                                    <option value="Studi Humanitas"
                                                        {{ old('prodi') == 'Studi Humanitas' ? 'selected' : '' }}>Studi
                                                        Humanitas</option>
                                                </select>
                                                @error('prodi')
                                                    <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="nomor_hp" class="form-label">Nomor Hp Mahasiswa</label>
                                                <input name="nomor_hp" type="text" class="form-control"
                                                    id="exampleFormControlInput1" style="border: 1px"
                                                    value="{{ old('nomor_hp') }}">
                                                @error('nomor_hp')
                                                    <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                    <a href="{{ route('ukkb.show', ['id' => $selectedUkkb->id, 'tab' => 'anggota']) }}"
                                        class="btn btn-secondary">Batal</a>
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                </form>
                            @elseif($edit)
                                <form action="{{ route('ukkb.updateAnggota', $selectedUkkb->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT') <!-- Menggunakan method PUT untuk update -->

                                    <div class="card">
                                        <div class="card-body">

                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama Mahasiswa</label>
                                                <input type="text" class="form-control" id="nama_mahasiswa"
                                                    name="nama_mahasiswa"
                                                    value="{{ old('nama_mahasiswa', $mahasiswa->nama_mahasiswa) }}">
                                                @error('nama')
                                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="nim" class="form-label">NIM</label>
                                                <input name="nim" type="text" class="form-control"
                                                    id="exampleFormControlInput1" style="border: 1px"
                                                    placeholder="Masukan NIM Mahasiswa"
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
                                                        {{ old('prodi', $mahasiswa->prodi) == 'Akuntansi' ? 'selected' : '' }}>
                                                        Akuntansi
                                                    </option>
                                                    <option value="Arsitektur"
                                                        {{ old('prodi', $mahasiswa->prodi) == 'Arsitektur' ? 'selected' : '' }}>
                                                        Arsitektur
                                                    </option>
                                                    <option value="Biologi"
                                                        {{ old('prodi', $mahasiswa->prodi) == 'Biologi' ? 'selected' : '' }}>
                                                        Biologi
                                                    </option>
                                                    <option value="Desain Produk"
                                                        {{ old('prodi', $mahasiswa->prodi) == 'Desain Produk' ? 'selected' : '' }}>
                                                        Desain
                                                        Produk</option>
                                                    <option value="Filsafat Keilahian"
                                                        {{ old('prodi', $mahasiswa->prodi) == 'Filsafat Keilahian' ? 'selected' : '' }}>
                                                        Filsafat Keilahian</option>
                                                    <option value="Ilmu Teologi"
                                                        {{ old('prodi', $mahasiswa->prodi) == 'Ilmu Teologi' ? 'selected' : '' }}>
                                                        Ilmu
                                                        Teologi</option>
                                                    <option value="Informatika"
                                                        {{ old('prodi', $mahasiswa->prodi) == 'Informatika' ? 'selected' : '' }}>
                                                        Informatika</option>
                                                    <option value="Kedokteran"
                                                        {{ old('prodi', $mahasiswa->prodi) == 'Kedokteran' ? 'selected' : '' }}>
                                                        Kedokteran
                                                    </option>
                                                    <option value="Manajemen"
                                                        {{ old('prodi', $mahasiswa->prodi) == 'Manajemen' ? 'selected' : '' }}>
                                                        Manajemen
                                                    </option>
                                                    <option value="Sistem Informasi"
                                                        {{ old('prodi', $mahasiswa->prodi) == 'Sistem Informasi' ? 'selected' : '' }}>
                                                        Sistem Informasi</option>
                                                    <option value="Studi Humanitas"
                                                        {{ old('prodi', $mahasiswa->prodi) == 'Studi Humanitas' ? 'selected' : '' }}>
                                                        Studi
                                                        Humanitas</option>
                                                </select>
                                                @error('prodi')
                                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="nomor_hp" class="form-label">Nomor Hp Mahasiswa</label>
                                                <input name="nomor_hp" type="text" class="form-control"
                                                    id="exampleFormControlInput1" style="border: 1px"
                                                    value="{{ old('nomor_hp', $mahasiswa->nomor_hp) }}">
                                                @error('nomor_hp')
                                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <a href="{{ route('ukkb.show', ['id' => $selectedUkkb->id, 'tab' => 'anggota']) }}"
                                        class="btn btn-secondary">Batal</a>
                                    <button type="submit" class="btn btn-primary">Update Anggota</button>
                                </form>
                            @else
                                {{-- DATA STATIS --}}
                                <div class="col d-flex justify-content-start py-3">
                                    <div class="col-md-6 mx-2">
                                        <div class="p-3 border text-center bg-white">
                                            <h4>{{ $mahasiswaTerbaru }}</h4>
                                            <p>Total Angota Baru</p>
                                        </div>
                                    </div>
                                    <!-- Total Anggota UKKB -->
                                    <div class="col-md-6">
                                        <div class="p-3 border text-center bg-white">
                                            <h4>{{ $jumlahAnggota }}</h4>
                                            <p>Jumlah Anggota</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col d-flex justify-content-end py-5">
                                    <a class="btn btn-primary"
                                        href="{{ route('ukkb.show', ['id' => $selectedUkkb['id'], 'create' => 1, 'tab' => 'anggota']) }}">Tambah
                                        Anggota</a>
                                </div>

                                <table class="table table-bordered table-striped display" id="datatable"
                                    style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>Nama Mahasiswa</th>
                                            <th>NIM</th>
                                            <th>Fakultas</th>
                                            <th>Program Studi</th>
                                            <th>Nomor WA</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mahasiswas as $mahasiswa)
                                            <tr>
                                                <td>{{ $mahasiswa->nama_mahasiswa }}</td>
                                                <td>{{ $mahasiswa->nim }}</td>
                                                <td>{{ $mahasiswa->fakultas }}</td>
                                                <td>{{ $mahasiswa->prodi }}</td>
                                                <td>{{ $mahasiswa->nomor_hp }}</td>
                                                <td class="text-right">
                                                    <a class="btn btn-warning"
                                                        href="{{ route('ukkb.show', ['id' => $selectedUkkb['id'], 'edit' => 1, 'tab' => 'anggota', 'mahasiswa_id' => $mahasiswa->mahasiswa_id]) }}">
                                                        Edit
                                                    </a>
                                                    <!-- Form untuk menghapus laporan -->
                                                    <form
                                                        action="{{ route('ukkb.destroyAnggota', ['id' => $selectedUkkb->id, 'mahasiswa_id' => $mahasiswa->mahasiswa_id]) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @elseif ($tab == 'kegiatan')
            <div class="tab-pane active" id="kegiatan">
                <div class="card">
                    <div class="card-body">
                        @if ($create)
                            <h5 class="card-title fw-semibold mb-4">Forms Tambah Laporan Kegiatan</h5>
                            <form action="{{ route('ukkb.storeKegiatan', $selectedUkkb->id) }}" method="POST"
                                enctype="multipart/form-data" class="container">
                                @csrf
                                <div class="card">
                                    <div class="card-body">

                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Judul Laporan
                                                Kegiatan</label>
                                            <input type="text" name="judul" class="form-control"
                                                id="exampleFormControlInput1"
                                                placeholder="Masukan Judul Laporan Kegiatan">
                                        </div>
                                        <div class="mb-3">
                                            <label for="tanggal" class="form-label">Tanggal Kegiatan</label>
                                            <input type="date" name="tanggal" class="form-control" id="tanggal">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Tempat
                                                Kegiatan</label>
                                            <input type="text" name="tempat" class="form-control"
                                                id="exampleFormControlInput1" placeholder="Masukan Tempat Kegiatan">
                                        </div>
                                        <div class="mb-3">
                                            <label for="formFileMultiple" class="form-label">Dokumentasi Kegiatan</label>
                                            <input class="form-control" type="file" name="files[]"
                                                id="formFileMultiple" multiple>
                                        </div>
                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label">Deskripsi Kegiatan</label>
                                            <textarea class="form-control" name="deskripsi" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('ukkb.show', ['id' => $selectedUkkb->id, 'tab' => 'kegiatan']) }}"
                                    class="btn btn-secondary">Kembali</a>
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </form>
                        @elseif($edit)
                            <form action="{{ route('ukkb.updateKegiatan', $selectedUkkb->id) }}" method="POST"
                                enctype="multipart/form-data" class="mt-4">
                                @csrf
                                @method('PUT')
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="judul" class="form-label">Judul Laporan</label>
                                            <input type="text" name="judul" class="form-control" id="judul"
                                                value="{{ old('judul', $laporan->judul_laporan) }}"
                                                placeholder="Masukkan Judul">
                                            @error('judul')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="tanggal" class="form-label">Tanggal Kegiatan</label>
                                            <input type="date" name="tanggal" class="form-control" id="tanggal"
                                                value="{{ old('tanggal', $laporan->tanggal_laporan) }}">
                                            @error('tanggal')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="tempat" class="form-label">Tempat Kegiatan</label>
                                            <input type="text" name="tempat" class="form-control" id="tempat"
                                                value="{{ old('tempat', $laporan->tempat_kegiatan) }}"
                                                placeholder="Masukkan Tempat">
                                            @error('tempat')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="formFileMultiple" class="form-label">Dokumentasi</label>
                                            <input class="form-control" type="file" name="files[]"
                                                id="formFileMultiple" multiple>
                                            @error('files')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                            <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="10">{{ old('deskripsi', $laporan->deskripsi_laporan) }}</textarea>
                                            @error('deskripsi')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <a class="btn btn-secondary"
                                    href="{{ route('ukkb.show', ['id' => $selectedUkkb->id, 'tab' => 'kegiatan']) }}">Batal</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        @else
                            <div class="row">

                                <div class="col d-flex justify-content-start py-3">
                                    <h2>Kegiatan</h2>
                                </div>
                                <div class="col d-flex justify-content-end py-3">
                                    <a class="btn btn-primary"
                                        href="{{ route('ukkb.show', ['id' => $selectedUkkb['id'], 'create' => 1, 'tab' => 'kegiatan']) }}">Tambah
                                        Kegiatan</a>
                                </div>
                            </div>
                            <table class="table table-bordered table-striped display" id="datatable" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kegiatan</th>
                                        <th>Tanggal Kegiatan</th>
                                        <th>Tempat Kegiatan</th>
                                        <th>Dokumentasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($laporans as $laporan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $laporan->judul_laporan }}</td>
                                            <td>{{ \Carbon\Carbon::parse($laporan->tanggal_laporan)->locale('id')->isoFormat('D MMMM YYYY') }}
                                            </td>
                                            <td>{{ $laporan->tempat_kegiatan }}</td>
                                            <td>
                                                @foreach ($laporan['files'] as $file)
                                                    <img src="{{ asset($file['file_path']) }}"
                                                        alt="{{ $file['file_name'] }}"
                                                        style="width: 100px; height: auto; object-fit: cover; border: 1px solid #ddd; border-radius: 5px; padding: 5px; margin-bottom: 5px;">
                                                @endforeach
                                            </td>
                                            <td class="text-right">
                                                <a class="btn btn-warning"
                                                    href="{{ route('ukkb.show', ['id' => $selectedUkkb['id'], 'edit' => 1, 'tab' => 'kegiatan', 'laporan_id' => $laporan->laporan_id]) }}">
                                                    Edit
                                                </a>
                                                <form
                                                    action="{{ route('ukkb.destroyKegiatan', ['id' => $selectedUkkb->id, 'laporan_id' => $laporan->laporan_id]) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Yakin ingin menghapus laporan ini?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        @elseif ($tab == 'tentang')
            <div class="tab-pane active" id="tentang">
                <div class="card">
                    <div class="card-body">
                        <div class="row gx-4">
                            @if ($edit)
                                {{-- FORM EDIT --}}
                                {{-- {{ route('ukkb.update', $selectedUkkb['id']) }} --}}
                                <form action="{{ route('ukkb.updateTentang', $selectedUkkb->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Sejarah -->
                                    <div class="mb-3">
                                        <label for="sejarah" class="form-label">Sejarah UKKB</label>
                                        <textarea class="form-control" name="sejarah" id="sejarah" cols="30" rows="3">{{ old('sejarah', $selectedUkkb->sejarah) }}</textarea>
                                        @error('sejarah')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Visi -->
                                    <div class="mb-3">
                                        <label for="visi" class="form-label">Visi UKKB</label>
                                        <textarea class="form-control" name="visi" id="visi" cols="30" rows="3">{{ old('visi', $selectedUkkb->visi) }}</textarea>
                                        @error('visi')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Misi -->
                                    <div class="mb-3">
                                        <label for="misi" class="form-label">Misi UKKB</label>
                                        <textarea class="form-control" name="misi" id="misi" cols="30" rows="3">{{ old('misi', $selectedUkkb->misi) }}</textarea>
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
                                        <label for="foto_struktur_organisasi" class="form-label">Foto Struktur
                                            Organisasi</label>
                                        <input class="form-control" type="file" id="foto_struktur_organisasi"
                                            name="foto_struktur_organisasi">
                                        @error('foto_struktur_organisasi')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Badan Pengurus Harian -->
                                    <div class="mb-3">
                                        <label for="badan_pengurus_harian" class="form-label">Badan Pengurus
                                            Harian</label>
                                        <textarea class="form-control" name="badan_pengurus_harian" id="badan_pengurus_harian" cols="30"
                                            rows="3">{{ old('badan_pengurus_harian', $selectedUkkb->badan_pengurus_harian) }}</textarea>
                                        @error('badan_pengurus_harian')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Instagram -->
                                    <div class="mb-3">
                                        <label for="instagram" class="form-label">Instagram</label>
                                        <input type="text" class="form-control" name="instagram" id="instagram"
                                            placeholder="Masukkan URL Instagram"
                                            value="{{ old('instagram', $selectedUkkb->instagram) }}">
                                        @error('instagram')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Masukkan Email"
                                            value="{{ old('email', $selectedUkkb->email) }}">
                                        @error('email')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Nomor WA -->
                                    <div class="mb-3">
                                        <label for="nomor_wa" class="form-label">Nomor WhatsApp</label>
                                        <input type="text" class="form-control" name="nomor_wa" id="nomor_wa"
                                            placeholder="Masukkan Nomor WhatsApp"
                                            value="{{ old('nomor_wa', $selectedUkkb->nomor_wa) }}">
                                        @error('nomor_wa')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mt-2">
                                        <a href="{{ route('ukkb.show', ['id' => $selectedUkkb->id, 'tab' => 'tentang']) }}"
                                            class="btn btn-secondary">Batal</a>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            @else
                                {{-- DATA STATIS --}}
                                <div class="col d-flex justify-content-end">
                                    <a href="{{ route('ukkb.show', ['id' => $selectedUkkb['id'], 'edit' => 1, 'tab' => 'tentang']) }}"
                                        class="btn btn-primary">Edit</a>
                                </div>
                                <div style="width: 100%; margin: 0 auto; padding-top: 20px;">
                                    <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                                        <!-- Bagian Kiri -->
                                        <div style="flex: 1 1 66%; padding-right: 20px;" class="border p-3">
                                            <div class="row mb-3" style="text-align: start;">
                                                <div class="col-4">
                                                    @if ($selectedUkkb['logo'])
                                                        <img src="{{ asset('storage/' . $selectedUkkb['logo']) }}"
                                                            alt="Profile Picture"
                                                            style="width: 150px; height: 150px; border-radius: 50%;" />
                                                    @else
                                                        <img src="{{ asset('path_to_default_logo_image') }}"
                                                            alt="Default Logo"
                                                            style="width: 150px; height: 150px; border-radius: 50%;" />
                                                    @endif
                                                </div>
                                                <div class="col">
                                                    <h3>Sejarah</h3>
                                                    <p>{{ $selectedUkkb->sejarah ?: 'Belum ada data Sejarah' }}</p>
                                                </div>
                                            </div>
                                            <div>
                                                <h3>Visi</h3>
                                                <p>{{ $selectedUkkb->visi ?: 'Belum ada data Visi' }}</p>
                                            </div>
                                            <div>
                                                <h3>Misi</h3>
                                                <p>{{ $selectedUkkb->misi ?: 'Belum ada data Misi' }}</p>
                                            </div>
                                            <div>
                                                <h3>Struktur Organisasi</h3>
                                                @if ($selectedUkkb->foto_struktur_organisasi)
                                                    <img src="{{ asset('storage/' . $selectedUkkb->foto_struktur_organisasi) }}"
                                                        style="width: 100%;" alt="Struktur Organisasi" />
                                                @else
                                                    <p>Belum ada gambar Struktur Organisasi</p>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Bagian Kanan -->
                                        <div style="flex: 1 1 30%;" class="border p-3">
                                            <h3>Badan Pengurus Harian</h3>
                                            <ul style="list-style: none; padding: 0;">
                                                {{ $selectedUkkb->badan_pengurus_harian ?: 'Belum ada data Badan Pengurus Harian' }}
                                            </ul>

                                            <h3>Contact</h3>
                                            <ul style="list-style: none; padding: 0;">
                                                <li>
                                                    Sosial media IG:
                                                    @if ($selectedUkkb->instagram)
                                                        <a href="https://instagram.com/{{ $selectedUkkb->instagram }}"
                                                            style="color: #007bff; text-decoration: none;">
                                                            {{ $selectedUkkb->instagram }}
                                                        </a>
                                                    @else
                                                        <span>Belum ada data Instagram</span>
                                                    @endif
                                                </li>
                                                <li>
                                                    Email:
                                                    @if ($selectedUkkb->email)
                                                        <a href="mailto:{{ $selectedUkkb->email }}"
                                                            style="color: #007bff; text-decoration: none;">
                                                            {{ $selectedUkkb->email }}
                                                        </a>
                                                    @else
                                                        <span>Belum ada data Email</span>
                                                    @endif
                                                </li>
                                                <li>
                                                    No. WA: {{ $selectedUkkb->nomor_wa ?: 'Belum ada data No. WA' }}
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @elseif ($tab == 'akun')
            <div class="tab-pane active" id="akun">
                <div class="card">
                    <div class="card-body">
                        <h1>Profil UKKB</h1>
                        <div class="row gx-4">
                            @if ($edit)
                                {{-- FORM EDIT --}}
                                {{-- {{ route('ukkb.update', $selectedUkkb['id']) }} --}}
                                <form action="{{ route('ukkb.updateAkun', $selectedUkkb->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-12">
                                        <div class="p-3 border">
                                            <!-- Nama UKKB -->
                                            <div class="mb-3">
                                                <label for="nama_ukkb" class="form-label">Nama UKKB</label>
                                                <input type="text" name="nama_ukkb" class="form-control"
                                                    id="nama_ukkb"
                                                    value="{{ old('name', $users->pluck('name')->implode(', ') ?? '') }}">
                                                @error('nama_ukkb')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Email -->
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" id="email"
                                                    value="{{ old('email', $users->pluck('email')->implode(', ') ?? '') }}">
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            {{-- {{ $user->pluck('email')->implode(', ') }} --}}
                                            <!-- Password -->
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <div class="input-group">
                                                    <input type="password" name="password" class="form-control"
                                                        id="password">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        id="togglePassword">
                                                        <i class="fas fa-eye" id="toggleIcon"></i>
                                                    </button>
                                                </div>
                                                <small class="text-muted">Biarkan kosong jika tidak ingin mengganti
                                                    password.</small>
                                                @error('password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Logo -->
                                            <div class="mb-3">
                                                <label for="logo" class="form-label">Logo</label>
                                                <input type="file" name="logo" class="form-control"
                                                    id="logo">
                                                @error('logo')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mt-2">
                                            <a href="{{ route('ukkb.show', ['id' => $selectedUkkb->id, 'tab' => 'akun']) }}"
                                                class="btn btn-secondary">Batal</a>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                {{-- DATA STATIS --}}
                                <div class="col-8">
                                    <div class="p-3 border">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Nama UKKB</label>
                                            <input type="text" name="nama_ukkb" class="form-control"
                                                id="exampleFormControlInput1"
                                                value="{{ old('email', $users->pluck('name')->implode(', ') ?? '') }}"
                                                disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" id="email"
                                                value="{{ old('email', $users->pluck('email')->implode(', ') ?? '') }}"
                                                disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="password"
                                                value="******" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="p-3 border">
                                        <img src="{{ asset('storage/' . $selectedUkkb['logo']) }}" class="card-img-top"
                                            alt="Logo UKKB" onerror="this.onerror=null;this.src='default-image.jpg';">
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <a href="{{ route('ukkb.show', ['id' => $selectedUkkb['id'], 'edit' => 1, 'tab' => 'akun']) }}"
                                        class="btn btn-primary">Edit</a>
                                    <form action="{{ route('ukkb.destroyAkun', $selectedUkkb->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar', // Ubah jenis grafik sesuai keinginan (line/bar/pie)
            data: {
                labels: ['Anggota Lama', 'Anggota Baru'], // Label data
                datasets: [{
                    label: 'Jumlah Anggota',
                    data: [{{ $jumlahAnggotaLama }}, {{ $jumlahAnggotaBaru }}], // Data dari controller
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.5)', // Warna untuk anggota lama
                        'rgba(75, 192, 192, 0.5)' // Warna untuk anggota baru
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    tooltip: {
                        enabled: true,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            // Pastikan angka tetap bulat
                            precision: 0,
                            callback: function(value) {
                                return Math.floor(value); // Paksa angka menjadi bulat
                            }
                        },
                        title: {
                            display: true,
                            text: 'Jumlah Anggota'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Kategori'
                        }
                    }
                }
            }
        });

        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            // Ubah tipe input antara 'password' dan 'text'
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';

            // Ubah ikon berdasarkan status input
            toggleIcon.classList.toggle('fa-eye', !isPassword);
            toggleIcon.classList.toggle('fa-eye-slash', isPassword);
        });
    </script>


@endsection
