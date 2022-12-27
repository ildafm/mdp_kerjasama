<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\BentukKegiatan;
use App\Models\BuktiKerjasama;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $kegiatans = Kegiatan::All();
        if (isset($_GET['filter_tanggal_mulai']) && isset($_GET['filter_tanggal_sampai'])) {
            $tanggal_mulai = ($_GET['filter_tanggal_mulai']);
            $tanggal_sampai = ($_GET['filter_tanggal_sampai']);

            $kegiatans = Kegiatan::where('tanggal_mulai', '>=', $tanggal_mulai)->where('tanggal_sampai', '<=', $tanggal_sampai)->get();
        } else {
            $tanggal_mulai = date('Y-m-d');
            $tanggal_sampai = date('Y-m-d');
        }
        return view('kegiatan.index')
            ->with('kegiatans', $kegiatans)
            ->with('tanggal_mulai', $tanggal_mulai)
            ->with('tanggal_sampai', $tanggal_sampai);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $this->authorize('viewAny', User::class);

        $users = DB::select("SELECT tbl_user_yang_belum_ditugaskan.id, tbl_user_yang_belum_ditugaskan.kode_dosen, tbl_user_yang_belum_ditugaskan.name
        FROM users tbl_user_yang_belum_ditugaskan 
        WHERE tbl_user_yang_belum_ditugaskan.kode_dosen NOT IN ( 
            SELECT DISTINCT users.kode_dosen 
            FROM users 
            LEFT JOIN kegiatans ON kegiatans.user_id = users.id 
            LEFT JOIN bukti_kegiatans on bukti_kegiatans.kegiatans_id = kegiatans.id 
            WHERE (kegiatans.bentuk_kegiatan_id IS NOT NULL AND bukti_kegiatans.nama_bukti_kegiatan IS NULL) 
            ORDER BY users.id )");

        // $kerjasamas = Kerjasama::where("status_id", "!=" , "2")->get();
        $kerjasamas = DB::select("SELECT kerjasamas.*, mitras.nama_mitra
        FROM kerjasamas
        JOIN usulans ON usulans.id = kerjasamas.usulan_id
        JOIN mitras ON mitras.id = usulans.mitra_id
        WHERE status_id != 2 AND kerjasamas.id IN(SELECT DISTINCT kerjasama_id FROM bukti_kerjasamas WHERE jenis_file = 'S')");

        $bentukKegiatans = BentukKegiatan::orderBy('bentuk', 'asc')->get();

        // $SPK = DB::select("SELECT * FROM bukti_kerjasamas
        // WHERE jenis_file = 'S' AND kerjasama_id = $kerjasama->id");
        $getIdKerjasama = 0;
        if ($request->id != null) {
            $getIdKerjasama = $request->id;
        }

        $SPK = DB::select("SELECT * FROM bukti_kerjasamas
        WHERE jenis_file = 'S' AND kerjasama_id = $getIdKerjasama");

        return view('kegiatan.create')
            ->with('users', $users)
            ->with('kerjasamas', $kerjasamas)
            ->with('bentukKegiatans', $bentukKegiatans)
            ->with('SPK', $SPK);
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
            'kerjasamas' => 'required',
            'pic_dosen' => 'required',
            'keterangan' => 'required',
            'spk' => 'required',
        ]);

        $kegiatan = new Kegiatan();

        $kegiatan->tanggal_mulai = $validateData['tanggal_mulai'];
        $kegiatan->tanggal_sampai = $validateData['tanggal_sampai'];
        $kegiatan->bentuk_kegiatan_id = $validateData['bentuk_kegiatan'];
        $kegiatan->kerjasama_id = $validateData['kerjasamas'];
        $kegiatan->user_id = $validateData['pic_dosen'];
        $kegiatan->bukti_kerjasama_spk_id = $validateData['spk'];
        $kegiatan->keterangan = $validateData['keterangan'];

        $kegiatan->save();

        // Send email to user
        $findUser = User::findOrFail($kegiatan->user_id);
        $tanggalMulaiKegiatan = $validateData['tanggal_mulai'];
        $tanggalSampaiKegiatan = $validateData['tanggal_sampai'];
        $id_kegiatan = $kegiatan->id; //get id kegiatan for send email

        $details = [
            'title' => 'Kegiatan Baru',
            'user_name' => $findUser->name,
            'tanggal_mulai' => $tanggalMulaiKegiatan,
            'tanggal_sampai' => $tanggalSampaiKegiatan,
            'id_kegiatan' => $id_kegiatan,
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
    public function edit(Kegiatan $kegiatan, Request $request)
    {
        //
        $this->authorize('viewAny', User::class);
        $type = $request->type;

        // $kerjasamas = Kerjasama::All();
        $kerjasamas = DB::select("SELECT kerjasamas.*, mitras.nama_mitra
        FROM kerjasamas
        JOIN usulans ON usulans.id = kerjasamas.usulan_id
        JOIN mitras ON mitras.id = usulans.mitra_id
        WHERE status_id != 2 AND kerjasamas.id IN(SELECT DISTINCT kerjasama_id FROM bukti_kerjasamas WHERE jenis_file = 'S')");

        $idPIC = $kegiatan->user_id;
        $users = DB::select("SELECT tbl_user_yang_belum_ditugaskan.id, tbl_user_yang_belum_ditugaskan.kode_dosen, tbl_user_yang_belum_ditugaskan.name
        FROM users tbl_user_yang_belum_ditugaskan 
        WHERE tbl_user_yang_belum_ditugaskan.id = $idPIC OR tbl_user_yang_belum_ditugaskan.kode_dosen NOT IN ( 
            SELECT DISTINCT users.kode_dosen 
            FROM users 
            LEFT JOIN kegiatans ON kegiatans.user_id = users.id 
            LEFT JOIN bukti_kegiatans on bukti_kegiatans.kegiatans_id = kegiatans.id 
            WHERE (kegiatans.bentuk_kegiatan_id IS NOT NULL AND bukti_kegiatans.nama_bukti_kegiatan IS NULL) 
            ORDER BY users.id)");

        $bentukKegiatans = BentukKegiatan::all();


        $getIdKerjasama = $kegiatan->kerjasama_id;
        if ($request->id != null) {
            $getIdKerjasama = $request->id;
        }
        $SPK = DB::select("SELECT * FROM bukti_kerjasamas
        WHERE jenis_file = 'S' AND kerjasama_id = $getIdKerjasama");

        // $SPK = BuktiKerjasama::where('kerjasama_id', $getIdKerjasama);

        return view('kegiatan.edit')
            ->with('kerjasamas', $kerjasamas)
            ->with('kegiatan', $kegiatan)
            ->with('bentukKegiatans', $bentukKegiatans)
            ->with('users', $users)
            ->with('SPK', $SPK)
            ->with('type', $type);
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
        $this->authorize('viewAny', User::class);

        $this->validate($request, [
            'tanggal_mulai' => 'required',
            'tanggal_sampai' => 'required|date|date_format:Y-m-d|after:tanggal_mulai',
            'bentuk_kegiatan' => 'required',
            'pic_dosen' => 'required',
            'keterangan' => 'required',
            'kerjasamas' => 'required',
            'spk' => 'required',
            'type' => '',
        ]);

        $kegiatan = Kegiatan::findOrFail($kegiatan->id);

        $kegiatan->update([
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_sampai' => $request->tanggal_sampai,
            'bentuk_kegiatan_id' => $request->bentuk_kegiatan,
            // 'PIC' => $request->PIC,
            'user_id' => $request->pic_dosen,
            'keterangan' => $request->keterangan,
            'kerjasama_id' => $request->kerjasamas,
            'bukti_kerjasama_spk_id' => $request->spk,
        ]);

        $request->session()->flash('pesan', 'Perubahan data berhasil');
        if ($request->type == 1) {
            return redirect('/notification_kegiatans');
        } elseif ($request->type == 2) {
            return redirect('/notification_kegiatan_belum_ada_buktis');
        } else {
            return redirect()->route('kegiatans.index');
        }
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
        $this->authorize('adminOnly', User::class);
        $getBuktiKegiatan = DB::select("SELECT id, nama_bukti_kegiatan, bukti_kegiatans.file AS 'file', kegiatans_id FROM bukti_kegiatans WHERE kegiatans_id = $kegiatan->id");

        // unlink semua file sekaligus
        if (count($getBuktiKegiatan) > 0) {
            for ($i = 0; $i < count($getBuktiKegiatan); $i++) {
                unlink(storage_path('app/public/kegiatan/' . $getBuktiKegiatan[$i]->file));
            }
        }

        $getBentukKegiatan = $kegiatan->bentukKegiatan->bentuk;

        $kegiatan->delete();
        return redirect()->route('kegiatans.index')->with('pesan', "Hapus data kegiatan : $getBentukKegiatan berhasil");
    }

    // Delete from kerjasama show.blade.php
    public function customDestroy($id_kegiatan)
    {
        $this->authorize('adminOnly', User::class);

        $kegiatan = Kegiatan::findOrFail($id_kegiatan);

        $getBuktiKegiatan = DB::select("SELECT id, nama_bukti_kegiatan, bukti_kegiatans.file AS 'file', kegiatans_id FROM bukti_kegiatans WHERE kegiatans_id = $kegiatan->id");

        // unlink semua file sekaligus
        if (count($getBuktiKegiatan) > 0) {
            for ($i = 0; $i < count($getBuktiKegiatan); $i++) {
                unlink(storage_path('app/public/kegiatan/' . $getBuktiKegiatan[$i]->file));
            }
        }

        $kegiatan->delete();
        return redirect()->route('kerjasamas.show', $kegiatan->kerjasama_id)->with('pesan', "Hapus data kegiatan : $kegiatan->bentuk_kegiatan berhasil");
    }
}
