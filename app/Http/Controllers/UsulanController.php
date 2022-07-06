<?php

namespace App\Http\Controllers;

use App\Models\Usulan;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mitra;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        if(Auth::user()->level == 'A'){
            $usulans = Usulan::All();
        }
        else{
            $getUserId = Auth::user()->id;
            $usulans = DB::select("SELECT usulans.id AS 'id', nama_usulan, bentuk_kerjasama, rencana_kegiatan, tanggal_rencana_kegiatan, nama_mitra, name, nama_unit FROM usulans JOIN users ON usulans.user_id = users.id JOIN mitras ON usulans.mitra_id = mitras.id JOIN units ON usulans.unit_id = units.id WHERE usulans.user_id = $getUserId");
        }
        return view('usulan.index')
        ->with('usulans', $usulans);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::All();
        $mitras = Mitra::All();
        $units  = Unit::All();

        return view('usulan.create')
            ->with('users', $users)
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
            'tanggal_rencana_kegiatan' => 'required',
            'nama_mitra' => 'required',
            'nama_dosen' => 'required',
            'nama_unit' => 'required'
        ]);

        $usulan = new Usulan();

        $usulan->nama_usulan = $validateData['nama_usulan'];
        $usulan->bentuk_kerjasama = $validateData['bentuk_kerjasama'];
        $usulan->rencana_kegiatan = $validateData['rencana_kegiatan'];
        $usulan->tanggal_rencana_kegiatan = $validateData['tanggal_rencana_kegiatan'];
        $usulan->mitra_id = $validateData['nama_mitra'];
        $usulan->user_id = $validateData['nama_dosen'];
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

        if($usulan->user_id != Auth::user()->id){
            $this->authorize('viewAny', User::class);
        }

        return view('usulan.show')->with('usulan', $usulan);
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
        
        if($usulan->user_id != Auth::user()->id){
            $this->authorize('viewAny', User::class);
        }

        $mitras = Mitra::All();
        $units  = Unit::All();

        return view('usulan.edit')
            ->with('mitras', $mitras)
            ->with('units', $units)
            ->with('usulans', $usulan);
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
        $this->validate($request, [
            'nama_usulan' => 'required',
            'bentuk_kerjasama' => 'required',
            'rencana_kegiatan' => 'required',
            'tanggal_rencana_kegiatan' => 'required',
            'nama_mitra' => 'required',
            // 'nama_dosen' => 'required',
            'nama_unit' => 'required'
        ]);

        $usulan = Usulan::findOrFail($usulan->id);

        $usulan->update([
            'nama_usulan' => $request->nama_usulan,
            'bentuk_kerjasama' => $request->bentuk_kerjasama,
            'rencana_kegiatan' => $request->rencana_kegiatan,
            'tanggal_rencana_kegiatan' => $request->tanggal_rencana_kegiatan,
            'mitra_id' => $request->nama_mitra,
            // 'dosen_id' => $request->nama_dosen,
            'unit_id' => $request->nama_unit
        ]);

        $request->session()->flash('pesan', 'Perubahan data berhasil');
        return redirect()->route('usulans.index');
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
        $this->authorize('viewAny', User::class);

        $usulan->delete();
        return redirect()->route('usulans.index')->with('pesan', "Hapus data usulan $usulan->nama_usulan berhasil");
    }
}
