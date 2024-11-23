@extends('layouts.user')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@section('content')
    <div class="container-fluid">
        <h2 class="main-title mb-5">Tambah Laporan Kegiatan</h2>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Forms Tambah Laporan Kegiatan</h5>
                <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data" class="container">
                    @csrf
                    <div class="card">
                        <div class="card-body">

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Judul Laporan Kegiatan</label>
                                <input type="text" name="judul" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Masukan Judul Laporan Kegiatan">
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal Kegiatan</label>
                                <input type="date" name="tanggal" class="form-control" id="tanggal">
                            </div>
                            <div class="mb-3">
                                <label for="formFileMultiple" class="form-label">Lampiran File</label>
                                <input class="form-control" type="file" name="files[]" id="formFileMultiple" multiple>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi Kegiatan</label>
                                <textarea class="form-control" name="deskripsi" id="" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-secondary" href="{{ route('laporan') }}">Kembali</a>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
