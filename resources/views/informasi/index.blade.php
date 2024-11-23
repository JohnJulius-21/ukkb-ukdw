@extends('layouts.guest')

@section('content')
    <!-- Slider Section -->
    <section id="slider" class="slider section dark-background">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="swiper init-swiper">

                <script type="application/json" class="swiper-config">
  {
    "loop": true,
    "speed": 600,
    "autoplay": {
      "delay": 5000
    },
    "slidesPerView": "auto",
    "centeredSlides": true,
    "pagination": {
      "el": ".swiper-pagination",
      "type": "bullets",
      "clickable": true
    },
    "navigation": {
      "nextEl": ".swiper-button-next",
      "prevEl": ".swiper-button-prev"
    }
  }
</script>

                <div class="swiper-wrapper">

                    @foreach ($latestLaporan as $item)
                        @if (isset($item['files'][0]))
                            <div class="swiper-slide"
                                style="background-image: url('{{ asset('storage/' . $item['files'][0]['file_path']) }}');">
                                <div class="content">
                                    <h2><a href="{{ route('informasi.show', ['id' => $item->laporan_id]) }}">{{ $item['judul_laporan'] }}</a></h2>
                                    <p>{{ $item['deskripsi_laporan'] }}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>

                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>

                <div class="swiper-pagination"></div>
            </div>

        </div>

    </section><!-- /Slider Section -->

    <section id="culture-category" class="culture-category section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <div class="section-title-container d-flex align-items-center justify-content-between">
                <h2>Laporan Kegiatan UKKB</h2>
                {{-- <p><a href="categories.html">Lihat Semua</a></p> --}}
            </div>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            @foreach ($laporan as $item)
                <div class="card mb-3" style="max-width: 100%;">
                    <div class="row g-0">
                        <div class="col-md-2">
                            @if (isset($item['files'][0]))
                                <img src="{{ asset('storage/' . $item['files'][0]['file_path']) }}"
                                    class="img-fluid rounded-start" alt="{{ asset('/assets/images/logo-guest.png') }}">
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
            <!-- Tampilkan navigasi pagination -->
            <div class="d-flex justify-content-end">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item {{ $laporan->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $laporan->previousPageUrl() }}" tabindex="-1"
                                aria-disabled="{{ $laporan->onFirstPage() ? 'true' : 'false' }}">Previous</a>
                        </li>

                        <!-- Nomor halaman -->
                        @for ($i = 1; $i <= $laporan->lastPage(); $i++)
                            <li class="page-item {{ $laporan->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ $laporan->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        <!-- Tombol "Next" -->
                        <li class="page-item {{ $laporan->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $laporan->nextPageUrl() }}">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
@endsection
