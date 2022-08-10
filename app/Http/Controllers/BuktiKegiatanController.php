<?php

namespace App\Http\Controllers;

use App\Models\BuktiKegiatan;
use App\Models\BuktiKegiatanUnit;
use App\Models\Kegiatan;
use App\Models\Unit;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        if (Auth::user()->level == 'D') {
            $this->authorize('theUserOnly', User::class);
        }
        
        // 1. validasi input data kosong
        $validateData = $request->validate([
            'nama_bukti_kegiatan' => 'required',
            'file' => 'required | file |mimes:pdf,jpg,png,docx,doc| max:5120',
            'apt' => '',
            'aps' => '',
            'lamemba' => '',
            'nama_unit' => 'required',
            'bidang' => 'required',
            'kegiatan_id' => 'required',
        ]);

        //ambil extensi //png / jpg / gif
        $ext = $request->file->getClientOriginalExtension();

        //ubah nama file file
        $rename_file = 'file-'.time().".".$ext; //contoh file : file-timestamp.jpg

        //upload foler ke dalam folder public
        $request->file->storeAs('public/kegiatan', $rename_file); //bisa diletakan difolder lain dengan store ke public/(folderlain)
        

        $buktiKegiatan = new BuktiKegiatan();

        // 2. simpan file
        $buktiKegiatan->nama_bukti_kegiatan = $validateData['nama_bukti_kegiatan'];
        $buktiKegiatan->file = $rename_file;

        if(!empty($validateData['apt'])){
            $buktiKegiatan->ceklist_apt = 'Y';
        }

        if(!empty($validateData['aps'])){
            $buktiKegiatan->ceklist_aps = 'Y';
        }

        if(!empty($validateData['lamemba'])){
            $buktiKegiatan->ceklist_lamemba = 'Y';
        }

        $buktiKegiatan->bidang = $validateData['bidang'];
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
        return redirect()->route('kegiatans.show', $buktiKegiatan->kegiatans_id);
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

        $getUserID = DB::select("SELECT kegiatans.id AS 'id_kegiatan', kegiatans.user_id AS 'user_id', bukti_kegiatans.id AS 'id_bukti_kegiatan', kegiatans_id AS 'id_kegiatan_di_bukti_kegiatan'
        FROM bukti_kegiatans
        JOIN kegiatans ON kegiatans.id = bukti_kegiatans.kegiatans_id
        WHERE bukti_kegiatans.id = $buktiKegiatan->id");

        if(Auth::user()->id != $getUserID[0]->user_id){
            $this->authorize('viewAny', User::class);
        }
        
        $units = Unit::All();
        
        $buktiKegiatanUnits = DB::select("SELECT bukti_kegiatans.id AS 'id_bukti_kegiatan', nama_bukti_kegiatan, bukti_kegiatan_units.id AS 'id_bukti_kegiatan_unit', bukti_kegiatan_units.bukti_kegiatans_id, bukti_kegiatan_units.units_id AS 'units_id' FROM bukti_kegiatans JOIN bukti_kegiatan_units ON bukti_kegiatan_units.bukti_kegiatans_id = bukti_kegiatans.id WHERE bukti_kegiatans.id = $buktiKegiatan->id");

        return view('kegiatan.editBukti')
        ->with('units', $units)
        ->with('buktiKegiatanUnits', $buktiKegiatanUnits[0])
        ->with('buktiKegiatan', $buktiKegiatan);
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
        $this->validate($request, [
            'nama_bukti_kegiatan' => 'required',
            'file' => 'file |mimes:pdf,jpg,png,docx,doc| max:5120',
            'apt' => '',
            'aps' => '',
            'lamemba' => '',
            'nama_unit' => 'required',
            'bidang' => 'required',
        ]);

        $buktiKegiatan = BuktiKegiatan::findOrFail($buktiKegiatan->id);

        // checkbox apt
        if(!empty($request->apt)){
            $option_apt = 'Y';
        }
        else{
            $option_apt = 'T';
        }

        // checkbox aps
        if(!empty($request->aps)){
            $option_aps = 'Y';
        }
        else{
            $option_aps = 'T';
        }

        // checkbox lamemba
        if(!empty($request->lamemba)){
            $option_lamemba = 'Y';
        }
        else{
            $option_lamemba = 'T';
        }

        if($request->file != ""){

            if($buktiKegiatan->file != null || $buktiKegiatan->file != ''){
                unlink(storage_path('app/public/kegiatan/'.$buktiKegiatan->file));
            }

            //ambil extensi //png / jpg / gif
            $ext = $request->file->getClientOriginalExtension();

            //ubah nama file file
            $rename_file = 'file-'.time().".".$ext; //contoh file : file-timestamp.jpg

            //upload foler ke dalam folder public
            $request->file->storeAs('public/kegiatan', $rename_file); //bisa diletakan difolder lain dengan store ke public/(folderlain)

            $buktiKegiatan->update([
                'nama_bukti_kegiatan' => $request->nama_bukti_kegiatan,
                'ceklist_apt' => $option_apt,
                'ceklist_aps' => $option_aps,
                'ceklist_lamemba' => $option_lamemba,
                'bidang' => $request->bidang,
                'file' => $rename_file,
            ]); 
        }
        else{
            $buktiKegiatan->update([
                'nama_bukti_kegiatan' => $request->nama_bukti_kegiatan,
                'ceklist_apt' => $option_apt,
                'ceklist_aps' => $option_aps,
                'ceklist_lamemba' => $option_lamemba,
                'bidang' => $request->bidang,
            ]);
        }

        DB::update("UPDATE bukti_kegiatan_units JOIN bukti_kegiatans ON bukti_kegiatan_units.bukti_kegiatans_id = bukti_kegiatans.id SET units_id = $request->nama_unit WHERE bukti_kegiatans_id = $buktiKegiatan->id");

        $request->session()->flash('pesan', 'Perubahan data berhasil');
        return redirect()->route('kegiatans.show', $buktiKegiatan->kegiatans_id);
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
        
        if($buktiKegiatan->file != null || $buktiKegiatan->file != ''){
            unlink(storage_path('app/public/kegiatan/'.$buktiKegiatan->file));
        }

        $buktiKegiatan->delete();
        return redirect()->route('kegiatans.show', $buktiKegiatan->kegiatans_id)->with('pesan', "Hapus data bukti $buktiKegiatan->nama_bukti_kerjasama berhasil");
    }
}
