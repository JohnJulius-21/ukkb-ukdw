<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between text-center">
            <a href="{{ route('laporan') }}" class="text-nowrap logo-img">
                <img src="{{ asset('/assets/images/logo.png') }}" alt="" style="width: 150px" />
                {{-- <h4 class="text-center">UKKB - UKDW</h4> --}}
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                    <span class="hide-menu">Home</span>
                </li>
                
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('laporan*') ? 'active' : '' }}" href="{{ route('laporan') }}" aria-expanded="false">
                        <iconify-icon icon="solar:file-text-line-duotone"></iconify-icon>
                        <span class="hide-menu">Laporan Kegiatan</span>
                    </a>
                </li>

                <li>
                    <span class="sidebar-divider lg"></span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('pendataan*') ? 'active' : '' }}" href="{{ route('pendataan') }}" aria-expanded="false">
                        <iconify-icon icon="solar:user-plus-rounded-line-duotone"></iconify-icon>
                        <span class="hide-menu">Pendataan Anggota</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
