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

        return view('dashboard')
            ->with('getJumlahMitra', $getJumlahMitra)
            ->with('getJumlahUsulan', $getJumlahUsulan)
            ->with('getJumlahKerjasama', $getJumlahKerjasama)
            ->with('getJumlahKegiatan', $getJumlahKegiatan);
    }
}
