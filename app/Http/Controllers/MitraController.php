<?php

namespace App\Http\Controllers;

use App\Models\KlasifikasiMitra;
use Illuminate\Http\Request;
use App\Models\Mitra;
use App\Models\Negara;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Support\Facades\DB;

class MitraController extends Controller
{
    //
    public function index()
    {
        //
        $mitras = Mitra::all();
        $mitraWithQuerrys = DB::select("SELECT mitras.id, mitras.nama_mitra, mitras.tingkat, klasifikasi_mitras.klasifikasi_mitra, negaras.nama_negara 
        FROM mitras
        JOIN klasifikasi_mitras ON klasifikasi_id = klasifikasi_mitras.id
        JOIN negaras ON negara_id = negaras.id");

        return view('mitra.index')
            ->with('mitras', $mitras)
            ->with('mitraWithQuerrys', $mitraWithQuerrys);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->authorize('viewAny', User::class);
        
        $klasifikasiMitras = KlasifikasiMitra::all();
        $negaras = Negara::all();
        return view('mitra.create')
            ->with('klasifikasiMitras', $klasifikasiMitras)
            ->with('negaras', $negaras);
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
        $this->authorize('viewAny', User::class);
        $validateData = $request->validate([
            'nama_mitra' => 'required',
            'tingkat' => 'required',
            'klasifikasi_mitra' => 'required',
            'nama_negara' => 'required',
        ]);

        $mitra = new Mitra();
        $mitra->nama_mitra = $validateData['nama_mitra'];
        $mitra->tingkat = $validateData['tingkat'];
        $mitra->klasifikasi_id = $validateData['klasifikasi_mitra'];
        $mitra->negara_id = $validateData['nama_negara'];
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
        // return view('mitra.show')->with('mitra', $mitra);
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
        $this->authorize('viewAny', User::class);

        $klasifikasiMitras = KlasifikasiMitra::all();
        $negaras = Negara::all();
        return view('mitra.edit')
            ->with('mitra', $mitra)
            ->with('klasifikasiMitras', $klasifikasiMitras)
            ->with('negaras', $negaras);
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
        $this->authorize('viewAny', User::class);
        $validateData = $request->validate([
            'nama_mitra' => 'required',
            'tingkat' => 'required',
            'klasifikasi_mitra' => 'required',
            'nama_negara' => 'required',
        ]);

        $mitra->update([
            'nama_mitra' => $request->nama_mitra,
            'tingkat' => $request->tingkat,
            'klasifikasi_id' => $request->klasifikasi_mitra,
            'negara_id' => $request->nama_negara,
        ]);

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
        $this->authorize('adminOnly', User::class);

        $mitra->delete();
        return redirect()->route('mitras.index')->with('pesan', "Hapus data $mitra->nama_mitra berhasil");
        // dump($mitra->id);

    }

}
