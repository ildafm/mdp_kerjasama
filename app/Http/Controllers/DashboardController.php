<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mitra;

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
        $getJumlahUsulanDosen = DB::select("SELECT kode_dosen, nama_dosen, COUNT(usulans.id) as jumlahUsulan FROM usulans JOIN dosens ON usulans.dosen_id = dosens.id GROUP BY kode_dosen, nama_dosen");

        return view('dashboard')
            ->with('getJumlahMitra', $getJumlahMitra)
            ->with('getJumlahUsulan', $getJumlahUsulan)
            ->with('getJumlahKerjasama', $getJumlahKerjasama)
            ->with('getJumlahKegiatan', $getJumlahKegiatan)
            ->with('getJumlahKegiatanBerdasarkanKerjasama', $getJumlahKegiatanBerdasarkanKerjasama)
            ->with('getJumlahKerjasamaDenganMitra', $getJumlahKerjasamaDenganMitra)
            ->with('getJumlahUsulanDosen', $getJumlahUsulanDosen)
            ->with('getJumlahMitraBerdasarkanTingkatannya', $getJumlahMitraBerdasarkanTingkatannya);
    }
}
