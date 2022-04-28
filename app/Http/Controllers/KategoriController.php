<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kategoris = Kategori::All();
        return view('kategori.index')->with('kategoris', $kategoris);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('kategori.create');
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
            'nama_kategori' => 'required'
        ]);

        $kategori = new Kategori();
        $kategori->nama_kategori = $validateData['nama_kategori'];
        $kategori->save();

        $request->session()->flash('pesan', 'Penambahan data berhasil');
        return redirect()->route('kategoris.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        //
        return view('kategori.edit')->with('kategori', $kategori);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori)
    {
        //
        $this->validate($request, [
            'nama_kategori' => 'required'
        ]);

        $kategori = Kategori::findOrFail($kategori->id);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        $request->session()->flash('pesan', 'Perubahan data berhasil');
        return redirect()->route('kategoris.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        //
        $kategori->delete();
        return redirect()->route('kategoris.index')->with('pesan', "Hapus data $kategori->nama_kategori berhasil");
    }
}
