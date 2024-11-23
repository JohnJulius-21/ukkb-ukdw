@extends('layouts.user')

@section('content')
    <div class="container-fluid">
        <!-- Pesan Sukses -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h2 class="main-title mb-5">Beranda</h2>
    </div>
@endsection
