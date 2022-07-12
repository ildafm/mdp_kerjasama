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
            'nama_bukti_kerjasama' => 'required',
            'file' => 'required | file |mimes:pdf,jpg,png,docx,doc| max:5000',
            'kerjasama_id' => 'required',
        ]);


        //ambil extensi //png / jpg / gif
        $ext = $request->file->getClientOriginalExtension();

        //ubah nama file file
        $rename_file = 'file-'.time().".".$ext; //contoh file : file-timestamp.jpg

        //upload foler ke dalam folder public
        $request->file->storeAs('public/kerjasama', $rename_file); //bisa diletakan difolder lain dengan store ke public/(folderlain)
        

        // 2. simpan file
        $buktiKerjasama = new BuktiKerjasama();
        
        $buktiKerjasama->nama_bukti_kerjasama = $validateData['nama_bukti_kerjasama'];
        $buktiKerjasama->file = $rename_file;
        $buktiKerjasama->kerjasama_id = $validateData['kerjasama_id'];

        $buktiKerjasama->save(); // simpan ke tabel bukti_kerjasama
        $request->session()->flash('pesan', 'Penambahan data bukti berhasil');
        return redirect()->route('kerjasamas.show', $buktiKerjasama->kerjasama_id);
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
        return view('kerjasama.editBukti')->with('buktiKerjasama', $buktiKerjasama);
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
        $this->validate($request, [
            'nama_bukti_kerjasama' => 'required',
            'file' => 'file |mimes:pdf,jpg,png,docx,doc| max:5120',
        ]);

        $buktiKerjasama = BuktiKerjasama::findOrFail($buktiKerjasama->id);

        if($request->file != ""){

            if($buktiKerjasama->file != null || $buktiKerjasama->file != ''){
                unlink(storage_path('app/public/kerjasama/'.$buktiKerjasama->file));
            }

            //ambil extensi //png / jpg / gif
            $ext = $request->file->getClientOriginalExtension();

            //ubah nama file file
            $rename_file = 'file-'.time().".".$ext; //contoh file : file-timestamp.jpg

            //upload foler ke dalam folder public
            $request->file->storeAs('public/kerjasama', $rename_file); //bisa diletakan difolder lain dengan store ke public/(folderlain)

            $buktiKerjasama->update([
                'nama_bukti_kerjasama' => $request->nama_bukti_kerjasama,
                'file' => $rename_file,
            ]); 
        }
        else{
            $buktiKerjasama->update([
                'nama_bukti_kerjasama' => $request->nama_bukti_kerjasama,
            ]);
        }

        $request->session()->flash('pesan', 'Perubahan data berhasil');
        return redirect()->route('kerjasamas.index');
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
        return redirect()->route('kerjasamas.show', $buktiKerjasama->kerjasama_id)->with('pesan', "Hapus data bukti $buktiKerjasama->nama_bukti_kerjasama berhasil");
    }
}
