<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between text-center">
            <a href="{{ route('beranda', ['id' => Auth::user()->ukkb->id]) }}" class="text-nowrap logo-img">
                <img src="{{ asset('/assets/images/logo.png') }}" alt="" style="width: 150px" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>

        <!-- Sidebar navigation -->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('beranda*') ? 'active' : '' }}"
                        href="{{ route('beranda', ['id' => Auth::user()->ukkb->id]) }}" aria-expanded="false">
                        <iconify-icon icon="solar:widget-add-line-duotone"></iconify-icon>
                        <span class="hide-menu">Beranda</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('kegiatan*') ? 'active' : '' }}"
                        href="{{ route('kegiatan', ['id' => Auth::user()->ukkb->id]) }}" aria-expanded="false">
                        <iconify-icon icon="solar:file-text-line-duotone"></iconify-icon>
                        <span class="hide-menu">Kegiatan</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('pendataan*') ? 'active' : '' }}"
                        href="{{ route('pendataan', ['id' => Auth::user()->ukkb->id]) }}" aria-expanded="false">
                        <iconify-icon icon="solar:user-plus-rounded-line-duotone"></iconify-icon>
                        <span class="hide-menu">Anggota</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    @if (Auth::user()->ukkb)
                        <!-- Periksa apakah user memiliki UKKB -->
                        <a class="sidebar-link {{ Request::is('tentang*') ? 'active' : '' }}"
                            href="{{ route('tentang.index', ['id' => Auth::user()->ukkb->id]) }}" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M19.898 16h-12c-.93 0-1.395 0-1.777.102A3 3 0 0 0 4 18.224" />
                                    <path stroke-linecap="round"
                                        d="M8 7h8m-8 3.5h5m6.5 8.5H8m2 3c-2.828 0-4.243 0-5.121-.879C4 20.243 4 18.828 4 16V8c0-2.828 0-4.243.879-5.121C5.757 2 7.172 2 10 2h4c2.828 0 4.243 0 5.121.879C20 3.757 20 5.172 20 8m-6 14c2.828 0 4.243 0 5.121-.879C20 20.243 20 18.828 20 16v-4" />
                                </g>
                            </svg>
                            <span class="hide-menu">Tentang Kami</span>
                        </a>
                    @else
                        <a class="sidebar-link disabled" href="#" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M19.898 16h-12c-.93 0-1.395 0-1.777.102A3 3 0 0 0 4 18.224" />
                                    <path stroke-linecap="round"
                                        d="M8 7h8m-8 3.5h5m6.5 8.5H8m2 3c-2.828 0-4.243 0-5.121-.879C4 20.243 4 18.828 4 16V8c0-2.828 0-4.243.879-5.121C5.757 2 7.172 2 10 2h4c2.828 0 4.243 0 5.121.879C20 3.757 20 5.172 20 8m-6 14c2.828 0 4.243 0 5.121-.879C20 20.243 20 18.828 20 16v-4" />
                                </g>
                            </svg>
                            <span class="hide-menu">Tentang Kami (Tidak Tersedia)</span>
                        </a>
                    @endif
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('akun*') ? 'active' : '' }}"
                        href="{{ route('akun', ['id' => Auth::user()->ukkb->id]) }}" aria-expanded="false">
                        <iconify-icon icon="solar:user-rounded-line-duotone"></iconify-icon>
                        <span class="hide-menu">Akun</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
