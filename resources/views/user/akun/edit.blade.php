@extends('layouts.user')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
@section('content')
    <h2>Edit Akun</h2>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('akun.update', $selectedUkkb->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <div class="p-3 border">
                        <div class="mb-3">
                            <label for="nama_ukkb" class="form-label">Nama UKKB</label>
                            <input type="text" name="nama_ukkb" class="form-control" id="nama_ukkb"
                                value="{{ $selectedUkkb['nama_ukkb'] }}">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Akun</label>
                            <input type="text" name="name" class="form-control" id="name"
                                value="{{ $user->pluck('name')->implode(', ') }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email"
                                value="{{ $user->pluck('email')->implode(', ') }}">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" id="password">
                                <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                    <i class="fas fa-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengganti password.</small>
                        </div>


                        <div class="mb-3">
                            <label for="logo" class="form-label">Profile Picture</label>
                            <input type="file" name="logo" class="form-control" id="logo">

                        </div>
                    </div>
                    <div class="mt-2">
                        <a href="{{ route('akun', ['id' => Auth::user()->ukkb->id]) }}"
                            class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            // Ubah tipe input antara 'password' dan 'text'
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';

            // Ubah ikon berdasarkan status input
            toggleIcon.classList.toggle('fa-eye', !isPassword);
            toggleIcon.classList.toggle('fa-eye-slash', isPassword);
        });
    </script>
@endsection
