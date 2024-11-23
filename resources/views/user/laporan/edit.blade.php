@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <h2 class="main-title mb-5">Edit Laporan Kegiatan</h2>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('laporan.update', $laporan->laporan_id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Menggunakan method PUT untuk update -->
                    <div class="card">
                        <h5 class="card-title fw-semibold">Forms Edit Laporan Kegiatan</h5>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul Laporan</label>
                                <input type="text" class="form-control" id="judul" name="judul"
                                    value="{{ $laporan->judul_laporan }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal Laporan</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal"
                                    value="{{ $laporan->tanggal_laporan }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="files" class="form-label">File Laporan</label>
                                <input type="file" class="form-control" id="files" name="files[]" multiple>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi Laporan</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ $laporan->deskripsi_laporan }}</textarea>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-secondary" href="{{ route('laporan') }}">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update Laporan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
