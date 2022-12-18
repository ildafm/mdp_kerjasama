<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KegiatanBerdasarkanMitraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $listMitras = DB::select("SELECT * FROM (
            SELECT mitras.id, nama_mitra, COUNT(kegiatans.id) AS 'total_kegiatan'
            FROM mitras
            LEFT JOIN usulans ON usulans.mitra_id = mitras.id
            LEFT JOIN kerjasamas ON kerjasamas.usulan_id = usulans.id
            LEFT JOIN kegiatans ON kegiatans.kerjasama_id = kerjasamas.id
            GROUP BY mitras.id, mitras.nama_mitra
            ) AS tbl_list_mitra
        ORDER BY tbl_list_mitra.total_kegiatan DESC");

        return view('kegiatan_berdasarkan_mitra.index')
            ->with('listMitras', $listMitras);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $listKegiatans = DB::select("SELECT kegiatans.id, kegiatans.tanggal_mulai, kegiatans.tanggal_sampai, kegiatans.keterangan, bentuk_kegiatans.bentuk AS 'bentuk_kegiatan', kerjasamas.nama_kerja_sama, users.name AS 'name'
        FROM kegiatans
        JOIN bentuk_kegiatans ON bentuk_kegiatan_id = bentuk_kegiatans.id
        JOIN users ON users.id = kegiatans.user_id
        JOIN kerjasamas ON kerjasamas.id = kegiatans.kerjasama_id
        JOIN usulans ON usulans.id = kerjasamas.usulan_id
        JOIN mitras ON mitras.id = usulans.mitra_id
        WHERE mitras.id = $id");

        $mitra = Mitra::find($id);

        return view("kegiatan_berdasarkan_mitra.show")
            ->with('listKegiatans', $listKegiatans)
            ->with('mitra', $mitra);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
