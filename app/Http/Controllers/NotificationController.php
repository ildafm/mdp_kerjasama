<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function kegiatan()
    {
        //
        $getUserID = Auth::user()->id; //variabel penampung id user
        $getUserUnit = Auth::user()->unit_id; //variabel penampung unit user

        // Variabel untuk login dosen
        $kegiatansUnRead = DB::select("SELECT kegiatans.id AS 'id', kerjasamas.nama_kerja_sama, bentuk_kegiatans.bentuk AS 'bentuk_kegiatan', keterangan, users.name AS 'name', kegiatans.tanggal_mulai, kegiatans.tanggal_sampai, kegiatans.status 
        FROM kegiatans 
        JOIN bentuk_kegiatans ON bentuk_kegiatan_id = bentuk_kegiatans.id
        JOIN kerjasamas ON kerjasama_id = kerjasamas.id 
        JOIN users ON user_id = users.id 
        WHERE user_id = $getUserID AND kegiatans.status = '0' 
        ORDER BY id");

        // Variabel untuk login admin
        $kegiatansUnReadForAdmin = DB::select("SELECT kegiatans.id AS 'id', kerjasamas.nama_kerja_sama, bentuk_kegiatans.bentuk AS 'bentuk_kegiatan', keterangan, users.name AS 'name', kegiatans.tanggal_mulai, kegiatans.tanggal_sampai, kegiatans.status 
        FROM kegiatans 
        JOIN bentuk_kegiatans ON bentuk_kegiatan_id = bentuk_kegiatans.id
        JOIN kerjasamas ON kerjasama_id = kerjasamas.id 
        JOIN users ON kegiatans.user_id = users.id 
        WHERE kegiatans.status = '0' 
        ORDER BY id");

        // Variabel untuk login dekan
        $kegiatansUnReadForDekan = DB::select("SELECT kegiatans.id AS 'id', kerjasamas.nama_kerja_sama, bentuk_kegiatans.bentuk AS 'bentuk_kegiatan', kegiatans.keterangan, users.name AS 'name', kegiatans.tanggal_mulai, kegiatans.tanggal_sampai, kegiatans.status, usulans.usulan, units.nama_unit, units.parent_unit
        FROM kegiatans 
        JOIN bentuk_kegiatans ON bentuk_kegiatan_id = bentuk_kegiatans.id
        JOIN kerjasamas ON kerjasama_id = kerjasamas.id 
        JOIN usulans ON usulans.id = kerjasamas.usulan_id
        JOIN users ON kegiatans.user_id = users.id 
        JOIN units ON usulans.unit_id = units.id
        WHERE (units.parent_unit = $getUserUnit OR units.id = $getUserUnit OR kegiatans.user_id = $getUserID) AND kegiatans.status = '0' 
        ORDER BY id");

        // Variabel untuk login kaprodi dan kepala unit
        $kegiatansUnReadForKaprodiDanKepalaUnit = DB::select("SELECT kegiatans.id AS 'id', kerjasamas.nama_kerja_sama, bentuk_kegiatans.bentuk AS 'bentuk_kegiatan', kegiatans.keterangan, users.name AS 'name', kegiatans.tanggal_mulai, kegiatans.tanggal_sampai, kegiatans.status, nama_unit
        FROM kegiatans 
        JOIN bentuk_kegiatans ON bentuk_kegiatan_id = bentuk_kegiatans.id
        JOIN kerjasamas ON kerjasama_id = kerjasamas.id 
        JOIN usulans ON kerjasamas.usulan_id = usulans.id
        JOIN units ON usulans.unit_id = units.id
        JOIN users ON kegiatans.user_id = users.id 
        WHERE kegiatans.status = '0' AND (users.id = $getUserID OR units.id = $getUserUnit) 
        ORDER BY id");

        return view('notification.kegiatan')
            ->with('kegiatansUnRead', $kegiatansUnRead)
            ->with('kegiatansUnReadForDekan', $kegiatansUnReadForDekan)
            ->with('kegiatansUnReadForAdmin', $kegiatansUnReadForAdmin)
            ->with('kegiatansUnReadForKaprodiDanKepalaUnit', $kegiatansUnReadForKaprodiDanKepalaUnit);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function kegiatanPerluBukti()
    {
        //
        $getUserID = Auth::user()->id; //variabel penampung id user
        $getUserUnit = Auth::user()->unit_id; //variabel penampung unit user

        // Variabel untuk login dosen
        $listKegiatanTanpaBukti = DB::select("SELECT * FROM (
            SELECT kegiatans.id AS 'id', kegiatans.tanggal_mulai, kegiatans.tanggal_sampai, bentuk_kegiatans.bentuk AS 'bentuk_kegiatan', kegiatans.keterangan, kerjasamas.nama_kerja_sama, users.name AS 'name', kegiatans.status, COUNT(bukti_kegiatans.kegiatans_id) AS 'total_bukti', units.nama_unit
            FROM kegiatans
            JOIN bentuk_kegiatans ON bentuk_kegiatan_id = bentuk_kegiatans.id
            JOIN kerjasamas ON kerjasamas.id = kerjasama_id
            JOIN usulans ON usulans.id = kerjasamas.usulan_id
            JOIN units ON units.id = usulans.unit_id
            JOIN users ON users.id = kegiatans.user_id
            LEFT JOIN bukti_kegiatans ON kegiatans.id = bukti_kegiatans.kegiatans_id
            WHERE users.id = $getUserID
            GROUP BY kegiatans.id, kegiatans.tanggal_mulai, kegiatans.tanggal_sampai, bentuk_kegiatans.bentuk, keterangan,  kerjasamas.nama_kerja_sama, users.name, kegiatans.status, units.nama_unit
        ) AS tbl_kegiatan_tanpa_bukti
        WHERE tbl_kegiatan_tanpa_bukti.total_bukti = 0
        ORDER BY tbl_kegiatan_tanpa_bukti.tanggal_sampai");

        // Variabel untuk login admin
        $listKegiatanTanpaBuktiForAdmin = DB::select("SELECT * FROM (
            SELECT kegiatans.id AS 'id', kegiatans.tanggal_mulai, kegiatans.tanggal_sampai, bentuk_kegiatans.bentuk AS 'bentuk_kegiatan', kegiatans.keterangan, kerjasamas.nama_kerja_sama, users.name AS 'name', kegiatans.status, COUNT(bukti_kegiatans.kegiatans_id) AS 'total_bukti', units.nama_unit, ABS(DATEDIFF(kegiatans.tanggal_sampai, NOW())) as 'lewat_hari'
            FROM kegiatans
            JOIN bentuk_kegiatans ON bentuk_kegiatan_id = bentuk_kegiatans.id 
            JOIN kerjasamas ON kerjasamas.id = kerjasama_id 
            JOIN usulans ON usulans.id = kerjasamas.usulan_id
            JOIN units ON units.id = usulans.unit_id
            JOIN users ON users.id = kegiatans.user_id 
            LEFT JOIN bukti_kegiatans ON kegiatans.id = bukti_kegiatans.kegiatans_id 
            GROUP BY kegiatans.id, kegiatans.tanggal_mulai, kegiatans.tanggal_sampai, bentuk_kegiatans.bentuk, keterangan,  kerjasamas.nama_kerja_sama, users.name, kegiatans.status, units.nama_unit
        ) AS tbl_kegiatan_tanpa_bukti
        WHERE tbl_kegiatan_tanpa_bukti.total_bukti = 0
        ORDER BY tbl_kegiatan_tanpa_bukti.tanggal_sampai");

        // Variabel untuk login dekan
        $listKegiatanTanpaBuktiForDekan = DB::select("SELECT * FROM (
            SELECT kegiatans.id AS 'id', kegiatans.tanggal_mulai, kegiatans.tanggal_sampai, bentuk_kegiatans.bentuk AS 'bentuk_kegiatan', kegiatans.keterangan, kerjasamas.nama_kerja_sama, users.name AS 'name', kegiatans.status, COUNT(bukti_kegiatans.kegiatans_id) AS 'total_bukti', units.nama_unit
            FROM kegiatans
            JOIN bentuk_kegiatans ON bentuk_kegiatan_id = bentuk_kegiatans.id 
            JOIN kerjasamas ON kerjasamas.id = kegiatans.kerjasama_id 
            JOIN usulans ON usulans.id = kerjasamas.usulan_id
            JOIN units ON units.id = usulans.unit_id
            JOIN users ON users.id = kegiatans.user_id 
            LEFT JOIN bukti_kegiatans ON kegiatans.id = bukti_kegiatans.kegiatans_id 
            WHERE units.parent_unit = $getUserUnit OR units.id = $getUserUnit OR users.id = $getUserID
            GROUP BY kegiatans.id, kegiatans.tanggal_mulai, kegiatans.tanggal_sampai, bentuk_kegiatans.bentuk, kegiatans.keterangan,kerjasamas.nama_kerja_sama, users.name, kegiatans.status, units.nama_unit, kerjasamas.usulan_id
        ) AS tbl_kegiatan_tanpa_bukti
        WHERE tbl_kegiatan_tanpa_bukti.total_bukti = 0
        ORDER BY tbl_kegiatan_tanpa_bukti.tanggal_sampai");

        // Variabel untuk login kaprodi dan kepala unit
        $listKegiatanTanpaBuktiForKaprodiDanKepalaUnit = DB::select("SELECT tbl_kegiatan_tanpa_bukti.* FROM (
            SELECT kegiatans.id AS 'id', kegiatans.tanggal_mulai, kegiatans.tanggal_sampai, bentuk_kegiatans.bentuk AS 'bentuk_kegiatan', kegiatans.keterangan, kerjasamas.nama_kerja_sama, users.name AS 'name', kegiatans.status, COUNT(bukti_kegiatans.kegiatans_id) AS 'total_bukti', units.nama_unit, users.id AS 'user_id', units.id AS 'unit_id'
            FROM kegiatans
            JOIN bentuk_kegiatans ON bentuk_kegiatan_id = bentuk_kegiatans.id 
            JOIN kerjasamas ON kerjasamas.id = kegiatans.kerjasama_id 
            JOIN usulans ON usulans.id = kerjasamas.usulan_id
            JOIN units ON units.id = usulans.unit_id
            JOIN users ON users.id = kegiatans.user_id 
            LEFT JOIN bukti_kegiatans ON kegiatans.id = bukti_kegiatans.kegiatans_id 
            GROUP BY kegiatans.id, kegiatans.tanggal_mulai, kegiatans.tanggal_sampai, bentuk_kegiatans.bentuk, kegiatans.keterangan,kerjasamas.nama_kerja_sama, users.name, kegiatans.status, units.nama_unit, kerjasamas.usulan_id, users.id, units.id
        ) AS tbl_kegiatan_tanpa_bukti
        WHERE tbl_kegiatan_tanpa_bukti.total_bukti = 0 AND (tbl_kegiatan_tanpa_bukti.user_id = $getUserID OR tbl_kegiatan_tanpa_bukti.unit_id = $getUserUnit)
        ORDER BY tbl_kegiatan_tanpa_bukti.tanggal_sampai");

        return view("notification.kegiatan_perlu_bukti")
            ->with('listKegiatanTanpaBuktiForAdmin', $listKegiatanTanpaBuktiForAdmin)
            ->with('listKegiatanTanpaBuktiForDekan', $listKegiatanTanpaBuktiForDekan)
            ->with('listKegiatanTanpaBuktiForKaprodiDanKepalaUnit', $listKegiatanTanpaBuktiForKaprodiDanKepalaUnit)
            ->with('listKegiatanTanpaBukti', $listKegiatanTanpaBukti);
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
