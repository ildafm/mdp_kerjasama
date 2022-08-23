<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Models\Kerjasama;
use App\Models\User;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyTestMail;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // if(Auth::user()->level != 'D'){
        //     $kegiatans = Kegiatan::All();
        // }
        // else{
        //     $getUserID = Auth::user()->id;
        //     $kegiatans = DB::select("SELECT kegiatans.id AS 'id', kegiatans.tanggal_mulai, kegiatans.tanggal_sampai, bentuk_kegiatan, PIC, keterangan, nama_kerja_sama, users.name AS 'name' FROM kegiatans JOIN kerjasamas ON kerjasama_id = kerjasamas.id JOIN users ON kegiatans.user_id = users.id WHERE kegiatans.user_id = $getUserID");
        // }

        $kegiatans = Kegiatan::All();

        return view('kegiatan.index')->with('kegiatans', $kegiatans);
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

        $users = User::All();
        $kerjasamas = Kerjasama::All();
        return view('kegiatan.create')
            ->with('users', $users)
            ->with('kerjasamas', $kerjasamas);
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

        $validateData = $request->validate([
            'tanggal_mulai' => 'required',
            'tanggal_sampai' => 'required|date|date_format:Y-m-d|after:tanggal_mulai',
            'bentuk_kegiatan' => 'required',
            // 'PIC' => 'required',
            'kerjasamas' => 'required',
            'pic_dosen' => 'required',
            'keterangan' => 'required',
        ]);

        $kegiatan = new Kegiatan();

        $kegiatan->tanggal_mulai = $validateData['tanggal_mulai'];
        $kegiatan->tanggal_sampai = $validateData['tanggal_sampai'];
        $kegiatan->bentuk_kegiatan = $validateData['bentuk_kegiatan'];
        // $kegiatan->PIC = $validateData['PIC'];
        $kegiatan->kerjasama_id = $validateData['kerjasamas'];
        $kegiatan->user_id = $validateData['pic_dosen'];
        $kegiatan->keterangan =$validateData['keterangan'];

        $kegiatan->save();

        $findUser = User::findOrFail($kegiatan->user_id);
        $bentukKegiatan = $validateData['bentuk_kegiatan'];
        $tanggalMulaiKegiatan = $validateData['tanggal_mulai']; 
        $tanggalSampaiKegiatan = $validateData['tanggal_sampai'];
        $details = [
            'title' => 'Kegiatan Baru',
            'user_name' => $findUser->name,
            'bentuk_kegiatan' => $bentukKegiatan,
            'tanggal_mulai' => $tanggalMulaiKegiatan,
            'tanggal_sampai' => $tanggalSampaiKegiatan,
        ];

        Mail::to($findUser->email)->send(new \App\Mail\MyTestMail($details));

        $request->session()->flash('pesan', 'Penambahan data berhasil');
        return redirect()->route('kegiatans.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function show(Kegiatan $kegiatan)
    {
        //

        $buktiKegiatans = DB::select("SELECT bukti_kegiatans.id AS id_bukti_kegiatan, bukti_kegiatans.nama_bukti_kegiatan AS nama_bukti_kegiatan, bukti_kegiatans.bidang AS 'bidang', kegiatans.keterangan AS keterangan_kegiatan, units.nama_unit, ceklist_apt, ceklist_aps, ceklist_lamemba, LEFT(bukti_kegiatans.created_at, 10) AS tanggal_upload_bukti, bukti_kegiatans.file AS 'file'
        FROM bukti_kegiatans 
        JOIN kegiatans ON bukti_kegiatans.kegiatans_id = kegiatans.id
        JOIN bukti_kegiatan_units ON bukti_kegiatans.id = bukti_kegiatan_units.bukti_kegiatans_id
        JOIN units ON bukti_kegiatan_units.units_id = units.id
        WHERE bukti_kegiatans.kegiatans_id = $kegiatan->id");

        $units = Unit::All();
        
        // update status kegiatan
        if (Auth::user()->id == $kegiatan->user_id) {
            DB::update("UPDATE kegiatans SET kegiatans.status = '1' WHERE id = $kegiatan->id");
        }

        return view('kegiatan.show')
            ->with('buktiKegiatans', $buktiKegiatans)
            ->with('kegiatan', $kegiatan)
            ->with('units', $units);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kegiatan $kegiatan)
    {
        //
        $this->authorize('viewAny', User::class);

        // if(Auth::user()->id != $kegiatan->user_id){
        //     $this->authorize('viewAny', User::class);
        // }
        
        $kerjasamas = Kerjasama::All();
        $users = User::All();
        return view('kegiatan.edit')
            ->with('kerjasamas', $kerjasamas)
            ->with('kegiatans', $kegiatan)
            ->with('users', $users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        //
        $this->validate($request, [
            'tanggal_mulai' => 'required',
            'tanggal_sampai' => 'required|date|date_format:Y-m-d|after:tanggal_mulai',
            'bentuk_kegiatan' => 'required',
            // 'PIC' => 'required',
            'pic_dosen' => 'required',
            'keterangan' => 'required',
            'kerjasamas' => 'required',
        ]);

        $kegiatan = Kegiatan::findOrFail($kegiatan->id);

        $kegiatan->update([
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_sampai' => $request->tanggal_sampai,
            'bentuk_kegiatan' => $request->bentuk_kegiatan,
            // 'PIC' => $request->PIC,
            'user_id' => $request->pic_dosen,
            'keterangan' => $request->keterangan,
            'kerjasama_id' => $request->kerjasamas,
        ]);

        $request->session()->flash('pesan', 'Perubahan data berhasil');
        return redirect()->route('kegiatans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kegiatan $kegiatan)
    {
        //
        $getBuktiKegiatan = DB::select("SELECT id, nama_bukti_kegiatan, bukti_kegiatans.file AS 'file', kegiatans_id FROM bukti_kegiatans WHERE kegiatans_id = $kegiatan->id");

        // unlink semua file sekaligus
        if(count($getBuktiKegiatan) > 0){
            for ($i = 0; $i < count($getBuktiKegiatan); $i++) {
                unlink(storage_path('app/public/kegiatan/'.$getBuktiKegiatan[$i]->file));
            }
        }
        
        $kegiatan->delete();
            return redirect()->route('kegiatans.index')->with('pesan', "Hapus data kegiatan : $kegiatan->bentuk_kegiatan berhasil");
    }

    public function customDestroy($id_kegiatan){
        $kegiatan = Kegiatan::findOrFail($id_kegiatan);

        $getBuktiKegiatan = DB::select("SELECT id, nama_bukti_kegiatan, bukti_kegiatans.file AS 'file', kegiatans_id FROM bukti_kegiatans WHERE kegiatans_id = $kegiatan->id");

        // unlink semua file sekaligus
        if(count($getBuktiKegiatan) > 0){
            for ($i = 0; $i < count($getBuktiKegiatan); $i++) {
                unlink(storage_path('app/public/kegiatan/'.$getBuktiKegiatan[$i]->file));
            }
        }
        
        $kegiatan->delete();
        return redirect()->route('kerjasamas.show', $kegiatan->kerjasama_id)->with('pesan', "Hapus data kegiatan : $kegiatan->bentuk_kegiatan berhasil");

    }
}
