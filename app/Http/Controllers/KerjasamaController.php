<?php

namespace App\Http\Controllers;

use App\Models\BuktiKerjasama;
use App\Models\Kategori;
use App\Models\Kegiatan;
use App\Models\Kerjasama;
use App\Models\Status;
use App\Models\User;
use App\Models\Usulan;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class KerjasamaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kerjasamas = Kerjasama::All();
        return view('kerjasama.index')->with('kerjasamas', $kerjasamas);
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
        $kategoris = Kategori::All();
        $statuses = Status::All();
        $kerjasamas = Kerjasama::All();
        $usulans = Usulan::All()->where('hasil_penjajakan', 'L');

        return view('kerjasama.create')
            ->with('kategoris', $kategoris)
            ->with('statuses', $statuses)
            ->with('kerjasamas', $kerjasamas)
            ->with('usulans', $usulans);
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
        // Input kerjasama baru
        if ($request->nama_kerja_sama != '' || $request->nama_kerja_sama != null) {
            if($request->nama_kategori == '1'){
                $validateData = $request->validate([
                    'nama_kerja_sama' => 'required',
                    'tanggal_mulai' => 'required',
                    'tanggal_sampai' => 'required|date|date_format:Y-m-d|after:tanggal_mulai',
                    'nama_kategori' => 'required',
                    'nama_status' => 'required',
                    'usulan' => 'required',
                    'no_mou' => 'required',
                ]);
            }
            else{
                $validateData = $request->validate([
                    'nama_kerja_sama' => 'required',
                    'tanggal_mulai' => 'required',
                    'tanggal_sampai' => 'required|date|date_format:Y-m-d|after:tanggal_mulai',
                    'nama_kategori' => 'required',
                    'nama_status' => 'required',
                    'usulan' => 'required',
                ]);
            }
    
            $kerjasama = new Kerjasama();
    
            if($request->no_mou != '' || $request->no_mou != null){
                $kerjasama->no_mou = $validateData['no_mou'];
            }
            else{
                $kerjasama->no_mou = '';
            }
    
            $kerjasama->nama_kerja_sama = $validateData['nama_kerja_sama'];
            $kerjasama->tanggal_mulai = $validateData['tanggal_mulai'];
            $kerjasama->tanggal_sampai = $validateData['tanggal_sampai'];
            $kerjasama->kategori_id = $validateData['nama_kategori'];
            $kerjasama->status_id = $validateData['nama_status'];
            $kerjasama->usulan_id = $validateData['usulan'];
    
            $kerjasama->save();
    
            $request->session()->flash('pesan', 'Penambahan data berhasil');
            return redirect()->route('kerjasamas.index');
        }
        // Input kegiatan baru melalui kerjasama show
        else{
            $validateData = $request->validate([
                'tanggal_mulai' => 'required',
                'tanggal_sampai' => 'required|date|date_format:Y-m-d|after:tanggal_mulai',
                'bentuk_kegiatan' => 'required',
                // 'PIC' => 'required',
                'kerjasama_id' => 'required',
                'pic_dosen' => 'required',
                'keterangan' => 'required',
            ]);
    
            $kegiatan = new Kegiatan();
    
            $kegiatan->tanggal_mulai = $validateData['tanggal_mulai'];
            $kegiatan->tanggal_sampai = $validateData['tanggal_sampai'];
            $kegiatan->bentuk_kegiatan = $validateData['bentuk_kegiatan'];
            // $kegiatan->PIC = $validateData['PIC'];
            $kegiatan->kerjasama_id = $validateData['kerjasama_id'];
            $kegiatan->user_id = $validateData['pic_dosen'];
            $kegiatan->keterangan =$validateData['keterangan'];
    
            $kegiatan->save();
    
            // send mail
            $findUser = User::findOrFail($kegiatan->user_id);
            $bentukKegiatan = $validateData['bentuk_kegiatan'];
            $tanggalMulaiKegiatan = $validateData['tanggal_mulai']; 
            $tanggalSampaiKegiatan = $validateData['tanggal_sampai'];
            $id_kegiatan = $kegiatan->id; //get id kegiatan for send email
            
            $details = [
                'title' => 'Kegiatan Baru',
                'user_name' => $findUser->name,
                'bentuk_kegiatan' => $bentukKegiatan,
                'tanggal_mulai' => $tanggalMulaiKegiatan,
                'tanggal_sampai' => $tanggalSampaiKegiatan,
                'id_kegiatan' => $id_kegiatan,
            ];

            Mail::to($findUser->email)->send(new \App\Mail\MyTestMail($details));


            $request->session()->flash('pesan', 'Penambahan data berhasil');
            return redirect()->route('kerjasamas.show', $kegiatan->kerjasama_id);
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kerjasama  $kerjasama
     * @return \Illuminate\Http\Response
     */
    public function show(Kerjasama $kerjasama)
    {
        //
        $buktiKerjasama = DB::select("SELECT bukti_kerjasamas.id, nama_bukti_kerjasama, bukti_kerjasamas.file, LEFT(bukti_kerjasamas.created_at, 10) as tanggalUpload 
        FROM bukti_kerjasamas
        JOIN kerjasamas ON bukti_kerjasamas.kerjasama_id = kerjasamas.id
        WHERE bukti_kerjasamas.kerjasama_id = $kerjasama->id");

        $users = DB::select("SELECT b.id, b.kode_dosen, b.name
        FROM users b 
        WHERE b.kode_dosen NOT IN ( 
            SELECT DISTINCT users.kode_dosen 
            FROM users 
            LEFT JOIN kegiatans ON kegiatans.user_id = users.id 
            LEFT JOIN bukti_kegiatans on bukti_kegiatans.kegiatans_id = kegiatans.id 
            WHERE (kegiatans.bentuk_kegiatan IS NOT NULL AND bukti_kegiatans.nama_bukti_kegiatan IS NULL) 
            ORDER BY users.id )");
            
        $kegiatans = Kegiatan::All();

        return view('kerjasama.show')
            ->with('kerjasama', $kerjasama)
            ->with('buktiKerjasama', $buktiKerjasama)
            ->with('users', $users)
            ->with('kegiatans', $kegiatans);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kerjasama  $kerjasama
     * @return \Illuminate\Http\Response
     */
    public function edit(Kerjasama $kerjasama)
    {
        //
        $this->authorize('viewAny', User::class);
        $kategoris = Kategori::All();
        $statuses = Status::All();
        $usulans = Usulan::All()->where('hasil_penjajakan', 'L');
        
        return view('kerjasama.edit')
            ->with('kerjasama', $kerjasama)
            ->with('kategoris', $kategoris)
            ->with('statuses', $statuses)
            ->with('usulans', $usulans);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kerjasama  $kerjasama
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kerjasama $kerjasama)
    {
        //
        $this->authorize('viewAny', User::class);
        if($request->nama_kategori == '1'){
            $this->validate($request, [
                'nama_kerja_sama' => 'required',
                'tanggal_mulai' => 'required',
                'tanggal_sampai' => 'required|date|date_format:Y-m-d|after:tanggal_mulai',
                'nama_kategori' => 'required',
                'nama_status' => 'required',
                'usulan' => 'required',
                'no_mou' => 'required',
            ]);
        }
        else{
            $this->validate($request, [
                'nama_kerja_sama' => 'required',
                'tanggal_mulai' => 'required',
                'tanggal_sampai' => 'required|date|date_format:Y-m-d|after:tanggal_mulai',
                'nama_kategori' => 'required',
                'nama_status' => 'required',
                'usulan' => 'required',
            ]);
        }

        $kerjasama = Kerjasama::findOrFail($kerjasama->id);

        if($request->nama_kategori == '1'){
            $kerjasama->update([
                'no_mou' => $request->no_mou,
                'nama_kerja_sama' => $request->nama_kerja_sama,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_sampai' => $request->tanggal_sampai,
                'kategori_id' => $request->nama_kategori,
                'status_id' => $request->nama_status,
                'usulan_id' => $request->usulan
            ]);
        }
        else{
            $kerjasama->update([
                'nama_kerja_sama' => $request->nama_kerja_sama,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_sampai' => $request->tanggal_sampai,
                'kategori_id' => $request->nama_kategori,
                'status_id' => $request->nama_status,
                'usulan_id' => $request->usulan
            ]);
        }

        $request->session()->flash('pesan', 'Perubahan data berhasil');
        return redirect()->route('kerjasamas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kerjasama  $kerjasama
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kerjasama $kerjasama)
    {
        //
        $this->authorize('adminOnly', User::class);
        $getBuktiKerjasama = DB::select("SELECT id, nama_bukti_kerjasama, bukti_kerjasamas.file AS 'file', kerjasama_id FROM bukti_kerjasamas WHERE kerjasama_id = $kerjasama->id");

        // unlink semua file sekaligus
        if(count($getBuktiKerjasama) > 0){
            for ($i = 0; $i < count($getBuktiKerjasama); $i++) {
                unlink(storage_path('app/public/kerjasama/'.$getBuktiKerjasama[$i]->file));
            }
        }
        $kerjasama->delete();
        return redirect()->route('kerjasamas.index')->with('pesan', "Hapus data $kerjasama->nama_kerja_sama berhasil");
    }

    // Delete from usulan show.blade.php
    public function customDestroy($id_kerjasama){
        $this->authorize('adminOnly', User::class);
        
        $kerjasama = Kerjasama::findOrFail($id_kerjasama);

        $getBuktiKerjasama = DB::select("SELECT id, nama_bukti_kerjasama, bukti_kerjasamas.file AS 'file', kerjasama_id FROM bukti_kerjasamas WHERE kerjasama_id = $kerjasama->id");

        // unlink semua file sekaligus
        if(count($getBuktiKerjasama) > 0){
            for ($i = 0; $i < count($getBuktiKerjasama); $i++) {
                unlink(storage_path('app/public/kerjasama/'.$getBuktiKerjasama[$i]->file));
            }
        }
        
        $kerjasama->delete();
        return redirect()->route('usulans.show', $kerjasama->usulan_id)->with('pesan', "Hapus data kerjasama : $kerjasama->nama_kerja_sama berhasil");

    }
}
