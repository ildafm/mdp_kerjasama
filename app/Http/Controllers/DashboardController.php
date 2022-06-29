<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    function index(){

        $getJumlahMitra = DB::select("SELECT COUNT(id) as jumlahMitra FROM mitras");
        $getJumlahKerjasama = DB::select("SELECT COUNT(id) as jumlahKerjasama FROM kerjasamas");
        $getJumlahKegiatan = DB::select("SELECT COUNT(id) as jumlahKegiatan FROM kegiatans");
        $getJumlahUsulan = DB::select("SELECT COUNT(id) as jumlahUsulan FROM usulans");
        $getJumlahMitraBerdasarkanTingkatannya = DB::select("SELECT tingkat, COUNT(id) as jumlahTingkat FROM mitras GROUP BY tingkat");
        $getJumlahKerjasamaDenganMitra = DB::select("SELECT mitras.nama_mitra as nama_mitra, COUNT(kerjasamas.id) as jumlah_kerjasama FROM kerjasamas JOIN mitras ON kerjasamas.mitra_id = mitras.id GROUP BY mitra_id, mitras.nama_mitra");
        $getJumlahKegiatanBerdasarkanKerjasama = DB::select("SELECT kerjasama_id, kerjasamas.nama_kerja_sama, COUNT(kegiatans.id) as jumlahKegiatan FROM kegiatans JOIN kerjasamas ON kegiatans.kerjasama_id = kerjasamas.id GROUP BY kerjasama_id, kerjasamas.nama_kerja_sama");
        $getJumlahUsulanDosen = DB::select("SELECT kode_dosen, users.name AS 'name', COUNT(usulans.id) as jumlahUsulan FROM usulans JOIN users ON usulans.user_id = users.id GROUP BY kode_dosen, users.name");
        $countStatusAktif = DB::select("SELECT statuses.nama_status as 'nama_status', COUNT(kerjasamas.status_id) as 'jumlah' FROM kerjasamas JOIN statuses ON kerjasamas.status_id = statuses.id WHERE statuses.id = '1' GROUP BY nama_status");
        $countStatusKadaluarsa = DB::select("SELECT statuses.nama_status as 'nama_status', COUNT(kerjasamas.status_id) as 'jumlah' FROM kerjasamas JOIN statuses ON kerjasamas.status_id = statuses.id WHERE statuses.id = '2' GROUP BY nama_status");
        $countStatusDalamPerpanjangan = DB::select("SELECT statuses.nama_status as 'nama_status', COUNT(kerjasamas.status_id) as 'jumlah' FROM kerjasamas JOIN statuses ON kerjasamas.status_id = statuses.id WHERE statuses.id = '3' GROUP BY nama_status");
        $countStatusTidakAktif = DB::select("SELECT statuses.nama_status as 'nama_status', COUNT(kerjasamas.status_id) as 'jumlah' FROM kerjasamas JOIN statuses ON kerjasamas.status_id = statuses.id WHERE statuses.id = '4' GROUP BY nama_status");

        return view('dashboard')
            ->with('getJumlahMitra', $getJumlahMitra)
            ->with('getJumlahUsulan', $getJumlahUsulan)
            ->with('getJumlahKerjasama', $getJumlahKerjasama)
            ->with('getJumlahKegiatan', $getJumlahKegiatan)
            ->with('getJumlahKegiatanBerdasarkanKerjasama', $getJumlahKegiatanBerdasarkanKerjasama)
            ->with('getJumlahKerjasamaDenganMitra', $getJumlahKerjasamaDenganMitra)
            ->with('getJumlahUsulanDosen', $getJumlahUsulanDosen)
            ->with('countStatusAktif', $countStatusAktif)
            ->with('countStatusKadaluarsa', $countStatusKadaluarsa)
            ->with('countStatusDalamPerpanjangan', $countStatusDalamPerpanjangan)
            ->with('countStatusTidakAktif', $countStatusTidakAktif)
            ->with('getJumlahMitraBerdasarkanTingkatannya', $getJumlahMitraBerdasarkanTingkatannya);
    }
}
