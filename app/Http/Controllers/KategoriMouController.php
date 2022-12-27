<?php

namespace App\Http\Controllers;

use App\Models\KategoriMou;
use Illuminate\Http\Request;

class KategoriMouController extends Controller
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

        $kategoriMous = KategoriMou::all();

        return view("kategori_mou.index")
            ->with('kategoriMous', $kategoriMous);
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
        return view('kategori_mou.create');
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
            'nama_kategori' => 'required'
        ]);

        $kategori = new KategoriMou();
        $kategori->nama_kategori = $validateData['nama_kategori'];
        $kategori->save();

        $request->session()->flash('pesan', 'Penambahan data berhasil');
        return redirect()->route('kategori_mous.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KategoriMou  $kategoriMou
     * @return \Illuminate\Http\Response
     */
    public function show(KategoriMou $kategoriMou)
    {
        //
        $this->authorize('adminOnly', User::class);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KategoriMou  $kategoriMou
     * @return \Illuminate\Http\Response
     */
    public function edit(KategoriMou $kategoriMou)
    {
        //
        $this->authorize('adminOnly', User::class);
        return view('kategori_mou.edit')->with('kategoriMou', $kategoriMou);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KategoriMou  $kategoriMou
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KategoriMou $kategoriMou)
    {
        //
        $this->authorize('adminOnly', User::class);
        $this->validate($request, [
            'nama_kategori' => 'required'
        ]);

        $kategori = KategoriMou::findOrFail($kategoriMou->id);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        $request->session()->flash('pesan', 'Perubahan data berhasil');
        return redirect()->route('kategori_mous.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KategoriMou  $kategoriMou
     * @return \Illuminate\Http\Response
     */
    public function destroy(KategoriMou $kategoriMou)
    {
        //
        $this->authorize('adminOnly', User::class);

        $kategoriMou->delete();
        return redirect()->route('kategori_mous.index')->with('pesan', "Hapus data $kategoriMou->nama_kategori berhasil");
    }
}
