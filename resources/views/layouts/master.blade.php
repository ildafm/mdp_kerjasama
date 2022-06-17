<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') @yield('dashboard')</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    {{-- css table --}}
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    {{-- select2 --}}
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0') }}">

</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>

                <li class="nav-item d-none d-sm-inline-block">
                    <a id="date" class="nav-link"></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">

                {{-- Setting --}}
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-user-tie"></i>

                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-user mr-2"></i> Profile
                        </a>

                        <div class="dropdown-divider"></div>
                        {{-- logout button --}}
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                            class="dropdown-item">
                            <i class="fas fa-power-off mr-2"></i> Logout
                        </a>
                        {{-- logout form --}}
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>


        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <a href="{{ url('/dashboard') }}" class="brand-link">
                <img src="{{ asset('dist/img/logo-UMDP.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">MDP KERMA</span>
            </a>

            <div class="sidebar">

                <div class="user-panel mt-3 pb-3 d-flex">
                    <div class="image mt-2">
                        <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>

                    <div class="info">
                        {{-- Name User --}}
                        <a href="#" class="">{{ Auth::user()->name }}
                        </a>
                        <br>
                        @php
                            if (Auth::user()->level == 'A') {
                                echo '<a>Admin</a>';
                            } else {
                                echo '<a>Dosen</a>';
                            }
                        @endphp
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item">
                            <a href="{{ url('/dashboard') }}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/mitras') }}" class="nav-link">
                                <i class="nav-icon fas fa-building"></i>
                                <p>
                                    Mitra
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/kerjasamas') }}" class="nav-link">
                                <i class="nav-icon fas fa-handshake"></i>
                                <p>
                                    Kerjasama
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/kegiatans') }}" class="nav-link">
                                <i class="nav-icon fas fa-briefcase"></i>
                                <p>
                                    Kegiatan
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/usulans') }}" class="nav-link">
                                <i class="nav-icon fas fa-paper-plane"></i>
                                <p>
                                    Usulan
                                </p>
                            </a>
                        </li>

                        @php
                            if (Auth::user()->level == 'A') {
                                // Units
                                echo '<li class="nav-item">';
                                echo '<a href="/units" class="nav-link">';
                                echo '<i class="nav-icon fas fa-users"></i>';
                                echo '<p>';
                                echo '  Unit';
                                echo '</p>';
                                echo '</a>';
                                echo '</li>';
                            
                                // Dosens
                                echo '<li class="nav-item">';
                                echo '<a href="/dosens" class="nav-link">';
                                echo '<i class="nav-icon fas fa-user"></i>';
                                echo '<p>';
                                echo '  Dosen';
                                echo '</p>';
                                echo '</a>';
                                echo '</li>';
                            
                                // Status
                                echo '<li class="nav-item">';
                                echo '<a href="/statuses" class="nav-link">';
                                echo '<i class="nav-icon fas fa-flag"></i>';
                                echo '<p>';
                                echo '  Status';
                                echo '</p>';
                                echo '</a>';
                                echo '</li>';
                            
                                // Status
                                echo '<li class="nav-item">';
                                echo '<a href="/kategoris" class="nav-link">';
                                echo '<i class="nav-icon fas fa-layer-group"></i>';
                                echo '<p>';
                                echo '  Kategori';
                                echo '</p>';
                                echo '</a>';
                                echo '</li>';
                            
                                // Users
                                echo '<li class="nav-item">';
                                echo '<a href="/users" class="nav-link">';
                                echo '<i class="nav-icon fas fa-address-card"></i>';
                                echo '<p>';
                                echo '  User';
                                echo '</p>';
                                echo '</a>';
                                echo '</li>';
                            }
                        @endphp

                        {{-- <li class="nav-item">
                            <a href="{{ url('/statuses') }}" class="nav-link">
                                <i class="nav-icon fas fa-flag"></i>
                                <p>
                                    Status
                                </p>
                            </a>
                        </li> --}}

                        {{-- <li class="nav-item">
                            <a href="{{ url('/kategoris') }}" class="nav-link">
                                <i class="nav-icon fas fa-layer-group"></i>
                                <p>
                                    Kategori
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/users') }}" class="nav-link">
                                <i class="nav-icon fas fa-address-card"></i>
                                <p>
                                    User
                                </p>
                            </a>
                        </li> --}}
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">

            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            @if (View::hasSection('dashboard'))
                                <h1>@yield('dashboard')</h1>
                            @else
                                <h1>@yield('title')</h1>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @if (View::hasSection('dashboard'))
                                    <li class="breadcrumb-item active">@yield('dashboard')</li>
                                @else
                                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active">@yield('title')</li>
                                @endif

                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                @yield('content')
            </section>

        </div>

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>

        <aside class="control-sidebar control-sidebar-dark">

        </aside>

    </div>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    {{-- bs-custom-file-input --}}
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    {{-- Data Tables --}}
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    {{-- select2 --}}
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    {{-- chart --}}
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
        });
    </script>


    <script src="{{ asset('dist/js/adminlte.min.js?v=3.2.0') }}"></script>

    {{-- <script src="{{ asset('dist/js/demo.js') }}"></script> --}}

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

    <script>
        // getDate
        n = new Date();
        year = n.getFullYear(); //getYear
        date = n.getDate(); //getDate

        // getMonth
        months = ["January", "February", "March", "April", "May", "June", "August", "September", "October", "November",
            "December"
        ];
        month = months[n.getMonth()];

        // getDay
        weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        day = weekday[n.getDay()];



        document.getElementById("date").innerHTML = day + ", " + date + " " + month + " " + year;
    </script>

    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
</body>

</html>
