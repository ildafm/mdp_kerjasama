<?php

namespace App\Http\Controllers;

use App\Models\BuktiKerjasama;
use App\Models\Kerjasama;
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
        $kerjasama = Kerjasama::all();
        return view('buktiKerjasama.create')
            ->with('buktiKerjasama', $buktiKerjasama)
            ->with('kerjasama', $kerjasama);
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
            'nama_bukti_kerjasama1' => 'required',
            'foto1' => 'required | file | image | max:50000',

            'nama_bukti_kerjasama2',
            'foto2' => 'file | image | max:50000',
            'nama_bukti_kerjasama3',
            'foto3' => 'file | image | max:50000',

            'kerjasama_id' => 'required',
        ]);

        //ambil extensi //png / jpg / gif
        $ext1 = $request->foto1->getClientOriginalExtension();
        // $ext2 = $request->foto2->getClientOriginalExtension();
        // $ext3 = $request->foto3->getClientOriginalExtension();

        //ubah nama file foto
        $rename_file1 = 'DocumentBuktiKerjasama-'.time().".".$ext1; //contoh file : foto-waktu.jpg
        // $rename_file2 = 'DocumentBuktiKerjasama-'.time().".".$ext2;
        // $rename_file3 = 'DocumentBuktiKerjasama-'.time().".".$ext3;

        //upload foler ke dalam folder public
        $request->foto1->storeAs('public/kerjasama', $rename_file1); //bisa diletakan difolder lain dengan store ke public/(folderlain)
        // $request->foto2->storeAs('public/kerjasama', $rename_file2);
        // $request->foto3->storeAs('public/kerjasama', $rename_file3);
        

        // 2. simpan foto
        $buktiKerjasama = new BuktiKerjasama();
        
        $buktiKerjasama->nama_bukti_kerjasama = $validateData['nama_bukti_kerjasama1'];
        $buktiKerjasama->foto = $rename_file1;

        // $buktiKerjasama->nama_bukti_kerjasama = $validateData['nama_bukti_kerjasama2'];
        // $buktiKerjasama->foto = $rename_file2;
        // $buktiKerjasama->nama_bukti_kerjasama = $validateData['nama_bukti_kerjasama3'];
        // $buktiKerjasama->foto = $rename_file3;

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
