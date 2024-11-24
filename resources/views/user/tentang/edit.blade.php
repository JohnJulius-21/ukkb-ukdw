@extends('layouts.user')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                {{-- {{ route('ukkb.update', $selectedUkkb['id']) }} --}}
                <form action="{{ route('tentang.update', $ukkb->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Sejarah -->
                    <div class="mb-3">
                        <label for="sejarah" class="form-label">Sejarah UKKB</label>
                        <textarea class="form-control" name="sejarah" id="sejarah" cols="30" rows="3">{{ old('sejarah', $ukkb->sejarah) }}</textarea>
                        @error('sejarah')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Visi -->
                    <div class="mb-3">
                        <label for="visi" class="form-label">Visi UKKB</label>
                        <textarea class="form-control" name="visi" id="visi" cols="30" rows="3">{{ old('visi', $ukkb->visi) }}</textarea>
                        @error('visi')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Misi -->
                    <div class="mb-3">
                        <label for="misi" class="form-label">Misi UKKB</label>
                        <textarea class="form-control" name="misi" id="misi" cols="30" rows="3">{{ old('misi', $ukkb->misi) }}</textarea>
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
                        <label for="foto_struktur_organisasi" class="form-label">Foto Struktur Organisasi</label>
                        <input class="form-control" type="file" id="foto_struktur_organisasi"
                            name="foto_struktur_organisasi">
                        @error('foto_struktur_organisasi')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Badan Pengurus Harian -->
                    <div class="mb-3">
                        <label for="badan_pengurus_harian" class="form-label">Badan Pengurus Harian</label>
                        <textarea class="form-control" name="badan_pengurus_harian" id="badan_pengurus_harian" cols="30" rows="3">{{ old('badan_pengurus_harian', $ukkb->badan_pengurus_harian) }}</textarea>
                        @error('badan_pengurus_harian')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Instagram -->
                    <div class="mb-3">
                        <label for="instagram" class="form-label">Instagram</label>
                        <input type="text" class="form-control" name="instagram" id="instagram"
                            placeholder="Masukkan URL Instagram" value="{{ old('instagram', $ukkb->instagram) }}">
                        @error('instagram')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email"
                            placeholder="Masukkan Email" value="{{ old('email', $ukkb->email) }}">
                        @error('email')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nomor WA -->
                    <div class="mb-3">
                        <label for="nomor_wa" class="form-label">Nomor WhatsApp</label>
                        <input type="text" class="form-control" name="nomor_wa" id="nomor_wa"
                            placeholder="Masukkan Nomor WhatsApp" value="{{ old('nomor_wa', $ukkb->nomor_wa) }}">
                        @error('nomor_wa')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('tentang.index', ['id' => Auth::user()->ukkb->id]) }}"
                            class="btn btn-secondary">Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
