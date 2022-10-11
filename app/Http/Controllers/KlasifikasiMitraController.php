<?php

namespace App\Http\Controllers;

use App\Models\KlasifikasiMitra;
use Illuminate\Http\Request;

class KlasifikasiMitraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $klasifikasiMitras = KlasifikasiMitra::all();
        return view('klasifikasi_mitra.index')->with('klasifikasiMitras', $klasifikasiMitras);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('klasifikasi_mitra.create');
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
        $this->authorize('adminOnly', User::class);
        $validateData = $request->validate([
            'klasifikasi_mitra' => 'required',
            'keterangan' => '',
        ]);

        $klasifikasiMitra = new KlasifikasiMitra();
        $klasifikasiMitra->klasifikasi_mitra = $validateData['klasifikasi_mitra'];
        $klasifikasiMitra->keterangan = $validateData['keterangan'];
        $klasifikasiMitra->save();

        $request->session()->flash('pesan', 'Penambahan data berhasil');
        return redirect()->route('klasifikasi_mitras.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KlasifikasiMitra  $klasifikasiMitra
     * @return \Illuminate\Http\Response
     */
    public function show(KlasifikasiMitra $klasifikasiMitra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KlasifikasiMitra  $klasifikasiMitra
     * @return \Illuminate\Http\Response
     */
    public function edit(KlasifikasiMitra $klasifikasiMitra)
    {
        //
        $this->authorize('adminOnly', User::class);
        return view('klasifikasi_mitra.edit')->with('klasifikasiMitra', $klasifikasiMitra);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KlasifikasiMitra  $klasifikasiMitra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KlasifikasiMitra $klasifikasiMitra)
    {
        //
        $this->authorize('adminOnly', User::class);
        $validateData = $request->validate([
            'klasifikasi_mitra' => 'required',
            'keterangan' => '',
        ]);

        KlasifikasiMitra::where('id', $klasifikasiMitra->id)->update($validateData);

        $request->session()->flash('pesan', 'Perubahan data berhasil');
        return redirect()->route('klasifikasi_mitras.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KlasifikasiMitra  $klasifikasiMitra
     * @return \Illuminate\Http\Response
     */
    public function destroy(KlasifikasiMitra $klasifikasiMitra)
    {
        //
        $this->authorize('adminOnly', User::class);

        $klasifikasiMitra->delete();
        return redirect()->route('klasifikasi_mitras.index')->with('pesan', "Hapus data klasifikasi $klasifikasiMitra->klasifikasi_mitra berhasil");
    }
}
