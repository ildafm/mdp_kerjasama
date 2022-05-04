<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $dosens = Dosen::All();
        return view('dosen.index')->with('dosens', $dosens);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dosen.create');
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
            'kode_dosen' => 'required | max:6 | unique:dosens',
            'nama_dosen' => 'required'
        ]);

        $dosen = new Dosen();
        $dosen->kode_dosen = $validateData['kode_dosen'];
        $dosen->nama_dosen = $validateData['nama_dosen'];
        $dosen->save();

        $request->session()->flash('pesan', 'Penambahan data berhasil');
        return redirect()->route('dosens.index');
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
        return view('dosen.edit')->with('dosen', $dosen);
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
        $validateData = $request->validate([
            'kode_dosen' => 'required | max:6 | unique:dosens',
            'nama_dosen' => 'required'
        ]);

        $dosen = Dosen::findOrFail($dosen->id);
        $dosen->update([
            'kode_dosen' => $request->kode_dosen,
            'nama_dosen' => $request->nama_dosen,
        ]);

        $request->session()->flash('pesan', 'Perubahan data berhasil');
        return redirect()->route('dosens.index');
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
        $dosen->delete();
        return redirect()->route('dosens.index')->with('pesan', "Hapus data $dosen->nama_dosen berhasil");
    }
}
