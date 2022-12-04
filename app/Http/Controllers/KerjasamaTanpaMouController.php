<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KerjasamaTanpaMouController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kerjasamas = DB::select("SELECT * FROM (
            SELECT kerjasamas.id, kerjasamas.nama_kerja_sama, bentuk_kegiatans.bentuk AS 'bentuk_kegiatan', kerjasamas.no_mou, kerjasamas.bidang, kerjasamas.tanggal_mulai, kerjasamas.tanggal_sampai, kategoris.nama_kategori, statuses.nama_status, usulans.usulan
            FROM kerjasamas
            LEFT JOIN kegiatans ON kegiatans.kerjasama_id = kerjasamas.id
            LEFT JOIN bentuk_kegiatans ON bentuk_kegiatans.id = kegiatans.bentuk_kegiatan_id
            JOIN kategoris ON kategoris.id = kerjasamas.kategori_id
            JOIN statuses ON statuses.id = kerjasamas.status_id
            JOIN usulans ON usulans.id = kerjasamas.usulan_id
            WHERE kategoris.id = '2'
        ) AS c
        WHERE c.bentuk_kegiatan IS NULL
        ORDER BY c.id");

        if (isset($_GET['filter_tanggal_mulai']) && isset($_GET['filter_tanggal_sampai'])) {
            $tanggal_mulai = ($_GET['filter_tanggal_mulai']);
            $tanggal_sampai = ($_GET['filter_tanggal_sampai']);

            $kerjasamas = DB::select("SELECT * FROM (
                SELECT kerjasamas.id, kerjasamas.nama_kerja_sama, bentuk_kegiatans.bentuk AS 'bentuk_kegiatan', kerjasamas.no_mou, kerjasamas.tanggal_mulai, kerjasamas.tanggal_sampai, kategoris.nama_kategori, statuses.nama_status, usulans.usulan, kerjasamas.bidang
                FROM kerjasamas
                LEFT JOIN kegiatans ON kegiatans.kerjasama_id = kerjasamas.id
                LEFT JOIN bentuk_kegiatans ON bentuk_kegiatans.id = kegiatans.bentuk_kegiatan_id
                JOIN kategoris ON kategoris.id = kerjasamas.kategori_id
                JOIN statuses ON statuses.id = kerjasamas.status_id
                JOIN usulans ON usulans.id = kerjasamas.usulan_id
                WHERE kategoris.id = '2'
            ) AS c
            WHERE c.bentuk_kegiatan IS NULL AND (c.tanggal_mulai >= '$tanggal_mulai' AND c.tanggal_sampai <= '$tanggal_sampai')
            ORDER BY c.id");
        } else {
            $tanggal_mulai = date('Y-m-d');
            $tanggal_sampai = date('Y-m-d');
        }

        return view('kerjasama_tanpa_mou.index')
            ->with('kerjasamas', $kerjasamas)
            ->with('tanggal_mulai', $tanggal_mulai)
            ->with('tanggal_sampai', $tanggal_sampai);
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
