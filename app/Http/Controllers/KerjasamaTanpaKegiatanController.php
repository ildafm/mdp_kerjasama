<?php

namespace App\Http\Controllers;

use App\Models\BentukKegiatan;
use App\Models\BuktiKerjasama;
use App\Models\Kategori;
use App\Models\Kegiatan;
use App\Models\Kerjasama;
use App\Models\Status;
use App\Models\Usulan;
use App\Models\KerjasamaTanpaKegiatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class KerjasamaTanpaKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() // Only index
    {
        //
        $kerjasamas = DB::select("SELECT * FROM (
            SELECT kerjasamas.id, mitras.nama_mitra, kerjasamas.nama_kerja_sama, bentuk_kegiatans.bentuk AS 'bentuk_kegiatan', mou.nomor_file AS 'no_mou', mou.file AS 'file_mou', kerjasamas.bidang, kerjasamas.tanggal_mulai, kerjasamas.tanggal_sampai, kategoris.nama_kategori, statuses.nama_status, usulans.usulan
            FROM kerjasamas
            LEFT JOIN kegiatans ON kegiatans.kerjasama_id = kerjasamas.id
            LEFT JOIN bentuk_kegiatans ON bentuk_kegiatans.id = kegiatans.bentuk_kegiatan_id
            JOIN (SELECT * FROM bukti_kerjasamas WHERE jenis_file = 'M') AS mou ON mou.kerjasama_id = kerjasamas.id
            JOIN kategoris ON kategoris.id = kerjasamas.kategori_id
            JOIN statuses ON statuses.id = kerjasamas.status_id
            JOIN usulans ON usulans.id = kerjasamas.usulan_id
            JOIN mitras ON mitras.id = usulans.mitra_id
            WHERE kategoris.id = '1'
        ) AS c
        -- WHERE c.bentuk_kegiatan IS NULL
        ORDER BY c.id");

        if (isset($_GET['filter_tanggal_mulai']) && isset($_GET['filter_tanggal_sampai'])) {
            $tanggal_mulai = ($_GET['filter_tanggal_mulai']);
            $tanggal_sampai = ($_GET['filter_tanggal_sampai']);


            $kerjasamas = DB::select("SELECT * FROM (
                SELECT kerjasamas.id, mitras.nama_mitra, kerjasamas.nama_kerja_sama, bentuk_kegiatans.bentuk AS 'bentuk_kegiatan', mou.nomor_file AS 'no_mou', mou.file AS 'file_mou', kerjasamas.bidang, kerjasamas.tanggal_mulai, kerjasamas.tanggal_sampai, kategoris.nama_kategori, statuses.nama_status, usulans.usulan
                FROM kerjasamas
                LEFT JOIN kegiatans ON kegiatans.kerjasama_id = kerjasamas.id
                LEFT JOIN bentuk_kegiatans ON bentuk_kegiatans.id = kegiatans.bentuk_kegiatan_id
                JOIN (SELECT * FROM bukti_kerjasamas WHERE jenis_file = 'M') AS mou ON mou.kerjasama_id = kerjasamas.id
                JOIN kategoris ON kategoris.id = kerjasamas.kategori_id
                JOIN statuses ON statuses.id = kerjasamas.status_id
                JOIN usulans ON usulans.id = kerjasamas.usulan_id
                JOIN mitras ON mitras.id = usulans.mitra_id
                WHERE kategoris.id = '1'
            ) AS c
             WHERE (c.tanggal_mulai >= '$tanggal_mulai' AND c.tanggal_sampai <= '$tanggal_sampai') -- AND c.bentuk_kegiatan IS NULL
            ORDER BY c.id");
        } else {
            $tanggal_mulai = date('Y-m-d');
            $tanggal_sampai = date('Y-m-d');
        }

        return view('kerjasama_dengan_mou.index')
            ->with('kerjasamas', $kerjasamas)
            ->with('tanggal_mulai', $tanggal_mulai)
            ->with('tanggal_sampai', $tanggal_sampai);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        // $this->authorize('viewAny', User::class);

        // $kategoris = Kategori::All();
        // $statuses = Status::All();
        // $kerjasamas = Kerjasama::All();
        // $usulans = Usulan::All()->where('hasil_penjajakan', 'L');

        // return view('kerjasama_tanpa_kegiatan.create')
        //     ->with('kategoris', $kategoris)
        //     ->with('statuses', $statuses)
        //     ->with('kerjasamas', $kerjasamas)
        //     ->with('usulans', $usulans);
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
        // $this->authorize('viewAny', User::class);

        // // input kerjasama baru
        // if ($request->nama_kerja_sama != '' || $request->nama_kerja_sama != null) {
        //     if ($request->nama_kategori == '1') {
        //         $validateData = $request->validate([
        //             'nama_kerja_sama' => 'required',
        //             'tanggal_mulai' => 'required',
        //             'tanggal_sampai' => 'required|date|date_format:Y-m-d|after:tanggal_mulai',
        //             'nama_kategori' => 'required',
        //             'nama_status' => 'required',
        //             'usulan' => 'required',
        //             'bidang' => 'required',
        //             'no_mou' => 'required',
        //         ]);
        //     } else {
        //         $validateData = $request->validate([
        //             'nama_kerja_sama' => 'required',
        //             'tanggal_mulai' => 'required',
        //             'tanggal_sampai' => 'required|date|date_format:Y-m-d|after:tanggal_mulai',
        //             'nama_kategori' => 'required',
        //             'nama_status' => 'required',
        //             'usulan' => 'required',
        //             'bidang' => 'required',
        //         ]);
        //     }

        //     $kerjasama = new Kerjasama();

        //     if ($request->no_mou != '' || $request->no_mou != null) {
        //         $kerjasama->no_mou = $validateData['no_mou'];
        //     } else {
        //         $kerjasama->no_mou = '';
        //     }

        //     $kerjasama->nama_kerja_sama = $validateData['nama_kerja_sama'];
        //     $kerjasama->tanggal_mulai = $validateData['tanggal_mulai'];
        //     $kerjasama->tanggal_sampai = $validateData['tanggal_sampai'];
        //     $kerjasama->kategori_id = $validateData['nama_kategori'];
        //     $kerjasama->status_id = $validateData['nama_status'];
        //     $kerjasama->usulan_id = $validateData['usulan'];

        //     $kerjasama->save();

        //     $request->session()->flash('pesan', 'Penambahan data berhasil');
        //     return redirect()->route('kerjasama_tanpa_kegiatans.index');
        // }
        // // input kegiatan baru melalui show
        // else {
        //     $validateData = $request->validate([
        //         'tanggal_mulai' => 'required',
        //         'tanggal_sampai' => 'required|date|date_format:Y-m-d|after:tanggal_mulai',
        //         'bentuk_kegiatan' => 'required',
        //         // 'PIC' => 'required',
        //         'kerjasama_id' => 'required',
        //         'pic_dosen' => 'required',
        //         'keterangan' => 'required',
        //         'spk' => 'required',
        //     ]);

        //     $kegiatan = new Kegiatan();

        //     $kegiatan->tanggal_mulai = $validateData['tanggal_mulai'];
        //     $kegiatan->tanggal_sampai = $validateData['tanggal_sampai'];
        //     $kegiatan->bentuk_kegiatan_id = $validateData['bentuk_kegiatan'];
        //     $kegiatan->kerjasama_id = $validateData['kerjasama_id'];
        //     $kegiatan->user_id = $validateData['pic_dosen'];
        //     $kegiatan->keterangan = $validateData['keterangan'];
        //     $kegiatan->bukti_kerjasama_spk_id = $validateData['spk'];

        //     $kegiatan->save();

        //     // Send mail
        //     $findUser = User::findOrFail($kegiatan->user_id);
        //     $bentukKegiatan = $validateData['bentuk_kegiatan'];
        //     $tanggalMulaiKegiatan = $validateData['tanggal_mulai'];
        //     $tanggalSampaiKegiatan = $validateData['tanggal_sampai'];
        //     $id_kegiatan = $kegiatan->id; //get id kegiatan for send email

        //     $details = [
        //         'title' => 'Kegiatan Baru',
        //         'user_name' => $findUser->name,
        //         'bentuk_kegiatan' => $bentukKegiatan,
        //         'tanggal_mulai' => $tanggalMulaiKegiatan,
        //         'tanggal_sampai' => $tanggalSampaiKegiatan,
        //         'id_kegiatan' => $id_kegiatan,
        //     ];

        //     Mail::to($findUser->email)->send(new \App\Mail\MyTestMail($details));


        //     $request->session()->flash('pesan', 'Penambahan data berhasil');
        //     return redirect()->route('kerjasama_tanpa_kegiatans.show', $kegiatan->kerjasama_id);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // $kerjasama = DB::select("SELECT * FROM (
        //     SELECT kerjasamas.id, kerjasamas.nama_kerja_sama, bentuk_kegiatans.bentuk AS 'bentuk_kegiatan', kerjasamas.no_mou, kerjasamas.bidang, kerjasamas.tanggal_mulai, kerjasamas.tanggal_sampai, kerjasamas.kategori_id, kategoris.nama_kategori, kerjasamas.status_id, statuses.nama_status, usulans.usulan
        //     FROM kerjasamas
        //     LEFT JOIN kegiatans ON kegiatans.kerjasama_id = kerjasamas.id
        //     LEFT JOIN bentuk_kegiatans ON bentuk_kegiatans.id = kegiatans.id
        //     JOIN kategoris ON kategoris.id = kerjasamas.kategori_id
        //     JOIN statuses ON statuses.id = kerjasamas.status_id
        //     JOIN usulans ON usulans.id = kerjasamas.usulan_id
        // ) AS c
        // WHERE c.bentuk_kegiatan IS NULL AND c.id = $id");

        // // Jika Kerjasama belum memiliki kegiatan
        // if (count($kerjasama) > 0) {
        //     $buktiKerjasama = DB::select("SELECT bukti_kerjasamas.*, LEFT(bukti_kerjasamas.created_at, 10) as tanggalUpload 
        //     FROM bukti_kerjasamas
        //     JOIN kerjasamas ON bukti_kerjasamas.kerjasama_id = kerjasamas.id
        //     WHERE bukti_kerjasamas.kerjasama_id = $id");

        //     $users = DB::select("SELECT b.id, b.kode_dosen, b.name
        //     FROM users b 
        //     WHERE b.kode_dosen NOT IN ( 
        //         SELECT DISTINCT users.kode_dosen 
        //         FROM users 
        //         LEFT JOIN kegiatans ON kegiatans.user_id = users.id 
        //         LEFT JOIN bukti_kegiatans on bukti_kegiatans.kegiatans_id = kegiatans.id 
        //         WHERE (kegiatans.bentuk_kegiatan_id IS NOT NULL AND bukti_kegiatans.nama_bukti_kegiatan IS NULL) 
        //         ORDER BY users.id )");

        //     $kegiatans = Kegiatan::All();
        //     $bentukKegiatans = BentukKegiatan::all();

        //     $SPK = DB::select("SELECT * FROM bukti_kerjasamas
        //     WHERE jenis_file = 'S' AND kerjasama_id = $id");

        //     return view('kerjasama_tanpa_kegiatan.show')
        //         ->with('kerjasama', $kerjasama[0])
        //         ->with('buktiKerjasama', $buktiKerjasama)
        //         ->with('users', $users)
        //         ->with('bentukKegiatans', $bentukKegiatans)
        //         ->with('kegiatans', $kegiatans)
        //         ->with('SPK', $SPK);
        // }
        // // Jika kerjasama sudah memiliki kegiatan
        // else {
        //     $kerjasama = Kerjasama::findOrFail($id);

        //     $buktiKerjasama = DB::select("SELECT bukti_kerjasamas.*, LEFT(bukti_kerjasamas.created_at, 10) as tanggalUpload 
        //     FROM bukti_kerjasamas
        //     JOIN kerjasamas ON bukti_kerjasamas.kerjasama_id = kerjasamas.id
        //     WHERE bukti_kerjasamas.kerjasama_id = $id");

        //     $users = DB::select("SELECT b.id, b.kode_dosen, b.name
        //     FROM users b 
        //     WHERE b.kode_dosen NOT IN ( 
        //         SELECT DISTINCT users.kode_dosen 
        //         FROM users 
        //         LEFT JOIN kegiatans ON kegiatans.user_id = users.id 
        //         LEFT JOIN bukti_kegiatans on bukti_kegiatans.kegiatans_id = kegiatans.id 
        //         WHERE (kegiatans.bentuk_kegiatan IS NOT NULL AND bukti_kegiatans.nama_bukti_kegiatan IS NULL) 
        //         ORDER BY users.id )");

        //     $kegiatans = Kegiatan::All();
        //     $bentukKegiatans = BentukKegiatan::all();

        //     return view('kerjasama.show')
        //         ->with('kerjasama', $kerjasama)
        //         ->with('buktiKerjasama', $buktiKerjasama)
        //         ->with('users', $users)
        //         ->with('bentukKegiatans', $bentukKegiatans)
        //         ->with('kegiatans', $kegiatans);
        // }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // $this->authorize('viewAny', User::class);

        // $kerjasama = DB::select("SELECT * FROM (
        //     SELECT kerjasamas.id, kerjasamas.nama_kerja_sama, bentuk_kegiatans.bentuk AS 'bentuk_kegiatan', kerjasamas.no_mou, kerjasamas.bidang, kerjasamas.tanggal_mulai, kerjasamas.tanggal_sampai, kategori_id, kategoris.nama_kategori, status_id, statuses.nama_status, usulan_id, usulans.usulan
        //     FROM kerjasamas
        //     LEFT JOIN kegiatans ON kegiatans.kerjasama_id = kerjasamas.id
        //     LEFT JOIN bentuk_kegiatans ON bentuk_kegiatans.id = kegiatans.bentuk_kegiatan_id
        //     JOIN kategoris ON kategoris.id = kerjasamas.kategori_id
        //     JOIN statuses ON statuses.id = kerjasamas.status_id
        //     JOIN usulans ON usulans.id = kerjasamas.usulan_id
        // ) AS c
        // WHERE c.bentuk_kegiatan IS NULL AND c.id = $id");

        // $kategoris = Kategori::All();
        // $statuses = Status::All();
        // $usulans = Usulan::All()->where('hasil_penjajakan', 'L');

        // return view('kerjasama_tanpa_kegiatan.edit')
        //     ->with('kerjasama', $kerjasama[0])
        //     ->with('kategoris', $kategoris)
        //     ->with('statuses', $statuses)
        //     ->with('usulans', $usulans);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // $this->authorize('viewAny', User::class);

        // if ($request->nama_kategori == '1') {
        //     $this->validate($request, [
        //         'nama_kerja_sama' => 'required',
        //         'tanggal_mulai' => 'required',
        //         'tanggal_sampai' => 'required|date|date_format:Y-m-d|after:tanggal_mulai',
        //         'nama_kategori' => 'required',
        //         'nama_status' => 'required',
        //         'usulan' => 'required',
        //         'bidang' => 'required',
        //         'no_mou' => 'required',
        //     ]);
        // } else {
        //     $this->validate($request, [
        //         'nama_kerja_sama' => 'required',
        //         'tanggal_mulai' => 'required',
        //         'tanggal_sampai' => 'required|date|date_format:Y-m-d|after:tanggal_mulai',
        //         'nama_kategori' => 'required',
        //         'nama_status' => 'required',
        //         'usulan' => 'required',
        //         'bidang' => 'required',
        //     ]);
        // }

        // $kerjasama = Kerjasama::findOrFail($id);

        // if ($request->nama_kategori == '1') {
        //     $kerjasama->update([
        //         'no_mou' => $request->no_mou,
        //         'nama_kerja_sama' => $request->nama_kerja_sama,
        //         'bidang' => $request->bidang,
        //         'tanggal_mulai' => $request->tanggal_mulai,
        //         'tanggal_sampai' => $request->tanggal_sampai,
        //         'kategori_id' => $request->nama_kategori,
        //         'status_id' => $request->nama_status,
        //         'usulan_id' => $request->usulan
        //     ]);
        // } else {
        //     $kerjasama->update([
        //         'nama_kerja_sama' => $request->nama_kerja_sama,
        //         'bidang' => $request->bidang,
        //         'tanggal_mulai' => $request->tanggal_mulai,
        //         'tanggal_sampai' => $request->tanggal_sampai,
        //         'kategori_id' => $request->nama_kategori,
        //         'status_id' => $request->nama_status,
        //         'usulan_id' => $request->usulan
        //     ]);
        // }

        // $request->session()->flash('pesan', 'Perubahan data berhasil');
        // return redirect()->route('kerjasama_tanpa_kegiatans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // $this->authorize('adminOnly', User::class);

        // $getBuktiKerjasama = DB::select("SELECT * FROM bukti_kerjasamas WHERE kerjasama_id = $id");

        // // unlink semua file sekaligus
        // if (count($getBuktiKerjasama) > 0) {
        //     for ($i = 0; $i < count($getBuktiKerjasama); $i++) {
        //         unlink(storage_path('app/public/kerjasama/' . $getBuktiKerjasama[$i]->file));
        //     }
        // }
        // $kerjasama = Kerjasama::findOrFail($id);
        // $kerjasama->delete();
        // return redirect()->route('kerjasama_tanpa_kegiatans.index')->with('pesan', "Hapus data $kerjasama->nama_kerja_sama berhasil");
    }
}
