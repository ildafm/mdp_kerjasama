<?php

namespace App\Http\Controllers;

use App\Models\BuktiKegiatan;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SemuaBuktiKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $query = "SELECT bukti_kegiatans.id, bukti_kegiatans.nama_bukti_kegiatan, bukti_kegiatans.file, bukti_kegiatans.bidang, bentuk_kegiatans.bentuk AS 'bentuk_kegiatan', units.nama_unit, users.name AS 'pic_name', bukti_kegiatans.kegiatans_id
        FROM bukti_kegiatans
        JOIN kegiatans ON bukti_kegiatans.kegiatans_id = kegiatans.id
        JOIN bukti_kegiatan_units ON bukti_kegiatans.id = bukti_kegiatan_units.bukti_kegiatans_id
        JOIN units ON bukti_kegiatan_units.units_id = units.id
        JOIN bentuk_kegiatans ON kegiatans.bentuk_kegiatan_id = bentuk_kegiatans.id
        JOIN users ON kegiatans.user_id = users.id";

        $units = Unit::all();

        $buktiKegiatans = DB::select($query);

        $filterUnit = $units->first()->id;

        if (isset($_GET['filter_berdasarkan_unit'])) {
            $filterUnit = ($_GET['filter_berdasarkan_unit']);

            $buktiKegiatans = DB::select("$query WHERE units.id = $filterUnit");
        }

        return view('semua_bukti_kegiatan.index')
            ->with('units', $units)
            ->with('buktiKegiatans', $buktiKegiatans)
            ->with('filterUnit', $filterUnit);
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
