<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mitra;

class MitraController extends Controller
{
    //
    public function index()
    {
        //
        $title = 'Halaman Mitra';
        $mitras = Mitra::all();
        return view('mitra.index')
            ->with('mitras', $mitras)
            ->with('title', $title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('mitra.create');
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
            'nama_mitra' => 'required',
            'tingkat' => 'required'
        ]);

        $mitra = new Mitra();
        $mitra->nama_mitra = $validateData['nama_mitra'];
        $mitra->tingkat = $validateData['tingkat'];
        $mitra->save();

        $request->session()->flash('pesan', 'Penambahan data berhasil');
        return redirect()->route('mitras.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function show(Dosen $dosen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function edit(Dosen $dosen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dosen $dosen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dosen $dosen)
    {
        //
    }
}
