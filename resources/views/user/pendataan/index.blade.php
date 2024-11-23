@extends('layouts.main')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<!-- CSS DataTables -->
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> --}}

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h2 class="main-title mb-5">Daftar Anggota</h2>

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary" href="{{ route('pendataan.create') }}">Tambah Anggota</a>
                </div>
                <table class="table table-bordered display" id="datatable" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Nama Mahasiswa</th>
                            <th>NIM</th>
                            <th>Fakultas</th>
                            <th>Prodi</th>
                            <th>No HP</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mahasiswa as $item)
                            <tr>
                                <td>{{ $item->nama_mahasiswa }}</td>
                                <td>{{ $item->nim }}</td>
                                <td>{{ $item->fakultas }}</td>
                                <td>{{ $item->prodi }}</td>
                                <td>{{ $item->nomor_hp }}</td>
                                <td>
                                    <a class="btn btn-warning"
                                        href="{{ route('pendataan.edit', $item->mahasiswa_id) }}">Edit</a>
                                    <form action="{{ route('pendataan.destroy', $item->mahasiswa_id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
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