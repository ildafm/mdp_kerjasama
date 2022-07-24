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
        $usulans = Usulan::All();

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
        $this->authorize('viewAny', User::class);

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
        $this->authorize('viewAny', User::class);
        
        $validateData = $request->validate([
            'usulan' => 'required',
            'bentuk_kerjasama' => 'required',
            'kontak_kerjasama' => 'required|max:13|min:11',
            'rencana_kegiatan' => 'required',
            'nama_mitra' => 'required',
            'nama_pengusul' => 'required',
            'nama_unit' => 'required',
            'type' => 'required',
        ]);

        $usulan = new Usulan();
        $usulan->usulan = $validateData['usulan'];
        $usulan->bentuk_kerjasama = $validateData['bentuk_kerjasama'];
        $usulan->kontak_kerjasama = $validateData['kontak_kerjasama'];
        $usulan->rencana_kegiatan = $validateData['rencana_kegiatan'];
        $usulan->type = $validateData['type'];
        $usulan->mitra_id = $validateData['nama_mitra'];
        $usulan->user_id = $validateData['nama_pengusul'];
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
        $getKerjasama = DB::select("SELECT kerjasamas.id as 'id_kerjasama', kerjasamas.nama_kerja_sama, kerjasamas.no_mou, kerjasamas.tanggal_mulai, kerjasamas.tanggal_sampai, kategoris.nama_kategori, statuses.nama_status, usulans.usulan, usulans.hasil_penjajakan
        FROM kerjasamas
        JOIN kategoris ON kerjasamas.kategori_id = kategoris.id
        JOIN statuses ON kerjasamas.status_id = statuses.id
        JOIN usulans ON kerjasamas.usulan_id = usulans.id
        WHERE kerjasamas.usulan_id = $usulan->id
        ORDER BY kerjasamas.id");

        return view('usulan.show')
            ->with('usulan', $usulan)
            ->with('getKerjasama', $getKerjasama);;
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
        
        $this->authorize('viewAny', User::class);

        $mitras = Mitra::All();
        $units  = Unit::All();
        $users = User::All();

        return view('usulan.edit')
            ->with('mitras', $mitras)
            ->with('units', $units)
            ->with('usulans', $usulan)
            ->with('users', $users);
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
        $this->authorize('viewAny', User::class);

        $this->validate($request, [
            'usulan' => 'required',
            'bentuk_kerjasama' => 'required',
            'kontak_kerjasama' => 'required|max:13|min:11',
            'rencana_kegiatan' => 'required',
            'nama_mitra' => 'required',
            'nama_pengusul' => 'required',
            'nama_unit' => 'required',
            'hasil_penjajakan' => 'required',
        ]);

        if ($request->hasil_penjajakan != 'B') {
            $this->validate($request, [
                'keterangan_hasil_penajajakan' => 'required',
            ]);
        }
        
        $usulan = Usulan::findOrFail($usulan->id);

        $usulan->update([
            'usulan' => $request->usulan,
            'bentuk_kerjasama' => $request->bentuk_kerjasama,
            'kontak_kerjasama' => $request->kontak_kerjasama,
            'rencana_kegiatan' => $request->rencana_kegiatan,
            'mitra_id' => $request->nama_mitra,
            'user_id' => $request->nama_pengusul,
            'unit_id' => $request->nama_unit,
            'hasil_penjajakan' => $request->hasil_penjajakan,
            'keterangan' => $request->keterangan_hasil_penajajakan,
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
