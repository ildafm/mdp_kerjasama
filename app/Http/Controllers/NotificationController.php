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
     */
    public function kegiatan()
    {
        //
        $getUserID = Auth::user()->id;
        $kegiatans = Kegiatan::All();
        $kegiatansUnRead = DB::select("SELECT kegiatans.id AS 'id', kerjasamas.nama_kerja_sama, bentuk_kegiatan, keterangan, users.name AS 'name', kegiatans.tanggal_mulai, kegiatans.tanggal_sampai, kegiatans.status FROM kegiatans JOIN kerjasamas ON kerjasama_id = kerjasamas.id JOIN users ON user_id = users.id WHERE user_id = $getUserID AND kegiatans.status = '0' ORDER BY id DESC");
        return view('notification.kegiatan')->with('kegiatansUnRead', $kegiatansUnRead);
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
