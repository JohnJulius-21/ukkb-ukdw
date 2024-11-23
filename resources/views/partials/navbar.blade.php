<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

        <a href="{{ route('informasi') }}" class="logo d-flex align-items-center me-auto me-xl-0">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            {{-- <h1 class="sitename"></h1> --}}
            <img style="width: 120px;" src="{{ asset('/assets/images/logo-guest.png') }}" alt="" style="width: 150px" />
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ route('informasi') }}" class="active">Home</a></li>
                <li class="dropdown"><a href="#"><span>UKKB</span> <i
                            class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="{{ route('formapa') }}">FORMAPA</a></li>
                        <li><a href="{{ route('imt') }}">IMT</a></li>                        
                    </ul>
                </li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        {{-- <div class="header-social-links">
            <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div> --}}

    </div>
</header>
