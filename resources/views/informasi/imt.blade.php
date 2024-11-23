@extends('layouts.guest')

@section('content')
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Daftar Laporan Kegiatan</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('informasi') }}">Home</a></li>
                    <li class="current">IMT</li>
                </ol>
            </nav>
        </div>
    </div>

    <section id="culture-category" class="culture-category section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">

            @foreach ($laporanUser2 as $item)
                <div class="card mb-3" style="max-width: 100%;">
                    <div class="row g-0">
                        <div class="col-md-2">
                            @if (isset($item['files'][0]))
                                <img src="{{ asset('storage/' . $item['files'][0]['file_path']) }}"
                                     class="img-fluid rounded-start"
                                     alt="Image for {{ $item['judul_laporan'] }}">
                            @else
                                <img src="{{ asset('/assets/images/logo-guest.png') }}" class="img-fluid rounded-start" alt="Default Image">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <a href="{{ route('informasi.show', ['id' => $item->laporan_id]) }}">
                                    <h5 class="card-title">{{ $item['judul_laporan'] }}</h5>
                                </a>
                                @php
                                    $words = explode(' ', $item['deskripsi_laporan']);
                                    $shortDescription =
                                        implode(' ', array_slice($words, 0, 20)) . (count($words) > 20 ? '...' : '');
                                @endphp
                                <p class="card-text">{{ $shortDescription }}</p>
                                <p class="card-text"><small class="text-muted">{{ $item->user->name }}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Pagination Navigation -->
            <div class="d-flex justify-content-end">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item {{ $laporanUser2->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $laporanUser2->previousPageUrl() }}" tabindex="-1"
                               aria-disabled="{{ $laporanUser2->onFirstPage() ? 'true' : 'false' }}">Previous</a>
                        </li>

                        <!-- Page Numbers -->
                        @for ($i = 1; $i <= $laporanUser2->lastPage(); $i++)
                            <li class="page-item {{ $laporanUser2->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ $laporanUser2->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        <!-- Next Button -->
                        <li class="page-item {{ $laporanUser2->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $laporanUser2->nextPageUrl() }}">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
@endsection
