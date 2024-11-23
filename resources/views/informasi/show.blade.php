@extends('layouts.guest')

@section('content')
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Detail Laporan</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('informasi') }}">Home</a></li>
                    <li class="current">Detail Laporan</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Blog Details Section -->
    <section id="blog-details" class="blog-details section">
        <div class="container">

            <article class="article">

                <div class="post-img text-center" style="max-width:70%; margin: 0 auto;">
                    <div id="carouselExampleControls" class="carousel slide mx-auto" data-bs-ride="carousel"
                        style="max-width: 100%;">
                        <div class="carousel-inner">
                            @foreach ($laporan->files as $index => $file)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $file->file_path) }}" class="d-block w-100"
                                        alt="Image {{ $index + 1 }}">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

                <h2 class="title">{{ $laporan->judul_laporan }}</h2>

                <div class="meta-top">
                    <ul>
                        <li class="d-flex align-items-center"><i class="bi bi-person"></i> {{ $laporan->user->name }}</li>
                        <li class="d-flex align-items-center">
                            <i class="bi bi-calendar"></i>
                            {{ \Carbon\Carbon::parse($laporan->tanggal_laporan)->format('d F Y') }}
                        </li>
                        </li>
                    </ul>
                </div><!-- End meta top -->

                <div class="content">
                    <p>
                        {{ $laporan->deskripsi_laporan }}
                    </p>


            </article>

        </div>
    </section><!-- /Blog Details Section -->
@endsection
