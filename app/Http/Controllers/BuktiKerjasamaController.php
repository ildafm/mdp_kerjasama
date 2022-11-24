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
            'nama_file' => 'required',
            'jenis_file' => 'required',
            'file' => 'required | file |mimes:pdf,jpg,png,docx,doc| max:10240',
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
        
        $buktiKerjasama->nama_file = $validateData['nama_file'];
        $buktiKerjasama->jenis_file = $validateData['jenis_file'];
        $buktiKerjasama->file = $rename_file;
        $buktiKerjasama->kerjasama_id = $validateData['kerjasama_id'];

        $buktiKerjasama->save(); // simpan ke tabel bukti_kerjasama
        $request->session()->flash('pesan', 'Penambahan data file berhasil');
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
        $kerjasama = Kerjasama::findOrFail($buktiKerjasama->kerjasama_id);
        return view('kerjasama.editBukti')
            ->with('buktiKerjasama', $buktiKerjasama)
            ->with('kerjasama', $kerjasama);
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
            'nama_file' => 'required',
            'jenis_file' => 'required',
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
                'nama_file' => $request->nama_file,
                'jenis_file' => $request->jenis_file,
                'file' => $rename_file,
            ]); 
        }
        else{
            $buktiKerjasama->update([
                'nama_file' => $request->nama_file,
                'jenis_file' => $request->jenis_file,
            ]);
        }

        $request->session()->flash('pesan', 'Perubahan data berhasil');
        return redirect()->route('kerjasamas.show', $buktiKerjasama->kerjasama_id);
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
        if($buktiKerjasama->file != null || $buktiKerjasama->file != ''){
            unlink(storage_path('app/public/kerjasama/'.$buktiKerjasama->file));
        }
        
        $buktiKerjasama->delete();
        return redirect()->route('kerjasamas.show', $buktiKerjasama->kerjasama_id)->with('pesan', "Hapus data file $buktiKerjasama->nama_file berhasil");
    }
}
