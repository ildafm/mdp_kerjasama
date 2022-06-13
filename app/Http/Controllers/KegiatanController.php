<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Models\Kerjasama;
use App\Models\Dosen;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kegiatans = Kegiatan::All();
        return view('kegiatan.index')->with('kegiatans', $kegiatans);
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
        $kerjasamas = Kerjasama::All();
        return view('kegiatan.create')
            ->with('dosens', $dosens)
            ->with('kerjasamas', $kerjasamas);
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
            'tanggal_mulai' => 'required',
            'tanggal_sampai' => 'required|date|date_format:Y-m-d|after:tanggal_mulai',
            'bentuk_kegiatan' => 'required',
            'PIC' => 'required',
            'kerjasamas' => 'required',
            'dosens' => 'required',
            'keterangan' => 'required'
        ]);

        $kegiatan = new Kegiatan();

        $kegiatan->tanggal_mulai = $validateData['tanggal_mulai'];
        $kegiatan->tanggal_sampai = $validateData['tanggal_sampai'];
        $kegiatan->bentuk_kegiatan = $validateData['bentuk_kegiatan'];
        $kegiatan->PIC = $validateData['PIC'];
        $kegiatan->kerjasama_id = $validateData['kerjasamas'];
        $kegiatan->dosen_id = $validateData['dosens'];
        $kegiatan->keterangan =$validateData['keterangan'];

        $kegiatan->save();

        $request->session()->flash('pesan', 'Penambahan data berhasil');
        return redirect()->route('kegiatans.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function show(Kegiatan $kegiatan)
    {
        //
        return view('kegiatan.show')->with('kegiatan', $kegiatan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kegiatan $kegiatan)
    {
        //
        $kerjasamas = Kerjasama::All();
        $dosens = Dosen::All();
        return view('kegiatan.edit')
            ->with('kerjasamas', $kerjasamas)
            ->with('kegiatans', $kegiatan)
            ->with('dosens', $dosens);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        //
        $this->validate($request, [
            'tanggal_mulai' => 'required',
            'tanggal_sampai' => 'required|date|date_format:Y-m-d|after:tanggal_mulai',
            'bentuk_kegiatan' => 'required',
            'PIC' => 'required',
            'keterangan' => 'required',
            'kerjasamas' => 'required',
            'dosens' => 'required',
        ]);

        $kegiatan = Kegiatan::findOrFail($kegiatan->id);

        $kegiatan->update([
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_sampai' => $request->tanggal_sampai,
            'bentuk_kegiatan' => $request->bentuk_kegiatan,
            'PIC' => $request->PIC,
            'keterangan' => $request->keterangan,
            'kerjasama_id' => $request->kerjasamas,
            'dosen_id' => $request->dosens
        ]);

        $request->session()->flash('pesan', 'Perubahan data berhasil');
        return redirect()->route('kegiatans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kegiatan $kegiatan)
    {
        //
        $kegiatan->delete();
        return redirect()->route('kegiatans.index')->with('pesan', "Hapus data kegiatan dengan id : $kegiatan->id berhasil");
    }
}
