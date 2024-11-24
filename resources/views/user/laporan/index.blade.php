@extends('layouts.user')

@section('content')
    <div class="container-fluid">
        <!-- Pesan Sukses -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col d-flex justify-content-start py-3">
                <h2>Kegiatan</h2>
            </div>
            <div class="col d-flex justify-content-end py-3">
                <a class="btn btn-primary" href="{{ route('tambah.kegiatan') }}">Tambah Kegiatan</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered display" id="datatable" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Tanggal Kegiatan</th>
                            <th>Nama Kegiatan</th>
                            <th>Tempat Kegiatan</th>
                            <th>Deskripsi</th>
                            <th>Dokumentasi Kegiatan</th>
                            <th class="text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kegiatan as $item)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($item['tanggal_laporan'])->format('d F Y') }}</td>
                                <td>{{ $item['judul_laporan'] }}</td>
                                <td>{{ $item['tempat_kegiatan'] }}</td>
                                <td>{{ substr($item['deskripsi_laporan'], 0, 50) }}...</td>
                                <td>
                                    @foreach ($item['files'] as $file)
                                        <img src="{{ asset($file['file_path']) }}" alt="{{ $file['file_name'] }}" 
                                            style="width: 100px; height: auto; object-fit: cover; border: 1px solid #ddd; border-radius: 5px; padding: 5px; margin-bottom: 5px;">
                                    @endforeach
                                </td>
                                <td class="text-right">
                                    <a class="btn btn-warning"
                                        href="{{ route('kegiatan.edit', $item->laporan_id) }}">Edit</a>

                                    <!-- Form untuk menghapus kegiatan -->
                                    <form action="{{ route('kegiatan.destroy', $item->laporan_id) }}" method="POST"
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
@endsection
