@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <!-- Pesan Sukses -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h2 class="main-title mb-5">Laporan Kegiatan</h2>

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary" href="{{ route('tambah.laporan') }}">Tambah Laporan</a>
                </div>
                <table class="table table-bordered display" id="datatable" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Judul Laporan</th>
                            <th>Tanggal Laporan</th>
                            <th>Deskripsi</th>
                            <th class="text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporan as $item)
                            <tr>
                                <td>{{ $item['judul_laporan'] }}</td>
                                <td>{{ \Carbon\Carbon::parse($item['tanggal_laporan'])->format('d F Y') }}</td>
                                <td>{{ substr($item['deskripsi_laporan'], 0, 50) }}...</td>
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

