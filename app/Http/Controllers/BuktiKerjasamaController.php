<?php

namespace App\Http\Controllers;

use App\Models\BuktiKerjasama;
use App\Models\Kerjasama;
use Illuminate\Http\Request;
use Image;


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
        // return redirect()->route('buktiKerjasamas.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
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
            'Nama_Bukti_Kerjasama' => 'required',
            'Bukti_Kerjasama' => 'required | file |mimes:pdf,jpg,png,docx,doc| max:5000',
            'kerjasama_id' => 'required',
        ]);


        //ambil extensi //png / jpg / gif
        $ext1 = $request->Bukti_Kerjasama->getClientOriginalExtension();

        //ubah nama file file
        $rename_file1 = 'file-'.time().".".$ext1; //contoh file : file-timestamp.jpg

        //upload foler ke dalam folder public
        $request->Bukti_Kerjasama->storeAs('public/kerjasama', $rename_file1); //bisa diletakan difolder lain dengan store ke public/(folderlain)
        

        // 2. simpan file
        $buktiKerjasama = new BuktiKerjasama();
        
        $buktiKerjasama->nama_bukti_kerjasama = $validateData['Nama_Bukti_Kerjasama'];
        $buktiKerjasama->file = $rename_file1;
        $buktiKerjasama->kerjasama_id = $validateData['kerjasama_id'];

        $buktiKerjasama->save(); // simpan ke tabel bukti_kerjasama
        $request->session()->flash('pesan', 'Penambahan data bukti berhasil');
        return redirect()->route('kerjasamas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BuktiKerjasama  $buktiKerjasama
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // dd($id);
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
        $buktiKerjasama->delete();
        return redirect()->route('kerjasamas.index')->with('pesan', "Hapus data bukti $buktiKerjasama->nama_bukti_kerjasama berhasil");
    }
}
