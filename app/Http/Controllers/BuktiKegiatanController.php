<?php

namespace App\Http\Controllers;

use App\Models\BuktiKegiatan;
use App\Models\BuktiKegiatanUnit;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class BuktiKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // 1. validasi input data kosong
        $validateData = $request->validate([
            'nama_bukti_kegiatan' => 'required',
            'bukti_kegiatan' => 'required | file |mimes:pdf,jpg,png,docx,doc| max:5000',
            'apt' => '',
            'aps' => '',
            'lamemba' => '',
            'nama_unit' => 'required',
            'kegiatan_id' => 'required',
        ]);

        //ambil extensi //png / jpg / gif
        $ext1 = $request->bukti_kegiatan->getClientOriginalExtension();

        //ubah nama file file
        $rename_file1 = 'file-'.time().".".$ext1; //contoh file : file-timestamp.jpg

        //upload foler ke dalam folder public
        $request->bukti_kegiatan->storeAs('public/kegiatan', $rename_file1); //bisa diletakan difolder lain dengan store ke public/(folderlain)
        

        // 2. simpan file
        $buktiKegiatan = new BuktiKegiatan();
        
        $buktiKegiatan->nama_bukti_kegiatan = $validateData['nama_bukti_kegiatan'];
        $buktiKegiatan->file = $rename_file1;

        if(!empty($validateData['apt'])){
            $buktiKegiatan->ceklist_apt = 'Y';
        }

        if(!empty($validateData['aps'])){
            $buktiKegiatan->ceklist_aps = 'Y';
        }

        if(!empty($validateData['lamemba'])){
            $buktiKegiatan->ceklist_lamemba = 'Y';
        }

        $buktiKegiatan->kegiatans_id = $validateData['kegiatan_id'];

        $buktiKegiatan->save(); // simpan ke tabel bukti_kegiatan

        // get id buktiKegiatan
        $buktiKegiatanID = $buktiKegiatan->id;

        // Input tabel bukti_kegiatan_unit
        $buktiKegiatanUnit = new BuktiKegiatanUnit();
        $buktiKegiatanUnit->bukti_kegiatans_id = $buktiKegiatanID;
        $buktiKegiatanUnit->units_id = $validateData['nama_unit'];
        $buktiKegiatanUnit->save();

        $request->session()->flash('pesan', 'Penambahan data bukti berhasil');
        return redirect()->route('kegiatans.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BuktiKegiatan  $buktiKegiatan
     * @return \Illuminate\Http\Response
     */
    public function show(BuktiKegiatan $buktiKegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BuktiKegiatan  $buktiKegiatan
     * @return \Illuminate\Http\Response
     */
    public function edit(BuktiKegiatan $buktiKegiatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BuktiKegiatan  $buktiKegiatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BuktiKegiatan $buktiKegiatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BuktiKegiatan  $buktiKegiatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(BuktiKegiatan $buktiKegiatan)
    {
        //
        $buktiKegiatanUnit = BuktiKegiatanUnit::where('bukti_kegiatans_id', $buktiKegiatan->id);
        $buktiKegiatanUnit->delete();

        $buktiKegiatan->delete();
        return redirect()->route('kerjasamas.index')->with('pesan', "Hapus data bukti $buktiKegiatan->nama_bukti_kerjasama berhasil");
    }
}
