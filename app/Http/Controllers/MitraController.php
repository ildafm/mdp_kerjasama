<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mitra;
use Illuminate\Contracts\Support\ValidatedData;

class MitraController extends Controller
{
    //
    public function index()
    {
        //
        $mitras = Mitra::all();
        return view('mitra.index')->with('mitras', $mitras);
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
     * @param  \App\Models\Mitra  $mitra
     * @return \Illuminate\Http\Response
     */
    public function show(Mitra $mitra)
    {
        //
        return view('mitra.show')->with('mitra', $mitra);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mitra  $mitra
     * @return \Illuminate\Http\Response
     */
    public function edit(Mitra $mitra)
    {
        //
        // dump($mitra);

        return view('mitra.edit')->with('mitra', $mitra);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mitra  $mitra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mitra $mitra)
    {
        //

        $validateData = $request->validate([
            'nama_mitra' => 'required',
            'tingkat' => 'required'
        ]);

        Mitra::where('id', $mitra->id)->update($validateData);

        $request->session()->flash('pesan', 'Perubahan data berhasil');
        return redirect()->route('mitras.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mitra  $mitra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mitra $mitra)
    {
        //
        $this->authorize('viewAny', User::class);

        $mitra->delete();
        return redirect()->route('mitras.index')->with('pesan', "Hapus data $mitra->nama_mitra berhasil");
        // dump($mitra->id);

    }

}
