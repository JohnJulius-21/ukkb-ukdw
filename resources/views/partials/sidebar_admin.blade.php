<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between text-center">
            <a href="{{ route('admin.index') }}" class="text-nowrap logo-img">
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
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('admin.index*') ? 'active' : '' }}" href="{{ route('admin.index') }}">
                        <iconify-icon icon="solar:widget-add-line-duotone"></iconify-icon>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('ukkb*') ? 'active' : '' }}" href="{{ route('ukkb.all') }}"
                        aria-expanded="false">
                        <iconify-icon icon="solar:file-text-line-duotone"></iconify-icon>
                        <span class="hide-menu">UKKB</span>
                    </a>
                </li>
        </nav>


        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>

