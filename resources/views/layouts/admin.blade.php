<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UKKB - UKDW</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('/assets/images/logos/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/css/styles.min.css') }}" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css"> --}}
    <link href="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-2.1.8/datatables.min.css" rel="stylesheet">
    

</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->

        @include('partials.sidebar_admin')


        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler " id="headerCollapse" href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="drop2" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('/assets/images/profile/user-1.jpg') }}" alt=""
                                        width="35" height="35" class="rounded-circle">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="drop2">
                                    <li>
                                        <a href="#" class="dropdown-item"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="ti ti-logout fs-6"></i> Logout
                                        </a>
                                    </li>
                                    <!-- Form logout tersembunyi -->
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>

                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="body-wrapper-inner">
                <div class="container-fluid">
                    <!--  Row 1 -->
                    <div class="main">
                        @yield('content')

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('/assets/js/dashboard.js') }}"></script>
    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery dan DataTables -->

    

    <script src="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-2.1.8/datatables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables -->
    {{-- <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script> --}}
    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script>
        new DataTable('#datatable', {
            scrollX: true,
            scrollY: 200
        });
    </script>
</body>

</html>
