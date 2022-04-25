<?php

namespace App\Http\Controllers;

use App\Models\Usulan;
use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\Mitra;
use App\Models\Unit;

class UsulanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $usulans = Usulan::All();
        return view('usulan.index')->with('usulans', $usulans);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $dosens = Dosen::All();
        $mitras = Mitra::All();
        $units  = Unit::All();

        return view('usulan.create')
            ->with('dosens', $dosens)
            ->with('mitras', $mitras)
            ->with('units', $units);
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
        $validateData = $request->validate([
            'nama_usulan' => 'required',
            'bentuk_kerjasama' => 'required',
            'rencana_kegiatan' => 'required',
            'tanggal_kegiatan' => 'required',
            'nama_mitra' => 'required',
            'nama_dosen' => 'required',
            'nama_unit' => 'required'
        ]);

        $usulan = new Usulan();

        $usulan->nama_usulan = $validateData['nama_usulan'];
        $usulan->bentuk_kerjasama = $validateData['bentuk_kerjasama'];
        $usulan->rencana_kegiatan = $validateData['rencana_kegiatan'];
        $usulan->tanggal_rencana_kegiatan = $validateData['tanggal_kegiatan'];
        $usulan->mitra_id = $validateData['nama_mitra'];
        $usulan->dosen_id = $validateData['nama_dosen'];
        $usulan->unit_id =$validateData['nama_unit'];

        $usulan->save();

        $request->session()->flash('pesan', 'Penambahan data berhasil');
        return redirect()->route('usulans.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usulan  $usulan
     * @return \Illuminate\Http\Response
     */
    public function show(Usulan $usulan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usulan  $usulan
     * @return \Illuminate\Http\Response
     */
    public function edit(Usulan $usulan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usulan  $usulan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usulan $usulan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usulan  $usulan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usulan $usulan)
    {
        //
    }
}
