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
            </ul>

            <ul class="navbar-nav ml-auto">
                {{-- Tanggal dan Hari --}}
                <li>
                    <a id="date" style="color:rgb(0, 0, 0)" class="nav-link"></a>
                </li>

                @php
                    // Jika login Admin akan menampilkan semua, jika dosen hanya akan menampilkan yang bersangkutan
                    // Login selain dosen
                    if (Auth::user()->level != 'D') {
                        $countUnReadNotifKegiatan = DB::select("SELECT kegiatans.status AS 'status', COUNT(kegiatans.status) AS 'jumlah' FROM kegiatans WHERE kegiatans.status = '0' GROUP BY kegiatans.status");
                    
                        $countTimeKegiatan = DB::select("SELECT id, DATEDIFF(NOW(), created_at) AS 'datediff', HOUR(TIMEDIFF(NOW(), created_at)) AS 'get_hour', MINUTE(TIMEDIFF(NOW(), created_at)) AS 'get_minute', SECOND(TIMEDIFF(NOW(), created_at)) AS 'get_second' FROM kegiatans WHERE kegiatans.status = '0'");
                    
                        $kegiatansPerluBukti = DB::select("SELECT kegiatans.id, COUNT(bukti_kegiatans.kegiatans_id) AS 'total_kegiatan' FROM kegiatans LEFT JOIN bukti_kegiatans ON kegiatans.id = bukti_kegiatans.kegiatans_id GROUP BY kegiatans.id");
                    
                        $countKegiatanTanpaBukti = 0;
                        for ($i = 0; $i < count($kegiatansPerluBukti); $i++) {
                            if ($kegiatansPerluBukti[$i]->total_kegiatan == 0) {
                                $countKegiatanTanpaBukti++;
                            }
                        }
                    
                        $countTimeBukti = DB::select("SELECT kegiatans.id, COUNT(bukti_kegiatans.kegiatans_id) AS 'total_bukti_kegiatan', DATEDIFF(NOW(), kegiatans.created_at) AS 'datediff', HOUR(TIMEDIFF(NOW(), kegiatans.created_at)) AS 'get_hour', MINUTE(TIMEDIFF(NOW(), kegiatans.created_at)) AS 'get_minute', SECOND(TIMEDIFF(NOW(), kegiatans.created_at)) AS 'get_second' FROM kegiatans LEFT JOIN bukti_kegiatans ON kegiatans.id = bukti_kegiatans.kegiatans_id GROUP BY kegiatans.id, bukti_kegiatans.kegiatans_id, kegiatans.created_at");
                    
                        $kegiatanLewatWaktuSampai = DB::select("SELECT kegiatans.id, COUNT(bukti_kegiatans.kegiatans_id) AS 'total_bukti_kegiatan', DATEDIFF(NOW(), kegiatans.tanggal_sampai) AS 'datediff' FROM kegiatans LEFT JOIN bukti_kegiatans ON kegiatans.id = bukti_kegiatans.kegiatans_id GROUP BY kegiatans.id, bukti_kegiatans.kegiatans_id, kegiatans.tanggal_sampai ORDER BY DATEDIFF(NOW(), kegiatans.tanggal_sampai) DESC");
                    
                        $jumlahKegiatanLewatWaktuSampai = 0;
                        for ($i = 0; $i < count($countTimeBukti); $i++) {
                            if ($kegiatanLewatWaktuSampai[$i]->datediff < 0) {
                                $jumlahKegiatanLewatWaktuSampai++;
                            }
                        }
                    
                        for ($i = 0; $i < count($countTimeBukti); $i++) {
                            if ($countTimeBukti[$i]->total_bukti_kegiatan == 0) {
                                $countTimeBukti[0] = $countTimeBukti[$i];
                                break;
                            }
                        }
                    
                        if (count($countUnReadNotifKegiatan) > 0) {
                            $totalNotifications = $countUnReadNotifKegiatan[0]->jumlah + $countKegiatanTanpaBukti;
                        } else {
                            $totalNotifications = 0 + $countKegiatanTanpaBukti;
                        }
                        $bellNotif = $totalNotifications - $jumlahKegiatanLewatWaktuSampai;
                    }
                    // Login Dosen
                    else {
                        $getUserID = Auth::user()->id;
                    
                        $countUnReadNotifKegiatan = DB::select("SELECT kegiatans.status AS 'status', COUNT(kegiatans.status) AS 'jumlah' FROM kegiatans WHERE kegiatans.user_id = $getUserID AND kegiatans.status = '0' GROUP BY kegiatans.status");
                    
                        $countTimeKegiatan = DB::select("SELECT id, DATEDIFF(NOW(), created_at) AS 'datediff', HOUR(TIMEDIFF(NOW(), created_at)) AS 'get_hour', MINUTE(TIMEDIFF(NOW(), created_at)) AS 'get_minute', SECOND(TIMEDIFF(NOW(), created_at)) AS 'get_second' FROM kegiatans WHERE kegiatans.user_id = $getUserID AND kegiatans.status = '0'");
                    
                        $kegiatansPerluBukti = DB::select("SELECT kegiatans.id, COUNT(bukti_kegiatans.kegiatans_id) AS 'total_kegiatan' FROM kegiatans LEFT JOIN bukti_kegiatans ON kegiatans.id = bukti_kegiatans.kegiatans_id WHERE kegiatans.user_id = $getUserID GROUP BY kegiatans.id");
                    
                        $countKegiatanTanpaBukti = 0;
                        for ($i = 0; $i < count($kegiatansPerluBukti); $i++) {
                            if ($kegiatansPerluBukti[$i]->total_kegiatan == 0) {
                                $countKegiatanTanpaBukti++;
                            }
                        }
                    
                        $countTimeBukti = DB::select("SELECT kegiatans.id, COUNT(bukti_kegiatans.kegiatans_id) AS 'total_bukti_kegiatan', DATEDIFF(NOW(), kegiatans.created_at) AS 'datediff', HOUR(TIMEDIFF(NOW(), kegiatans.created_at)) AS 'get_hour', MINUTE(TIMEDIFF(NOW(), kegiatans.created_at)) AS 'get_minute', SECOND(TIMEDIFF(NOW(), kegiatans.created_at)) AS 'get_second' FROM kegiatans LEFT JOIN bukti_kegiatans ON kegiatans.id = bukti_kegiatans.kegiatans_id WHERE kegiatans.user_id = $getUserID GROUP BY kegiatans.id, bukti_kegiatans.kegiatans_id, kegiatans.created_at");
                    
                        $kegiatanLewatWaktuSampai = DB::select("SELECT kegiatans.id, COUNT(bukti_kegiatans.kegiatans_id) AS 'total_bukti_kegiatan', DATEDIFF(NOW(), kegiatans.tanggal_sampai) AS 'datediff' FROM kegiatans LEFT JOIN bukti_kegiatans ON kegiatans.id = bukti_kegiatans.kegiatans_id WHERE kegiatans.user_id = $getUserID GROUP BY kegiatans.id, bukti_kegiatans.kegiatans_id, kegiatans.tanggal_sampai ORDER BY DATEDIFF(NOW(), kegiatans.tanggal_sampai) DESC");
                    
                        $jumlahKegiatanLewatWaktuSampai = 0;
                        for ($i = 0; $i < count($kegiatanLewatWaktuSampai); $i++) {
                            if ($kegiatanLewatWaktuSampai[$i]->datediff < 0) {
                                $jumlahKegiatanLewatWaktuSampai++;
                            }
                        }
                    
                        for ($i = 0; $i < count($countTimeBukti); $i++) {
                            if ($countTimeBukti[$i]->total_bukti_kegiatan == 0) {
                                $countTimeBukti[0] = $countTimeBukti[$i];
                                break;
                            }
                        }
                    
                        if (count($countUnReadNotifKegiatan) > 0) {
                            $totalNotifications = $countUnReadNotifKegiatan[0]->jumlah + $countKegiatanTanpaBukti;
                        } else {
                            $totalNotifications = 0 + $countKegiatanTanpaBukti;
                        }
                        $bellNotif = $totalNotifications - $jumlahKegiatanLewatWaktuSampai;
                    }
                @endphp

                {{-- Message --}}
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>

                        @if ($bellNotif > 0)
                            <span class="badge badge-warning navbar-badge">{{ $bellNotif }}</span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">
                            @if ($totalNotifications > 0)
                                {{ $totalNotifications }} Notifications
                            @else
                                0 Notifications
                            @endif
                        </span>
                        <div class="dropdown-divider"></div>
                        {{-- Notifikasi kegiatan belum dibaca --}}
                        <a href="{{ url('/notification_kegiatan') }}" class="dropdown-item">
                            <i class="fas fa-briefcase mr-2"></i>
                            @if (count($countUnReadNotifKegiatan) > 0)
                                {{ $countUnReadNotifKegiatan[0]->jumlah }} kegiatan baru
                                <span class="float-right text-muted text-sm">
                                    @php
                                        if ($countTimeKegiatan[0]->datediff <= 0) {
                                            if ($countTimeKegiatan[0]->get_hour <= 0) {
                                                if ($countTimeKegiatan[0]->get_minute <= 0) {
                                                    echo $countTimeKegiatan[0]->get_second, ' secs';
                                                } else {
                                                    echo $countTimeKegiatan[0]->get_minute, ' mins';
                                                }
                                            } else {
                                                echo $countTimeKegiatan[0]->get_hour, ' hour';
                                            }
                                        } else {
                                            echo $countTimeKegiatan[0]->datediff, ' day';
                                        }
                                    @endphp
                                </span>
                            @else
                                0 kegiatan baru
                            @endif

                        </a>
                        <div class="dropdown-divider"></div>
                        {{-- Notifikasi kegiatan belum memiliki bukti kegiatan --}}
                        <a href="/notification_kegiatan_belum_ada_bukti" class="dropdown-item">
                            <i class="fas fa-copy mr-2"></i>
                            @if ($countKegiatanTanpaBukti > 0)
                                {{ $countKegiatanTanpaBukti }} kegiatan belum ada bukti
                                <span class="float-right text-muted text-sm">
                                    @php
                                        for ($i = 0; $i < count($kegiatanLewatWaktuSampai); $i++) {
                                            if ($kegiatanLewatWaktuSampai[$i]->total_bukti_kegiatan == 0) {
                                                if ($kegiatanLewatWaktuSampai[$i]->datediff > 0) {
                                                    echo $kegiatanLewatWaktuSampai[$i]->datediff, ' day';
                                                    break;
                                                }
                                            }
                                        }
                                    @endphp
                                </span>
                            @else
                                0 kegiatan perlu bukti <span class="float-right text-muted text-sm"> 0 day </span>
                            @endif

                        </a>
                        <div class="dropdown-divider"></div>
                    </div>
                </li>

                {{-- Setting --}}
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-cog"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                        @if (Auth::user()->level == 'D')
                            {{-- Profile --}}
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('profiles.edit', ['profile' => Auth::user()->id]) }}"
                                class="dropdown-item">
                                <i class="fas fa-user mr-2"></i> Profile
                            </a>
                        @endif

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
                <img style="width: 38px; height: 38px" src="{{ asset('dist/img/logo-UMDP.png') }}" alt="UMDP"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">MDP KERMA</span>
            </a>

            <div class="sidebar">

                <div class="user-panel mt-3 pb-3 d-flex">
                    <div class="image mt-2">
                        @if (empty(Auth::user()->file))
                            <img style="width: 45px; height: 45px" src="{{ asset('dist/img/user_profile.png') }}"
                                class="img-circle elevation-2" alt="User Image">
                        @else
                            <img style="width: 45px; height: 45px"
                                src="{{ asset('storage/profile/' . Auth::user()->file) }}"
                                class="img-circle elevation-2" alt="User Image">
                        @endif

                    </div>

                    {{-- Nama dan Level --}}
                    <div class="info">
                        @if (Auth::user()->level == 'A')
                            <a href="{{ route('profiles.edit', ['profile' => Auth::user()->id]) }}" class="">
                                {{ Auth::user()->name }}<br>
                                Admin
                            </a>
                        @endif

                        @if (Auth::user()->level == 'E')
                            <a href="{{ route('profiles.edit', ['profile' => Auth::user()->id]) }}" class="">
                                {{ Auth::user()->name }}<br>
                                Dekan
                            </a>
                        @endif

                        @if (Auth::user()->level == 'K')
                            <a href="{{ route('profiles.edit', ['profile' => Auth::user()->id]) }}" class="">
                                {{ Auth::user()->name }}<br>
                                Kaprodi
                            </a>
                        @endif

                        @if (Auth::user()->level == 'U')
                            <a href="{{ route('profiles.edit', ['profile' => Auth::user()->id]) }}" class="">
                                {{ Auth::user()->name }}<br>
                                Kepala Unit
                            </a>
                        @endif

                        @if (Auth::user()->level == 'D')
                            <a href="{{ route('profiles.edit', ['profile' => Auth::user()->id]) }}" class="">
                                {{ Auth::user()->name }}<br>
                                Dosen
                            </a>
                        @endif

                        <br>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item">
                            {{-- Dashboard --}}
                            <a href="{{ url('/dashboard') }}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        {{-- Mitras --}}
                        <li class="nav-item">
                            <a href="{{ url('/mitras') }}" class="nav-link">
                                <i class="nav-icon fas fa-building"></i>
                                <p>
                                    Mitra
                                </p>
                            </a>
                        </li>

                        {{-- Usulans --}}
                        <li class="nav-item">
                            <a href="{{ url('/usulans') }}" class="nav-link">
                                <i class="nav-icon fas fa-paper-plane"></i>
                                <p>
                                    Usulan
                                </p>
                            </a>
                        </li>

                        {{-- Kerjasamas --}}
                        <li class="nav-item">
                            <a href="{{ url('/kerjasamas') }}" class="nav-link">
                                <i class="nav-icon fas fa-handshake"></i>
                                <p>
                                    Kerjasama
                                </p>
                            </a>
                        </li>

                        {{-- Kegiatans --}}
                        <li class="nav-item">
                            <a href="{{ url('/kegiatans') }}" class="nav-link">
                                <i class="nav-icon fas fa-briefcase"></i>
                                <p>
                                    Kegiatan
                                </p>
                            </a>
                        </li>

                        @if (Auth::user()->level == 'A')
                            {{-- Users --}}
                            <li class="nav-item">
                                <a href="{{ url('/users') }}" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        User
                                    </p>
                                </a>
                            </li>

                            {{-- Units --}}
                            <li class="nav-item">
                                <a href="{{ url('/units') }}" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Unit
                                    </p>
                                </a>
                            </li>

                            {{-- Statuses --}}
                            <li class="nav-item">
                                <a href="{{ url('/statuses') }}" class="nav-link">
                                    <i class="nav-icon fas fa-flag"></i>
                                    <p>
                                        Status
                                    </p>
                                </a>
                            </li>

                            {{-- Kategoris --}}
                            <li class="nav-item">
                                <a href="{{ url('/kategoris') }}" class="nav-link">
                                    <i class="nav-icon fas fa-layer-group"></i>
                                    <p>
                                        Kategori
                                    </p>
                                </a>
                            </li>
                        @endif
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

    {{-- Tabel --}}
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
            $("#example3").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
        });
    </script>

    {{-- Time --}}
    <script>
        // getDate
        n = new Date();

        year = n.getFullYear(); //getYear
        date = n.getDate(); //getDate

        // listMonth
        months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
            "November", "December"
        ];
        // getMonth
        month = months[n.getMonth()];

        // listDay
        weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        // getDay
        day = weekday[n.getDay()];

        date = date < "10" ? `0${date}` : date;

        dateNow = `${day}, ${date} ${month} ${year}`;
        document.getElementById("date").innerHTML = dateNow;
    </script>

    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
</body>

</html>
