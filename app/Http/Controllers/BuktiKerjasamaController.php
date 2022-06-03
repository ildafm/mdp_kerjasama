<?php

namespace App\Http\Controllers;

use App\Models\BuktiKerjasama;
use Illuminate\Http\Request;

class BuktiKerjasamaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $buktiKerjasama = BuktiKerjasama::all();
        return view('buktiKerjasama.create')->with('buktiKerjasama', $buktiKerjasama);
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
            'foto' => 'required | file | image | max:50000'
        ]);

        //ambil extensi //png / jpg / gif
        $ext = $request->foto->getClientOriginalExtension();
        //ubah nama file foto
        $rename_file = 'DocumentBuktiKerjasama-'.time().".".$ext; //contoh file : foto-waktu.jpg
        //upload foler ke dalam folder public
        $request->foto->storeAs('public/kerjasama', $rename_file); //bisa diletakan difolder lain dengan store ke public/(folderlain)
        

        // 2. simpan foto
        $buktiKerjasama = new BuktiKerjasama();
        $buktiKerjasama->nama_bukti_kerjasama = $rename_file;

        $buktiKerjasama->save(); // simpan ke tabel bukti_kerjasama
        return redirect()->route('kerjasama.index'); // redirect ke kerjasama.index
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BuktiKerjasama  $buktiKerjasama
     * @return \Illuminate\Http\Response
     */
    public function show(BuktiKerjasama $buktiKerjasama)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BuktiKerjasama  $buktiKerjasama
     * @return \Illuminate\Http\Response
     */
    public function edit(BuktiKerjasama $buktiKerjasama)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BuktiKerjasama  $buktiKerjasama
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BuktiKerjasama $buktiKerjasama)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BuktiKerjasama  $buktiKerjasama
     * @return \Illuminate\Http\Response
     */
    public function destroy(BuktiKerjasama $buktiKerjasama)
    {
        //
    }
}
