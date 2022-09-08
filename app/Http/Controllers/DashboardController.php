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
        // getJumlah
        // infoBox
        $getJumlahMitra = DB::select("SELECT COUNT(id) as jumlahMitra FROM mitras");
        $getJumlahKerjasama = DB::select("SELECT COUNT(id) as jumlahKerjasama FROM kerjasamas");
        $getJumlahKegiatan = DB::select("SELECT COUNT(id) as jumlahKegiatan FROM kegiatans");
        $getJumlahUsulan = DB::select("SELECT COUNT(id) as jumlahUsulan FROM usulans");

        // getStatus
        $namaStatus = DB::select("SELECT id, nama_status FROM statuses");
        // countStatus
        $countStatusAktif = DB::select("SELECT statuses.nama_status as 'nama_status', COUNT(kerjasamas.status_id) as 'jumlah' FROM kerjasamas JOIN statuses ON kerjasamas.status_id = statuses.id WHERE statuses.id = '1' GROUP BY nama_status");
        $countStatusKadaluarsa = DB::select("SELECT statuses.nama_status as 'nama_status', COUNT(kerjasamas.status_id) as 'jumlah' FROM kerjasamas JOIN statuses ON kerjasamas.status_id = statuses.id WHERE statuses.id = '2' GROUP BY nama_status");
        $countStatusDalamPerpanjangan = DB::select("SELECT statuses.nama_status as 'nama_status', COUNT(kerjasamas.status_id) as 'jumlah' FROM kerjasamas JOIN statuses ON kerjasamas.status_id = statuses.id WHERE statuses.id = '3' GROUP BY nama_status");
        $countStatusTidakAktif = DB::select("SELECT statuses.nama_status as 'nama_status', COUNT(kerjasamas.status_id) as 'jumlah' FROM kerjasamas JOIN statuses ON kerjasamas.status_id = statuses.id WHERE statuses.id = '4' GROUP BY nama_status");

        // infoGrafik
        $getJumlahMitraBerdasarkanTingkatannya = DB::select("SELECT tingkat, COUNT(id) as jumlahTingkat FROM mitras GROUP BY tingkat");
        $getJumlahKegiatanBerdasarkanKerjasama = DB::select("SELECT kerjasama_id, kerjasamas.nama_kerja_sama, COUNT(kegiatans.id) as jumlahKegiatan FROM kegiatans JOIN kerjasamas ON kegiatans.kerjasama_id = kerjasamas.id GROUP BY kerjasama_id, kerjasamas.nama_kerja_sama");
        $getJumlahUsulanDosen = DB::select("SELECT kode_dosen, users.name AS 'name', COUNT(usulans.id) as jumlahUsulan FROM usulans JOIN users ON usulans.user_id = users.id GROUP BY kode_dosen, users.name");
        $getJumlahLaporanPerUnit = DB::select("SELECT units.nama_unit, COUNT(bukti_kegiatan_units.id) AS 'jumlah_laporan' FROM bukti_kegiatan_units JOIN units ON units.id = bukti_kegiatan_units.units_id GROUP BY units.nama_unit");

        // countKategoriInKerjasama
        $countKategoriInKerjasama = DB::select("SELECT kategoris.nama_kategori AS 'nama_kategori', COUNT(kategori_id) AS 'jumlah_kategori' FROM kerjasamas JOIN kategoris ON kerjasamas.kategori_id = kategoris.id GROUP BY kategoris.nama_kategori");

        return view('dashboard')
            //info box
            ->with('getJumlahMitra', $getJumlahMitra)
            ->with('getJumlahUsulan', $getJumlahUsulan)
            ->with('getJumlahKerjasama', $getJumlahKerjasama)
            ->with('getJumlahKegiatan', $getJumlahKegiatan)
            ->with('countStatusAktif', $countStatusAktif)
            ->with('countStatusKadaluarsa', $countStatusKadaluarsa)
            ->with('countStatusDalamPerpanjangan', $countStatusDalamPerpanjangan)
            ->with('countStatusTidakAktif', $countStatusTidakAktif)
            ->with('namaStatus', $namaStatus)
            //info grafik
            ->with('getJumlahKegiatanBerdasarkanKerjasama', $getJumlahKegiatanBerdasarkanKerjasama)
            ->with('getJumlahUsulanDosen', $getJumlahUsulanDosen)
            ->with('getJumlahLaporanPerUnit', $getJumlahLaporanPerUnit)
            ->with('countKategoriInKerjasama', $countKategoriInKerjasama)
            ->with('getJumlahMitraBerdasarkanTingkatannya', $getJumlahMitraBerdasarkanTingkatannya);
    }
}
