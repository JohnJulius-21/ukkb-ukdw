@extends('layouts.admin')

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
                <h2>Daftar UKKB</h2>
            </div>
            <div class="col d-flex justify-content-end py-3">
                <a class="btn btn-primary" href="{{ route('ukkb.create') }}">Tambah UKKB</a>
            </div>
        </div>
        <div class="row">
            @foreach ($ukkb as $item)
                <div class="col-md-4 mb-4">
                    <div class="card" style="width: 100%;">
                        <img src="{{ asset('storage/' . $item['logo']) }}" class="card-img-top" alt="Logo UKKB"
                            onerror="this.onerror=null;this.src='default-image.jpg';">

                        <div class="card-body">
                            <a href="{{ route('ukkb.show', $item['id']) }}">
                                <h5 class="card-title">{{ $item['nama_ukkb'] }}</h5>
                            </a>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
