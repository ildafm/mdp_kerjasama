<?php

namespace App\Http\Controllers;

use App\Models\Negara;
use Illuminate\Http\Request;

class NegaraController extends Controller
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

        $negaras = Negara::all();
        return view("negara.index")->with('negaras', $negaras);
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
        return view("negara.create");
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
            'nama_negara' => 'required',
        ]);

        $negara = new Negara();
        $negara->nama_negara = $validateData['nama_negara'];
        $negara->save();

        $request->session()->flash('pesan', 'Penambahan data berhasil');
        return redirect()->route('negaras.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Negara  $negara
     * @return \Illuminate\Http\Response
     */
    public function show(Negara $negara)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Negara  $negara
     * @return \Illuminate\Http\Response
     */
    public function edit(Negara $negara)
    {
        //
        $this->authorize('adminOnly', User::class);
        return view('negara.edit')->with('negara', $negara);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Negara  $negara
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Negara $negara)
    {
        //
        $this->authorize('adminOnly', User::class);
        $validateData = $request->validate([
            'nama_negara' => 'required',
        ]);

        Negara::where('id', $negara->id)->update($validateData);

        $request->session()->flash('pesan', 'Perubahan data berhasil');
        return redirect()->route('negaras.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Negara  $negara
     * @return \Illuminate\Http\Response
     */
    public function destroy(Negara $negara)
    {
        //
        $this->authorize('adminOnly', User::class);

        $negara->delete();
        return redirect()->route('negaras.index')->with('pesan', "Hapus data negara $negara->nama_negara berhasil");
    }
}
