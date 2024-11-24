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
                <a class="btn btn-primary" href="{{ route('tambah.laporan') }}">Tambah Kegiatan</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered display" id="datatable" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Tangal Kegiatan</th>
                            <th>Nama Kegiatan</th>
                            <th>Tempat Kegiatan</th>
                            <th>Deskripsi</th>
                            <th>Dokumentasi Kegiatan</th>
                            <th class="text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporan as $item)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($item['tanggal_laporan'])->format('d F Y') }}</td>
                                <td>{{ $item['judul_laporan'] }}</td>
                                <td>...</td>
                                <td>{{ substr($item['deskripsi_laporan'], 0, 50) }}...</td>
                                <td>...</td>
                                <td class="text-right">
                                    <a class="btn btn-warning"
                                        href="{{ route('laporan.edit', $item->laporan_id) }}">Edit</a>

                                    <!-- Form untuk menghapus laporan -->
                                    <form action="{{ route('laporan.destroy', $item->laporan_id) }}" method="POST"
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

