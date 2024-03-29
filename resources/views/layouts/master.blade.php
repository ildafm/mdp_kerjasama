<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @if (View::hasSection('dashboard'))
            @yield('dashboard')
        @else
            @yield('title')
        @endif
    </title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    {{-- cdn --}}
    {{-- toastr --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">

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

                {{-- PHP khusus untuk tampilan notifikasi setiap level user --}}
                @php
                    $getUserID = Auth::user()->id; //variabel untuk menampung user id
                    $getUserUnit = Auth::user()->unit_id; //variabel untuk menampung user unit
                    // Variabel penampung menampung untuk penjumlahan total notif
                    $totalKegiatanYangBelumDibaca = 0; // untuk menampung $countUnReadNotifKegiatan[0]->jumlah
                    $totalKegiatanYangBelumMemilikiBukti = 0; // untuk menampung $kegiatanPerluBukti[0]->total_kegiatan
                    $totalKegiatanYangSudahMulai = 0; // untuk menampung $totalKegiatanSudahWaktuMulai[0]->total_kegiatan_sudah_mulai_dan_tidak_memiliki_bukti
                    
                    // Jika login Admin akan menampilkan semua, selain hanya akan menampilkan yang bersangkutan
                    // Login Admin
                    if (Auth::user()->level == 'A') {
                        // menghitung jumlah kegiatan yang baru yang belum dilihat
                        $countUnReadNotifKegiatan = DB::select("SELECT kegiatans.status AS 'status', COUNT(kegiatans.status) AS 'jumlah'
                        FROM kegiatans
                        WHERE kegiatans.status = '0'
                        GROUP BY kegiatans.status");
                    
                        // menghitung waktu sejak awal kegiatan baru ditambahkan
                        $TimeKegiatan = DB::select("SELECT id, DATEDIFF(NOW(), created_at) AS 'get_day', HOUR(TIMEDIFF(NOW(), created_at)) AS 'get_hour', MINUTE(TIMEDIFF(NOW(), created_at)) AS 'get_minute', SECOND(TIMEDIFF(NOW(), created_at)) AS 'get_second'
                        FROM kegiatans
                        WHERE kegiatans.status = '0'");
                    
                        // menghitung jumlah total kegiatan yang tidak memiliki bukti
                        $kegiatanPerluBukti = DB::select("SELECT COUNT(*) AS 'total_kegiatan' FROM (
                            SELECT kegiatans.id, COUNT(bukti_kegiatans.kegiatans_id) AS 'total_kegiatan'
                            FROM kegiatans
                            LEFT JOIN bukti_kegiatans ON kegiatans.id = bukti_kegiatans.kegiatans_id
                            GROUP BY kegiatans.id
                        ) AS tbl_kegiatan_perlu_bukti
                        WHERE tbl_kegiatan_perlu_bukti.total_kegiatan = 0");
                    
                        // menghitung waktu kegiatan yang sudah lewat waktu sampai tetapi belum memiliki bukti
                        $kegiatanSudahLewatWaktuSampai = DB::select("SELECT * FROM (
                            SELECT kegiatans.id, COUNT(bukti_kegiatans.kegiatans_id) AS 'total_bukti_kegiatan', DATEDIFF(kegiatans.tanggal_sampai, NOW()) AS 'get_day'
                            FROM kegiatans
                            LEFT JOIN bukti_kegiatans ON kegiatans.id = bukti_kegiatans.kegiatans_id
                            GROUP BY kegiatans.id, bukti_kegiatans.kegiatans_id, kegiatans.tanggal_sampai
                            ORDER BY DATEDIFF(kegiatans.tanggal_sampai, NOW()) DESC
                        ) AS tbl_kegiatan_sudah_lewat_waktu_sampai
                        WHERE tbl_kegiatan_sudah_lewat_waktu_sampai.total_bukti_kegiatan = 0 AND tbl_kegiatan_sudah_lewat_waktu_sampai.get_day <= 0
                        ORDER BY tbl_kegiatan_sudah_lewat_waktu_sampai.get_day");
                    
                        // menghitung total kegiatan yang sudah memasuki waktu mulai tetapi belum memiliki bukti
                        $totalKegiatanSudahWaktuMulai = DB::select("SELECT COUNT(*) AS 'total_kegiatan_sudah_mulai_dan_tidak_memiliki_bukti' FROM  (
                            SELECT kegiatans.id, COUNT(bukti_kegiatans.kegiatans_id) AS 'total_bukti_kegiatan', DATEDIFF(kegiatans.tanggal_sampai, NOW()) AS 'get_day'
                            FROM kegiatans
                            LEFT JOIN bukti_kegiatans ON kegiatans.id = bukti_kegiatans.kegiatans_id
                            GROUP BY kegiatans.id, bukti_kegiatans.kegiatans_id, kegiatans.tanggal_sampai
                            ORDER BY DATEDIFF(kegiatans.tanggal_sampai, NOW()) DESC
                        ) AS tbl_kegiatan_sudah_lewat_waktu_sampai
                        WHERE tbl_kegiatan_sudah_lewat_waktu_sampai.total_bukti_kegiatan = 0 AND tbl_kegiatan_sudah_lewat_waktu_sampai.get_day <= 0
                        GROUP BY tbl_kegiatan_sudah_lewat_waktu_sampai.total_bukti_kegiatan");
                    }
                    
                    // Login Dekan
                    elseif (Auth::user()->level == 'E') {
                        // menghitung jumlah kegiatan yang baru yang belum dilihat
                        $countUnReadNotifKegiatan = DB::select("SELECT kegiatans.status AS 'status', COUNT(kegiatans.status) AS 'jumlah'
                        FROM kegiatans
                        JOIN kerjasamas ON kerjasamas.id = kerjasama_id
                        JOIN usulans ON usulans.id = usulan_id
                        JOIN units ON units.id = unit_id
                        WHERE kegiatans.status = 0 AND (units.parent_unit = $getUserUnit OR units.id = $getUserUnit OR kegiatans.user_id = $getUserID)
                        GROUP BY kegiatans.status");
                    
                        // menghitung waktu sejak awal kegiatan baru ditambahkan
                        $TimeKegiatan = DB::select("SELECT kegiatans.id, DATEDIFF(NOW(), kegiatans.created_at) AS 'get_day', HOUR(TIMEDIFF(NOW(), kegiatans.created_at)) AS 'get_hour', MINUTE(TIMEDIFF(NOW(), kegiatans.created_at)) AS 'get_minute', SECOND(TIMEDIFF(NOW(), kegiatans.created_at)) AS 'get_second' FROM kegiatans
                        JOIN kerjasamas ON kerjasamas.id = kerjasama_id
                        JOIN usulans ON usulans.id = usulan_id
                        JOIN units ON units.id = unit_id
                        WHERE kegiatans.status = '0' AND (units.parent_unit = $getUserUnit OR units.id = $getUserUnit OR kegiatans.user_id = $getUserID)");
                    
                        // menghitung jumlah total kegiatan yang tidak memiliki bukti
                        $kegiatanPerluBukti = DB::select("SELECT COUNT(*) AS 'total_kegiatan' FROM (
                            SELECT COUNT(bukti_kegiatans.kegiatans_id) AS 'total_kegiatan'
                            FROM kegiatans
                            LEFT JOIN bukti_kegiatans ON kegiatans.id = bukti_kegiatans.kegiatans_id
                            JOIN kerjasamas ON kerjasamas.id = kerjasama_id
                            JOIN usulans ON usulans.id = usulan_id
                            JOIN units ON units.id = unit_id
                            WHERE (units.parent_unit = $getUserUnit OR units.id = $getUserUnit OR kegiatans.user_id = $getUserID)
                            GROUP BY kegiatans.id
                        ) AS tbl_kegiatan_perlu_bukti
                        WHERE tbl_kegiatan_perlu_bukti.total_kegiatan = 0");
                    
                        // menghitung waktu kegiatan yang sudah memasuki waktu mulai tetapi belum memiliki bukti
                        $kegiatanSudahLewatWaktuSampai = DB::select("SELECT tbl_kegiatan_sudah_lewat_waktu_sampai.* FROM (
                            SELECT kegiatans.id, COUNT(bukti_kegiatans.kegiatans_id) AS 'total_bukti_kegiatan', DATEDIFF(kegiatans.tanggal_sampai, NOW()) AS 'get_day'
                            FROM kegiatans
                            LEFT JOIN bukti_kegiatans ON kegiatans.id = bukti_kegiatans.kegiatans_id
                            JOIN kerjasamas ON kerjasamas.id = kerjasama_id
                            JOIN usulans ON usulans.id = usulan_id
                            JOIN units ON units.id = unit_id
                            WHERE units.parent_unit = $getUserUnit OR units.id = $getUserUnit OR kegiatans.user_id = $getUserID
                            GROUP BY kegiatans.id, bukti_kegiatans.kegiatans_id, kegiatans.tanggal_sampai
                            ORDER BY DATEDIFF(kegiatans.tanggal_sampai, NOW()) DESC
                        ) AS tbl_kegiatan_sudah_lewat_waktu_sampai
                        WHERE tbl_kegiatan_sudah_lewat_waktu_sampai.total_bukti_kegiatan = 0 AND tbl_kegiatan_sudah_lewat_waktu_sampai.get_day <= 0
                        ORDER BY tbl_kegiatan_sudah_lewat_waktu_sampai.get_day");
                    
                        // menghitung total kegiatan yang sudah memasuki waktu mulai tetapi belum memiliki bukti
                        $totalKegiatanSudahWaktuMulai = DB::select("SELECT COUNT(*) AS 'total_kegiatan_sudah_mulai_dan_tidak_memiliki_bukti' FROM (
                            SELECT kegiatans.id, COUNT(bukti_kegiatans.kegiatans_id) AS 'total_bukti_kegiatan', DATEDIFF(kegiatans.tanggal_sampai, NOW()) AS 'get_day'
                            FROM kegiatans
                            LEFT JOIN bukti_kegiatans ON kegiatans.id = bukti_kegiatans.kegiatans_id
                            JOIN kerjasamas ON kerjasamas.id = kerjasama_id
                            JOIN usulans ON usulans.id = usulan_id
                            JOIN units ON units.id = unit_id
                            WHERE units.parent_unit = $getUserUnit OR units.id = $getUserUnit OR kegiatans.user_id = $getUserID
                            GROUP BY kegiatans.id, bukti_kegiatans.kegiatans_id, kegiatans.tanggal_sampai
                            ORDER BY DATEDIFF(kegiatans.tanggal_sampai, NOW()) DESC
                        ) AS tbl_kegiatan_sudah_lewat_waktu_sampai
                        WHERE tbl_kegiatan_sudah_lewat_waktu_sampai.total_bukti_kegiatan = 0 AND tbl_kegiatan_sudah_lewat_waktu_sampai.get_day <= 0
                        GROUP BY tbl_kegiatan_sudah_lewat_waktu_sampai.total_bukti_kegiatan");
                    }
                    
                    // Login Kaprodi(K) atau Kepala Unit(U)
                    elseif (Auth::user()->level == 'K' || Auth::user()->level == 'U') {
                        // menghitung jumlah kegiatan yang baru yang belum dilihat
                        $countUnReadNotifKegiatan = DB::select("SELECT kegiatans.status AS 'status', COUNT(kegiatans.status) AS 'jumlah'
                        FROM kegiatans
                        JOIN kerjasamas ON kerjasamas.id = kerjasama_id
                        JOIN usulans ON usulans.id = usulan_id
                        JOIN units ON units.id = unit_id
                        WHERE kegiatans.status = 0 AND (units.id = $getUserUnit OR kegiatans.user_id = $getUserID)
                        GROUP BY kegiatans.status");
                    
                        // menghitung waktu sejak awal kegiatan baru ditambahkan
                        $TimeKegiatan = DB::select("SELECT kegiatans.id, DATEDIFF(NOW(), kegiatans.created_at) AS 'get_day', HOUR(TIMEDIFF(NOW(), kegiatans.created_at)) AS 'get_hour', MINUTE(TIMEDIFF(NOW(), kegiatans.created_at)) AS 'get_minute', SECOND(TIMEDIFF(NOW(), kegiatans.created_at)) AS 'get_second'
                        FROM kegiatans
                        JOIN kerjasamas ON kerjasamas.id = kerjasama_id
                        JOIN usulans ON usulans.id = usulan_id
                        JOIN units ON units.id = unit_id
                        WHERE kegiatans.status = '0' AND (units.id = $getUserUnit OR kegiatans.user_id = $getUserID)");
                    
                        // menghitung jumlah total kegiatan yang tidak memiliki bukti
                        $kegiatanPerluBukti = DB::select("SELECT COUNT(*) AS 'total_kegiatan' FROM (
                            SELECT kegiatans.id, COUNT(bukti_kegiatans.kegiatans_id) AS 'total_kegiatan'
                            FROM kegiatans
                            LEFT JOIN bukti_kegiatans ON kegiatans.id = bukti_kegiatans.kegiatans_id
                            JOIN kerjasamas ON kerjasamas.id = kerjasama_id
                            JOIN usulans ON usulans.id = usulan_id
                            JOIN units ON units.id = unit_id
                            WHERE units.id = $getUserUnit OR kegiatans.user_id = $getUserID
                            GROUP BY kegiatans.id
                        ) AS tbl_kegiatan_perlu_bukti
                        WHERE tbl_kegiatan_perlu_bukti.total_kegiatan = 0");
                    
                        // menghitung waktu kegiatan yang sudah memasuki waktu mulai tetapi belum memiliki bukti
                        $kegiatanSudahLewatWaktuSampai = DB::select("SELECT * FROM (
                            SELECT kegiatans.id, COUNT(bukti_kegiatans.kegiatans_id) AS 'total_bukti_kegiatan', DATEDIFF(kegiatans.tanggal_sampai, NOW()) AS 'get_day'
                            FROM kegiatans
                            LEFT JOIN bukti_kegiatans ON kegiatans.id = bukti_kegiatans.kegiatans_id
                            JOIN kerjasamas ON kerjasamas.id = kerjasama_id
                            JOIN usulans ON usulans.id = usulan_id
                            JOIN units ON units.id = unit_id
                            WHERE units.id = $getUserUnit OR kegiatans.user_id = $getUserID
                            GROUP BY kegiatans.id, bukti_kegiatans.kegiatans_id, kegiatans.tanggal_sampai
                            ORDER BY DATEDIFF(kegiatans.tanggal_sampai, NOW()) DESC
                        ) AS tbl_kegiatan_sudah_lewat_waktu_sampai
                        WHERE tbl_kegiatan_sudah_lewat_waktu_sampai.total_bukti_kegiatan = 0 AND tbl_kegiatan_sudah_lewat_waktu_sampai.get_day <= 0
                        ORDER BY tbl_kegiatan_sudah_lewat_waktu_sampai.get_day");
                    
                        // menghitung total kegiatan yang sudah memasuki waktu mulai tetapi belum memiliki bukti
                        $totalKegiatanSudahWaktuMulai = DB::select("SELECT COUNT(*) AS 'total_kegiatan_sudah_mulai_dan_tidak_memiliki_bukti' FROM (
                            SELECT kegiatans.id, COUNT(bukti_kegiatans.kegiatans_id) AS 'total_bukti_kegiatan', DATEDIFF(kegiatans.tanggal_sampai, NOW()) AS 'get_day'
                            FROM kegiatans
                            LEFT JOIN bukti_kegiatans ON kegiatans.id = bukti_kegiatans.kegiatans_id
                            JOIN kerjasamas ON kerjasamas.id = kerjasama_id
                            JOIN usulans ON usulans.id = usulan_id
                            JOIN units ON units.id = unit_id
                            WHERE units.id = $getUserUnit OR kegiatans.user_id = $getUserID
                            GROUP BY kegiatans.id, bukti_kegiatans.kegiatans_id, kegiatans.tanggal_sampai
                            ORDER BY DATEDIFF(kegiatans.tanggal_sampai, NOW()) DESC
                        ) AS tbl_kegiatan_sudah_lewat_waktu_sampai
                        WHERE tbl_kegiatan_sudah_lewat_waktu_sampai.total_bukti_kegiatan = 0 AND tbl_kegiatan_sudah_lewat_waktu_sampai.get_day <= 0
                        GROUP BY tbl_kegiatan_sudah_lewat_waktu_sampai.total_bukti_kegiatan");
                    }
                    
                    // Login Dosen
                    else {
                        // menghitung jumlah kegiatan yang baru yang belum dilihat
                        $countUnReadNotifKegiatan = DB::select("SELECT kegiatans.status AS 'status', COUNT(kegiatans.status) AS 'jumlah'
                        FROM kegiatans
                        WHERE kegiatans.user_id = $getUserID AND kegiatans.status = '0'
                        GROUP BY kegiatans.status");
                    
                        // menghitung waktu sejak awal kegiatan baru ditambahkan
                        $TimeKegiatan = DB::select("SELECT id, DATEDIFF(NOW(), created_at) AS 'get_day', HOUR(TIMEDIFF(NOW(), created_at)) AS 'get_hour', MINUTE(TIMEDIFF(NOW(), created_at)) AS 'get_minute', SECOND(TIMEDIFF(NOW(), created_at)) AS 'get_second'
                        FROM kegiatans
                        WHERE kegiatans.user_id = $getUserID AND kegiatans.status = '0'");
                    
                        // menghitung jumlah total kegiatan yang tidak memiliki bukti
                        $kegiatanPerluBukti = DB::select("SELECT COUNT(*) AS 'total_kegiatan' FROM (
                            SELECT kegiatans.id, COUNT(bukti_kegiatans.kegiatans_id) AS 'total_kegiatan'
                            FROM kegiatans
                            LEFT JOIN bukti_kegiatans ON kegiatans.id = bukti_kegiatans.kegiatans_id
                            WHERE kegiatans.user_id = $getUserID
                            GROUP BY kegiatans.id
                        ) AS tbl_kegiatan_perlu_bukti
                        WHERE tbl_kegiatan_perlu_bukti.total_kegiatan = 0");
                    
                        // menghitung waktu kegiatan yang sudah memasuki waktu mulai tetapi belum memiliki bukti
                        $kegiatanSudahLewatWaktuSampai = DB::select("SELECT * FROM (
                            SELECT kegiatans.id, COUNT(bukti_kegiatans.kegiatans_id) AS 'total_bukti_kegiatan', DATEDIFF(kegiatans.tanggal_sampai, NOW()) AS 'get_day'
                            FROM kegiatans
                            LEFT JOIN bukti_kegiatans ON kegiatans.id = bukti_kegiatans.kegiatans_id
                            WHERE kegiatans.user_id = $getUserID GROUP BY kegiatans.id, bukti_kegiatans.kegiatans_id, kegiatans.tanggal_sampai
                            ORDER BY DATEDIFF(kegiatans.tanggal_sampai, NOW()) DESC
                        ) AS tbl_kegiatan_waktu_mulai
                        WHERE tbl_kegiatan_waktu_mulai.total_bukti_kegiatan = 0 AND tbl_kegiatan_waktu_mulai.get_day <= 0");
                    
                        // menghitung total kegiatan yang sudah memasuki waktu mulai tetapi belum memiliki bukti
                        $totalKegiatanSudahWaktuMulai = DB::select("SELECT COUNT(*) AS 'total_kegiatan_sudah_mulai_dan_tidak_memiliki_bukti' FROM (
                            SELECT kegiatans.id, COUNT(bukti_kegiatans.kegiatans_id) AS 'total_bukti_kegiatan', DATEDIFF(kegiatans.tanggal_sampai, NOW()) AS 'get_day'
                            FROM kegiatans
                            LEFT JOIN bukti_kegiatans ON kegiatans.id = bukti_kegiatans.kegiatans_id
                            WHERE kegiatans.user_id = $getUserID 
                            GROUP BY kegiatans.id, bukti_kegiatans.kegiatans_id, kegiatans.tanggal_sampai
                            ORDER BY DATEDIFF(kegiatans.tanggal_sampai, NOW()) DESC
                        ) AS tbl_kegiatan_sudah_lewat_waktu_sampai
                        WHERE tbl_kegiatan_sudah_lewat_waktu_sampai.total_bukti_kegiatan = 0 AND tbl_kegiatan_sudah_lewat_waktu_sampai.get_day <= 0
                        GROUP BY tbl_kegiatan_sudah_lewat_waktu_sampai.total_bukti_kegiatan");
                    }
                    
                    // Kondisi Untuk Mengisi Variabel Penampung Digunakan untuk semua level user
                    if (count($countUnReadNotifKegiatan) > 0) {
                        $totalKegiatanYangBelumDibaca = $countUnReadNotifKegiatan[0]->jumlah;
                    }
                    // Kondisi Untuk Mengisi Variabel Penampung Digunakan untuk semua level user
                    if ($kegiatanPerluBukti[0]->total_kegiatan > 0) {
                        $totalKegiatanYangBelumMemilikiBukti = $kegiatanPerluBukti[0]->total_kegiatan;
                    }
                    // Kondisi Untuk Mengisi Variabel Penampung Digunakan untuk semua level user
                    if (count($totalKegiatanSudahWaktuMulai) > 0) {
                        $totalKegiatanYangSudahMulai = $totalKegiatanSudahWaktuMulai[0]->total_kegiatan_sudah_mulai_dan_tidak_memiliki_bukti;
                    }
                    
                    // menjumlahkan total notifikasi
                    $totalNotifications = $totalKegiatanYangBelumDibaca + $totalKegiatanYangSudahMulai;
                    $bellNotif = $totalKegiatanYangBelumDibaca + $totalKegiatanYangSudahMulai;
                @endphp

                {{-- Bell Notifikasi --}}
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
                        <a href="{{ url('/notification_kegiatans') }}" class="dropdown-item">
                            <i class="fas fa-briefcase mr-2"></i>
                            @if (count($countUnReadNotifKegiatan) > 0)
                                {{ $countUnReadNotifKegiatan[0]->jumlah }} kegiatan baru
                                <span class="float-right text-muted text-sm">
                                    @php
                                        if ($TimeKegiatan[0]->get_day <= 0) {
                                            if ($TimeKegiatan[0]->get_hour <= 0) {
                                                if ($TimeKegiatan[0]->get_minute <= 0) {
                                                    echo $TimeKegiatan[0]->get_second, ' secs';
                                                } else {
                                                    echo $TimeKegiatan[0]->get_minute, ' mins';
                                                }
                                            } else {
                                                echo $TimeKegiatan[0]->get_hour, ' hour';
                                            }
                                        } else {
                                            echo $TimeKegiatan[0]->get_day, ' day';
                                        }
                                    @endphp
                                </span>
                            @else
                                0 kegiatan baru <span class="float-right text-muted text-sm">0 secs</span>
                            @endif

                        </a>

                        <div class="dropdown-divider"></div>
                        {{-- Notifikasi kegiatan belum memiliki bukti kegiatan --}}
                        <a href="/notification_kegiatan_belum_ada_buktis" class="dropdown-item">
                            <i class="fas fa-copy mr-2"></i>
                            @if (count($kegiatanSudahLewatWaktuSampai) > 0)
                                {{ count($kegiatanSudahLewatWaktuSampai) }} kegiatan belum ada laporan
                                <span class="float-right text-muted text-sm">
                                    @php
                                        echo abs($kegiatanSudahLewatWaktuSampai[0]->get_day), ' day';
                                    @endphp
                                </span>
                            @else
                                0 kegiatan belum ada laporan <span class="float-right text-muted text-sm">0 day </span>
                            @endif

                        </a>

                        @if (Auth::user()->level != 'D')
                            <div class="dropdown-divider"></div>
                            {{-- Button Reminders --}}
                            <a href="{{ url('reminder') }}" class="dropdown-item">
                                <button class="btn btn-primary btn-block"
                                    title="Kirimkan pesan email kepada semua pic yang belum memberikan laporan terkait kegiatan selama lebih dari 30 hari terakhir"><i
                                        class="fas fa-paper-plane mr-2">
                                    </i><span>Send Reminder</span>
                                </button>
                            </a>
                        @endif

                        <div class="dropdown-divider"></div>
                    </div>
                </li>

                {{-- Setting --}}
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-cog"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                        {{-- Profile --}}
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('profiles.edit', ['profile' => Auth::user()->id]) }}" class="dropdown-item">
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

        {{-- main side --}}
        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <a href="{{ url('/dashboard') }}" class="brand-link">
                <img style="width: 38px; height: 38px" src="{{ asset('dist/img/logo-UMDP.png') }}" alt="UMDP"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">MDP KERMA</span>
            </a>

            {{-- side --}}
            <div class="sidebar">

                {{-- Info User --}}
                <div class="user-panel mt-3 pb-3 d-flex">
                    <div class="image mt-2">
                        {{-- Photo Profile --}}
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
                        <a href="{{ route('profiles.edit', ['profile' => Auth::user()->id]) }}" class="">
                            {{ Auth::user()->name }}<br>
                            @php
                                if (Auth::user()->level == 'A') {
                                    echo 'Admin';
                                } elseif (Auth::user()->level == 'E') {
                                    echo 'Dekan';
                                } elseif (Auth::user()->level == 'K') {
                                    echo 'Kaprodi';
                                } elseif (Auth::user()->level == 'U') {
                                    echo 'Kepala Unit';
                                } else {
                                    echo 'Dosen';
                                }
                            @endphp
                        </a>
                        <br>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        {{-- Dashboard --}}
                        <li class="nav-item">
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

                        {{-- Kerjasama --}}
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-handshake"></i>
                                <p>
                                    Kerjasama
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                {{-- Semua Kerjasama --}}
                                <li class="nav-item">
                                    <a href="{{ url('/kerjasamas') }}" class="nav-link">
                                        <i class="fas fa-folder nav-icon"></i>
                                        <p>Semua Kerjasama</p>
                                    </a>
                                </li>
                                {{-- Kerjasama yang Hanya Dengan MoU --}}
                                <li class="nav-item">
                                    <a href="{{ url('/kerjasama_dengan_mous') }}" class="nav-link">
                                        <i class="fas fa-folder nav-icon"></i>
                                        <p>Kerjasama Dengan MoU</p>
                                    </a>
                                </li>
                                {{-- Kerjasama yang tidak memiliki mou --}}
                                <li class="nav-item">
                                    <a href="{{ url('/kerjasama_tanpa_mous') }}" class="nav-link">
                                        <i class="fas fa-folder nav-icon"></i>
                                        <p>Kerjasama Tanpa MoU</p>
                                    </a>
                                </li>

                                {{-- arsip kerjasama (hanya view) --}}
                                <li class="nav-item">
                                    <a href="{{ url('/arsip_kerjasamas') }}" class="nav-link">
                                        <i class="fas fa-folder nav-icon"></i>
                                        <p>Arsip Kerjasama</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- Kegiatans --}}
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-briefcase"></i>
                                <p>
                                    Kegiatan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                {{-- Semua Kegiatan --}}
                                <li class="nav-item">
                                    <a href="{{ url('/kegiatans') }}" class="nav-link">
                                        <i class="fas fa-folder nav-icon"></i>
                                        <p>Semua Kegiatan</p>
                                    </a>
                                </li>
                                {{-- Kegiatan yang ditampilkan berdasarkan mitra --}}
                                <li class="nav-item">
                                    <a href="{{ url('/kegiatan_berdasarkan_mitras') }}" class="nav-link">
                                        <i class="fas fa-folder nav-icon"></i>
                                        <p>Berdasarkan Mitra</p>
                                    </a>
                                </li>
                                {{-- Semua Bukti/Laporan Kegiatan --}}
                                <li class="nav-item">
                                    <a href="{{ url('/semua_laporan_kegiatans') }}" class="nav-link">
                                        <i class="fas fa-folder nav-icon"></i>
                                        <p>Laporan Kegiatan</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- Admin Only --}}
                        @if (Auth::user()->level == 'A')
                            {{-- Other --}}
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-archive"></i>
                                    <p>
                                        Other
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    {{-- Users --}}
                                    <li class="nav-item">
                                        <a href="{{ url('/users') }}" class="nav-link">
                                            <i class="nav-icon fas fa-user"></i>
                                            <p>
                                                User
                                            </p>
                                        </a>
                                    </li>

                                    {{-- Klasisifikasi Mitra --}}
                                    <li class="nav-item">
                                        <a href="{{ url('/klasifikasi_mitras') }}" class="nav-link">
                                            <i class="nav-icon far fa-object-group"></i>
                                            <p>Klasifikasi Mitra</p>
                                        </a>
                                    </li>

                                    {{-- Bentuk Kegiatan --}}
                                    <li class="nav-item">
                                        <a href="{{ url('/bentuk_kegiatans') }}" class="nav-link">
                                            <i class="nav-icon fas fa-shapes"></i>
                                            <p>Bentuk Kegiatan</p>
                                        </a>
                                    </li>

                                    {{-- Negara --}}
                                    <li class="nav-item">
                                        <a href="{{ url('/negaras') }}" class="nav-link">
                                            <i class="nav-icon fas fa-globe"></i>
                                            <p>Negara</p>
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
                                                Status Kerjasama
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fas fa-layer-group"></i>
                                            <p>
                                                Kategori
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        {{-- Kategori --}}
                                        <ul class="nav nav-treeview">
                                            {{-- Kategori Kerjasama --}}
                                            <li class="nav-item">
                                                <a href="{{ url('/kategoris') }}" class="nav-link">
                                                    <i class="nav-icon fas fa-folder"></i>
                                                    <p>
                                                        Kategori Kerjasama
                                                    </p>
                                                </a>
                                            </li>
                                            {{-- Kategori Mou --}}
                                            <li class="nav-item">
                                                <a href="{{ url('/kategori_mous') }}" class="nav-link">
                                                    <i class="nav-icon fas fa-folder"></i>
                                                    <p>
                                                        Kategori Mou
                                                    </p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
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
            <strong>Copyright &copy; 2022 MDP Kerjasama
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

    {{-- toastr --}}
    {{-- <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script> --}}

    {{-- cdn --}}
    {{-- toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>

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
            $('#dashboardOnly1').DataTable({
                "paging": false,
                "ordering": false,
                "lengthChange": false,
                "searching": false,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });
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

    {{-- auto logout --}}
    <script>
        $(function() {
            bsCustomFileInput.init();
        });

        // autologout
        $(document).ready(function() {
            const timeout = 300000; // 1000 ms = 1 detik // 300000 ms = 5 menit
            var idleTimer = null;
            $('*').bind(
                'mousemove click mouseup mousedown keydown keypress keyup submit change mouseenter scroll resize dblclick',
                function() {
                    clearTimeout(idleTimer);

                    idleTimer = setTimeout(function() {
                        document.getElementById('logout-form').submit();
                    }, timeout);
                });
            $("body").trigger("mousemove");
        });
    </script>

    {{-- call the toastr --}}
    <script>
        @if (Session::has('info'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('info') }}");
                    break;

                case 'warning':
                    toastr.warning("{{ Session::get('info') }}");
                    break;

                case 'success':
                    toastr.success("{{ Session::get('info') }}");
                    break;

                case 'error':
                    toastr.error("{{ Session::get('info') }}");
                    break;
            }
        @endif
    </script>

    <script>
        // mencegah agar tidak terjadinya double klik ketika submit form
        function disableBtnSubmitCreateForm() {
            document.getElementById("btn-submit-create").disabled = true
        }

        function disableBtnSubmitCreateForm_2() {
            document.getElementById("btn-submit-create-2").disabled = true
        } //biasanya digunakan di view show

        function disableBtnSubmitEditForm() {
            document.getElementById("btn-submit-edit").disabled = true

        }

        function disableBtnSubmitDelForm() {
            document.getElementById("btn-submit-delete").disabled = true
        }

        function disableBtnSubmitDelForm_2() {
            document.getElementById("btn-submit-delete-2").disabled = true
        } //biasanya digunakan di view show
    </script>
</body>

</html>
