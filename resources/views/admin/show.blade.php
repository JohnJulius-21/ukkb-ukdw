@extends('layouts.admin')


@section('content')
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
                                            <h4>11</h4>
                                            <p>Total UKKB</p>
                                        </div>
                                    </div>
                                    <!-- Total Anggota UKKB -->
                                    <div class="col-md-6">
                                        <div class="p-3 border text-center">
                                            <h4>163</h4>
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
                                            <h4>3</h4>
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
                                    <table class="table table-bordered table-striped display" id="datatable" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Kegiatan</th>
                                                <th>Tanggal</th>
                                                <th>Tempat Pelaksanaan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Makrab Formapa</td>
                                                <td>26 Oktober 2024</td>
                                                <td>Wisma UKDW</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Gelar Budaya day 1</td>
                                                <td>2 November 2024</td>
                                                <td>Halaman Koinonia</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Makrab IMT</td>
                                                <td>9 November 2024</td>
                                                <td>Wisma UGM</td>
                                            </tr>
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
                        <h1>Daftar Anggota</h1>
                        <table class="table table-bordered table-striped display" id="datatable" style="width: 100%">
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
                                                href="">Edit</a>
        
                                            <!-- Form untuk menghapus laporan -->
                                            <form action="" method="POST"
                                                style="display:inline;">
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
                    </div>
                </div>
            </div>
        @elseif ($tab == 'kegiatan')
            <div class="tab-pane active" id="kegiatan">
                <div class="card">
                    <div class="card-body">
                        <h1>Informasi Kegiatan</h1>
                        <table class="table table-bordered table-striped display" id="datatable" style="width: 100%">
                            <thead>
                                <tr>
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
                                        <td>{{ $laporan->judul_laporan }}</td>
                                        <td>{{ \Carbon\Carbon::parse($laporan->tanggal_laporan)->locale('id')->isoFormat('D MMMM YYYY') }}</td>
                                        <td>{{ $laporan->fakultas }}</td>
                                        <td>{{ $laporan->prodi }}</td>
                                        <td class="text-right">
                                            <a class="btn btn-warning"
                                                href="">Edit</a>
        
                                            <!-- Form untuk menghapus laporan -->
                                            <form action="" method="POST"
                                                style="display:inline;">
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
                                <form action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

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
                                            rows="3">{{ old('badan_pengurus_harian') }}</textarea>
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

                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="{{ route('ukkb.show', ['id' => $selectedUkkb->id, 'tab' => 'tentang']) }}"
                                            class="btn btn-secondary">Batal</a>
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
                                                    <img src="{{ asset('storage/' . $selectedUkkb['logo']) }}"
                                                        alt="Profile Picture"
                                                        style="width: 150px; height: 150px; border-radius: 50%;" />
                                                </div>
                                                <div class="col">
                                                    <h3>Sejarah</h3>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur
                                                        vitae
                                                        urna nisi.</p>
                                                </div>
                                            </div>
                                            <div>
                                                <h3>Visi</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae
                                                    urna nisi.</p>
                                            </div>
                                            <div>
                                                <h3>Misi</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae
                                                    urna nisi.</p>
                                            </div>
                                            <div>
                                                <h3>Struktur Organisasi</h3>
                                                <div>
                                                    <img src="path_to_structure_image" alt="Structure Diagram"
                                                        style="width: 100%;" />
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Bagian Kanan -->
                                        <div style="flex: 1 1 30%;" class="border p-3">
                                            <h3>Badan Pengurus Harian</h3>
                                            <ul style="list-style: none; padding: 0;">
                                                <li>Ketua: xxxxxxx</li>
                                                <li>Wakil Ketua: xxxxxxx</li>
                                                <li>Sekretaris 1: xxxxxxx</li>
                                                <li>Sekretaris 2: xxxxxxx</li>
                                                <li>Bendahara: xxxxxxx</li>
                                            </ul>

                                            <h3>Contact</h3>
                                            <ul style="list-style: none; padding: 0;">
                                                <li>Sosial media IG: <a href="https://instagram.com/formapaukdw"
                                                        style="color: #007bff; text-decoration: none;">@formapaukdw</a>
                                                </li>
                                                <li>Email: <a href="mailto:formapaukdw@gmail.com"
                                                        style="color: #007bff; text-decoration: none;">formapaukdw@gmail.com</a>
                                                </li>
                                                <li>No. WA: 0899999999</li>
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
                                <form action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-12">
                                        <div class="p-3 border">
                                            <div class="mb-3">
                                                <label for="nama_ukkb" class="form-label">Nama UKKB</label>
                                                <input type="text" name="nama_ukkb" class="form-control"
                                                    id="nama_ukkb" value="{{ $selectedUkkb['nama_ukkb'] }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" id="email"
                                                    value="{{ $selectedUkkb['email'] ?? '' }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" name="password" class="form-control"
                                                    id="password">
                                            </div>
                                            <div class="mb-3">
                                                <label for="logo" class="form-label">Logo</label>
                                                <input type="file" name="logo" class="form-control"
                                                    id="logo">
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            <a href="{{ route('ukkb.show', ['id' => $selectedUkkb->id, 'tab' => 'akun']) }}"
                                                class="btn btn-secondary">Batal</a>
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
                                                id="exampleFormControlInput1" value="{{ $selectedUkkb['nama_ukkb'] }}"
                                                disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" id="email"
                                                value="{{ $selectedUkkb['email'] ?? '' }}" disabled>
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
                                    <a href="" class="btn btn-danger">Hapus</a>
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
            type: 'line',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [0, 19, 3, 5, 2, 3],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
