@extends('layouts.user')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col d-flex justify-content-start py-3">
            <h2>Akun</h2>
        </div>
        <div class="col d-flex justify-content-end py-3">
            <a class="btn btn-primary" href="{{ route('akun.edit', $selectedUkkb->id) }}">Edit</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row gx-4">
                <div class="col-3">
                    <div class="p-3 border">
                        <img src="{{ asset('storage/' . $selectedUkkb['logo']) }}" class="card-img-top" alt="Logo UKKB"
                            onerror="this.onerror=null;this.src='default-image.jpg';">
                    </div>
                </div>
                {{-- DATA STATIS --}}
                <div class="col-8">
                    <div class="p-3 border">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nama UKKB</label>
                            <input type="text" name="nama_ukkb" class="form-control" id="exampleFormControlInput1"
                                value="{{ $selectedUkkb['nama_ukkb'] }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nama Akun</label>
                            <input type="text" name="nama_ukkb" class="form-control" id="exampleFormControlInput1"
                                value="{{ $user->pluck('name')->implode(', ') }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email"
                                value="{{ $selectedUkkb['email'] ?? '' }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" value="******"
                                disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
