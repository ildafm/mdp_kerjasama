<?php

namespace App\Http\Controllers;

use App\Models\BentukKegiatan;
use App\Models\User;
use Illuminate\Http\Request;

class BentukKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->authorize('adminOnly', User::class);

        $bentukKegiatans = BentukKegiatan::All();
        return view("bentuk_kegiatan.index")->with('bentukKegiatans', $bentukKegiatans);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->authorize('adminOnly', User::class);

        return view("bentuk_kegiatan.create");
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
        $this->authorize('adminOnly', User::class);

        $validateData = $request->validate([
            'bentuk_kegiatan' => 'required',
        ]);

        $bentukKegiatan = new BentukKegiatan();
        $bentukKegiatan->bentuk = $validateData['bentuk_kegiatan'];
        $bentukKegiatan->save();

        $request->session()->flash('pesan', 'Penambahan data berhasil');
        return redirect()->route('bentuk_kegiatans.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BentukKegiatan  $bentukKegiatan
     * @return \Illuminate\Http\Response
     */
    public function show(BentukKegiatan $bentukKegiatan)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BentukKegiatan  $bentukKegiatan
     * @return \Illuminate\Http\Response
     */
    public function edit(BentukKegiatan $bentukKegiatan)
    {
        //
        $this->authorize('adminOnly', User::class);

        return view("bentuk_kegiatan.edit")->with('bentukKegiatan', $bentukKegiatan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BentukKegiatan  $bentukKegiatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BentukKegiatan $bentukKegiatan)
    {
        //
        $this->authorize('adminOnly', User::class);

        $this->validate($request, [
            'bentuk_kegiatan' => 'required',
        ]);

        $bentukKegiatan = BentukKegiatan::findOrFail($bentukKegiatan->id);

        $bentukKegiatan->update([
            'bentuk' => $request->bentuk_kegiatan,
        ]);

        $request->session()->flash('pesan', 'Perubahan data berhasil');
        return redirect()->route('bentuk_kegiatans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BentukKegiatan  $bentukKegiatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(BentukKegiatan $bentukKegiatan)
    {
        //
        $this->authorize('adminOnly', User::class);

        try {
            $bentukKegiatan->delete();
            return redirect()->back()->with('pesan', "Hapus data $bentukKegiatan->bentuk berhasil");
        } catch (\Throwable $th) {
            return redirect()->back()->with('pesan_error', "Gagal menghapus data $bentukKegiatan->bentuk");
        }
    }
}
