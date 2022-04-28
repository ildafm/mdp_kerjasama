<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Kerjasama;
use App\Models\Status;
use App\Models\Mitra;
use Illuminate\Http\Request;

class KerjasamaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $kerjasamas = Kerjasama::has('mitra')->get();
        $kerjasamas = Kerjasama::All();
        // dump($kerjasamas);
        return view('kerjasama.index')->with('kerjasamas', $kerjasamas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // return view('kerjasama.create');
        $mitras = Mitra::All();
        $kategoris = Kategori::All();
        $statuses = Status::All();
        // dump($mitras);
        return view('kerjasama.create')
            ->with('mitras', $mitras)
            ->with('kategoris', $kategoris)
            ->with('statuses', $statuses);
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
            'nama_kerja_sama' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_sampai' => 'required|date|date_format:Y-m-d|after:tanggal_mulai',
            'nama_mitra' => 'required',
            'nama_kategori' => 'required',
            'nama_status' => 'required'
        ]);

        $kerjasama = new Kerjasama();
        $kerjasama->nama_kerja_sama = $validateData['nama_kerja_sama'];
        $kerjasama->tanggal_mulai = $validateData['tanggal_mulai'];
        $kerjasama->tanggal_sampai = $validateData['tanggal_sampai'];
        $kerjasama->mitra_id = $validateData['nama_mitra'];
        $kerjasama->kategori_id = $validateData['nama_kategori'];
        $kerjasama->status_id = $validateData['nama_status'];

        $kerjasama->save();

        $request->session()->flash('pesan', 'Penambahan data berhasil');
        return redirect()->route('kerjasamas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kerjasama  $kerjasama
     * @return \Illuminate\Http\Response
     */
    public function show(Kerjasama $kerjasama)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kerjasama  $kerjasama
     * @return \Illuminate\Http\Response
     */
    public function edit(Kerjasama $kerjasama)
    {
        //
        $mitras = Mitra::All();
        $kategoris = Kategori::All();
        $statuses = Status::All();
        return view('kerjasama.edit')
            ->with('kerjasama', $kerjasama)
            ->with('mitras', $mitras)
            ->with('kategoris', $kategoris)
            ->with('statuses', $statuses);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kerjasama  $kerjasama
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kerjasama $kerjasama)
    {
        //
        $this->validate($request, [
            'nama_kerja_sama' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_sampai' => 'required|date|date_format:Y-m-d|after:tanggal_mulai',
            'nama_mitra' => 'required',
            'nama_kategori' => 'required',
            'nama_status' => 'required'
        ]);

        $kerjasama = Kerjasama::findOrFail($kerjasama->id);

        $kerjasama->update([
            'nama_kerja_sama' => $request->nama_kerja_sama,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_sampai' => $request->tanggal_sampai,
            'mitra_id' => $request->nama_mitra,
            'kategori_id' => $request->nama_kategori,
            'status_id' => $request->nama_status
        ]);

        $request->session()->flash('pesan', 'Perubahan data berhasil');
        return redirect()->route('kerjasamas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kerjasama  $kerjasama
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kerjasama $kerjasama)
    {
        //
        $kerjasama->delete();
        return redirect()->route('kerjasamas.index')->with('pesan', "Hapus data $kerjasama->nama_kerja_sama berhasil");
    }
}
