<?php

namespace App\Http\Controllers;

use App\Models\BentukKegiatan;
use App\Models\Kategori;
use App\Models\KategoriMou;
use App\Models\Kegiatan;
use App\Models\Kerjasama;
use App\Models\Status;
use App\Models\User;
use App\Models\Usulan;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use SebastianBergmann\Environment\Console;

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
        $kerjasamas = DB::select("SELECT * FROM (
            SELECT kerjasamas.id, kerjasamas.nama_kerja_sama, mou.nomor_file AS 'nomor_mou', mou.file AS 'file_mou', kerjasamas.bidang, kerjasamas.tanggal_mulai, kerjasamas.tanggal_sampai, kerjasamas.kategori_id, kategoris.nama_kategori, statuses.nama_status, usulans.usulan, kerjasamas.created_at, kerjasamas.updated_at
            FROM kerjasamas
            LEFT JOIN (SELECT * FROM bukti_kerjasamas WHERE jenis_file = 'M') AS mou ON mou.kerjasama_id = kerjasamas.id
            JOIN kategoris ON kategoris.id = kerjasamas.kategori_id
            JOIN statuses ON statuses.id = kerjasamas.status_id
            JOIN usulans ON usulans.id = kerjasamas.usulan_id
        ) AS c
        ORDER BY c.id");

        if (isset($_GET['filter_tanggal_mulai']) && isset($_GET['filter_tanggal_sampai'])) {
            $tanggal_mulai = ($_GET['filter_tanggal_mulai']);
            $tanggal_sampai = ($_GET['filter_tanggal_sampai']);

            $kerjasamas = DB::select("SELECT * FROM (
                SELECT kerjasamas.id, kerjasamas.nama_kerja_sama, mou.nomor_file AS 'nomor_mou', mou.file AS 'file_mou', kerjasamas.bidang, kerjasamas.tanggal_mulai, kerjasamas.tanggal_sampai, kerjasamas.kategori_id, kategoris.nama_kategori, statuses.nama_status, usulans.usulan, kerjasamas.created_at, kerjasamas.updated_at
                FROM kerjasamas
                LEFT JOIN (SELECT * FROM bukti_kerjasamas WHERE jenis_file = 'M') AS mou ON mou.kerjasama_id = kerjasamas.id
                JOIN kategoris ON kategoris.id = kerjasamas.kategori_id
                JOIN statuses ON statuses.id = kerjasamas.status_id
                JOIN usulans ON usulans.id = kerjasamas.usulan_id
            ) AS c
            WHERE c.tanggal_mulai >= '$tanggal_mulai' AND c.tanggal_sampai <= '$tanggal_sampai'
            ORDER BY c.id");
        } else {
            $tanggal_mulai = date('Y-m-d');
            $tanggal_sampai = date('Y-m-d');
        }

        return view('kerjasama.index')
            ->with('kerjasamas', $kerjasamas)
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
        $kategoris = Kategori::All();
        $statuses = Status::All();
        $kerjasamas = Kerjasama::All();
        $usulans = Usulan::All()->where('hasil_penjajakan', 'L');

        //Digunakan untuk return redirect()-route() di function store
        $type = $request->type;

        return view('kerjasama.create')
            ->with('kategoris', $kategoris)
            ->with('statuses', $statuses)
            ->with('kerjasamas', $kerjasamas)
            ->with('usulans', $usulans)
            ->with('type', $type);
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
            $validateData = $request->validate([
                'nama_kerja_sama' => 'required',
                'tanggal_mulai' => 'required',
                'tanggal_sampai' => 'required|date|date_format:Y-m-d|after:tanggal_mulai',
                'nama_kategori' => 'required',
                'nama_status' => 'required',
                'usulan' => 'required',
                'bidang' => 'required',
            ]);

            $kerjasama = new Kerjasama();


            $kerjasama->nama_kerja_sama = $validateData['nama_kerja_sama'];
            $kerjasama->bidang = $validateData['bidang'];
            $kerjasama->tanggal_mulai = $validateData['tanggal_mulai'];
            $kerjasama->tanggal_sampai = $validateData['tanggal_sampai'];
            $kerjasama->kategori_id = $validateData['nama_kategori'];
            $kerjasama->status_id = $validateData['nama_status'];
            $kerjasama->usulan_id = $validateData['usulan'];

            $kerjasama->save();

            $request->session()->flash('pesan', 'Penambahan data berhasil');
            if ($request->type == 1) {
                return redirect()->route('kerjasama_tanpa_kegiatans.index');
            } elseif ($request->type == 2) {
                return redirect()->route('kerjasama_tanpa_mous.index');
            } else {
                return redirect()->route('kerjasamas.index');
            }
        }


        // Input kegiatan baru melalui kerjasama show
        else {
            $validateData = $request->validate([
                'tanggal_mulai' => 'required',
                'tanggal_sampai' => 'required|date|date_format:Y-m-d|after:tanggal_mulai',
                'bentuk_kegiatan' => 'required',
                // 'PIC' => 'required',
                'kerjasama_id' => 'required',
                'pic_dosen' => 'required',
                'keterangan' => 'required',
                'spk' => 'required',
            ]);

            $kegiatan = new Kegiatan();

            $kegiatan->tanggal_mulai = $validateData['tanggal_mulai'];
            $kegiatan->tanggal_sampai = $validateData['tanggal_sampai'];
            $kegiatan->bentuk_kegiatan_id = $validateData['bentuk_kegiatan'];
            // $kegiatan->PIC = $validateData['PIC'];
            $kegiatan->kerjasama_id = $validateData['kerjasama_id'];
            $kegiatan->user_id = $validateData['pic_dosen'];
            $kegiatan->keterangan = $validateData['keterangan'];
            $kegiatan->bukti_kerjasama_spk_id = $validateData['spk'];

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
        $buktiKerjasama = DB::select("SELECT bukti_kerjasamas.id, bukti_kerjasamas.nama_file, bukti_kerjasamas.nomor_file, bukti_kerjasamas.jenis_file, bukti_kerjasamas.file, bukti_kerjasamas.kerjasama_id, kategori_mous.nama_kategori, LEFT(bukti_kerjasamas.created_at, 10) AS 'tanggal_upload'
        FROM bukti_kerjasamas
        JOIN kerjasamas ON bukti_kerjasamas.kerjasama_id = kerjasamas.id
        LEFT JOIN kategori_mous ON bukti_kerjasamas.kategori_mou_id = kategori_mous.id
        WHERE bukti_kerjasamas.kerjasama_id = $kerjasama->id");

        $users = DB::select("SELECT b.id, b.kode_dosen, b.name
        FROM users b 
        WHERE b.kode_dosen NOT IN ( 
            SELECT DISTINCT users.kode_dosen 
            FROM users 
            LEFT JOIN kegiatans ON kegiatans.user_id = users.id 
            LEFT JOIN bukti_kegiatans ON bukti_kegiatans.kegiatans_id = kegiatans.id 
            WHERE (kegiatans.bentuk_kegiatan_id IS NOT NULL AND bukti_kegiatans.nama_bukti_kegiatan IS NULL) 
            ORDER BY users.id )");

        $kegiatans = Kegiatan::all();
        $bentukKegiatans = BentukKegiatan::all();
        $kategoriMous = KategoriMou::all();

        $SPK = DB::select("SELECT * FROM bukti_kerjasamas
        WHERE jenis_file = 'S' AND kerjasama_id = $kerjasama->id");

        return view('kerjasama.show')
            ->with('kerjasama', $kerjasama)
            ->with('buktiKerjasama', $buktiKerjasama)
            ->with('users', $users)
            ->with('bentukKegiatans', $bentukKegiatans)
            ->with('kegiatans', $kegiatans)
            ->with('SPK', $SPK)
            ->with('kategoriMous', $kategoriMous);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kerjasama  $kerjasama
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Kerjasama $kerjasama)
    {
        //

        $this->authorize('viewAny', User::class);
        $kategoris = Kategori::All();
        $statuses = Status::All();
        $usulans = Usulan::All()->where('hasil_penjajakan', 'L');
        $type = $request->type;

        return view('kerjasama.edit')
            ->with('kerjasama', $kerjasama)
            ->with('kategoris', $kategoris)
            ->with('statuses', $statuses)
            ->with('usulans', $usulans)
            ->with('type', $type);
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
        $this->validate($request, [
            'nama_kerja_sama' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_sampai' => 'required|date|date_format:Y-m-d|after:tanggal_mulai',
            'nama_kategori' => 'required',
            'nama_status' => 'required',
            'usulan' => 'required',
            'bidang' => 'required',
            //digunakan untuk return redirect()->route()
            'type' => '',
        ]);

        $kerjasama = Kerjasama::findOrFail($kerjasama->id);

        $kerjasama->update([
            'nama_kerja_sama' => $request->nama_kerja_sama,
            'bidang' => $request->bidang,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_sampai' => $request->tanggal_sampai,
            'kategori_id' => $request->nama_kategori,
            'status_id' => $request->nama_status,
            'usulan_id' => $request->usulan,
        ]);

        $request->session()->flash('pesan', 'Perubahan data berhasil');
        if ($request->type == 1) {
            return redirect()->route('kerjasama_tanpa_kegiatans.index');
        } elseif ($request->type == 2) {
            return redirect()->route('kerjasama_tanpa_mous.index');
        } else {
            return redirect()->route('kerjasamas.index');
        }
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

        try {
            $kerjasama->delete();
            $getBuktiKerjasama = DB::select("SELECT * FROM bukti_kerjasamas WHERE kerjasama_id = $kerjasama->id");

            // unlink semua file sekaligus
            if (count($getBuktiKerjasama) > 0) {
                for ($i = 0; $i < count($getBuktiKerjasama); $i++) {
                    unlink(storage_path('app/public/kerjasama/' . $getBuktiKerjasama[$i]->file));
                }
            }
            return redirect()->back()->with('pesan', "Hapus data $kerjasama->nama_kerja_sama berhasil");
        } catch (\Throwable $th) {
            return redirect()->back()->with('pesan_error', "Gagal Menghapus data $kerjasama->nama_kerja_sama");
        }
    }

    // Delete from usulan show.blade.php
    public function customDestroy($id_kerjasama)
    {
        $this->authorize('adminOnly', User::class);

        try {
            $kerjasama = Kerjasama::findOrFail($id_kerjasama);
            $kerjasama->delete();

            $getBuktiKerjasama = DB::select("SELECT * FROM bukti_kerjasamas WHERE kerjasama_id = $kerjasama->id");

            // unlink semua file sekaligus
            if (count($getBuktiKerjasama) > 0) {
                for ($i = 0; $i < count($getBuktiKerjasama); $i++) {
                    unlink(storage_path('app/public/kerjasama/' . $getBuktiKerjasama[$i]->file));
                }
            }

            return redirect()->back()->with('pesan', "Hapus data kerjasama $kerjasama->nama_kerja_sama berhasil");
        } catch (\Throwable $th) {
            return redirect()->back()->with('pesan_error', "Gagal Menghapus data kerjasama $kerjasama->nama_kerja_sama");
        }
    }

    public function arsip()
    {
        //
        $kerjasamas = DB::select("SELECT * FROM (
            SELECT kerjasamas.id, kerjasamas.nama_kerja_sama, mou.nomor_file AS 'nomor_mou', mou.file AS 'file_mou', kategori_mous.nama_kategori AS 'kategori_mou', kerjasamas.bidang, kerjasamas.tanggal_mulai, kerjasamas.tanggal_sampai, kerjasamas.kategori_id, kategoris.nama_kategori, statuses.nama_status, usulans.usulan, spk.nomor_file AS 'nomor_spk', spk.file AS 'file_spk', kegiatans.tanggal_mulai AS 'tanggal_mulai_spk', kegiatans.tanggal_sampai AS 'tanggal_sampai_spk'
            FROM kerjasamas 
            LEFT JOIN (SELECT * FROM bukti_kerjasamas WHERE jenis_file = 'M') AS mou ON mou.kerjasama_id = kerjasamas.id 
            LEFT JOIN (SELECT * FROM bukti_kerjasamas WHERE jenis_file = 'S') AS spk ON spk.kerjasama_id = kerjasamas.id 
            LEFT JOIN kategori_mous ON mou.kategori_mou_id = kategori_mous.id
            LEFT JOIN kegiatans ON kegiatans.kerjasama_id = kerjasamas.id
            JOIN kategoris ON kategoris.id = kerjasamas.kategori_id 
            JOIN statuses ON statuses.id = kerjasamas.status_id 
            JOIN usulans ON usulans.id = kerjasamas.usulan_id
        ) AS c
        ORDER BY c.id");

        $kategoriMous = KategoriMou::all();
        $filterKategoriMou = $kategoriMous->first()->id;

        if (isset($_GET['filter_berdasarkan_kategori_mou'])) {
            $filterKategoriMou = ($_GET['filter_berdasarkan_kategori_mou']);

            $kerjasamas = DB::select("SELECT * FROM (
                SELECT kerjasamas.id, kerjasamas.nama_kerja_sama, mou.nomor_file AS 'nomor_mou', mou.file AS 'file_mou', mou.kategori_mou_id AS 'id_kategori_mou', kategori_mous.nama_kategori AS 'kategori_mou', kerjasamas.bidang, kerjasamas.tanggal_mulai, kerjasamas.tanggal_sampai, kerjasamas.kategori_id, kategoris.nama_kategori, statuses.nama_status, usulans.usulan, spk.nomor_file AS 'nomor_spk', spk.file AS 'file_spk', kegiatans.tanggal_mulai AS 'tanggal_mulai_spk', kegiatans.tanggal_sampai AS 'tanggal_sampai_spk'
                FROM kerjasamas 
                LEFT JOIN (SELECT * FROM bukti_kerjasamas WHERE jenis_file = 'M') AS mou ON mou.kerjasama_id = kerjasamas.id 
                LEFT JOIN (SELECT * FROM bukti_kerjasamas WHERE jenis_file = 'S') AS spk ON spk.kerjasama_id = kerjasamas.id 
                LEFT JOIN kategori_mous ON mou.kategori_mou_id = kategori_mous.id
                LEFT JOIN kegiatans ON kegiatans.kerjasama_id = kerjasamas.id
                JOIN kategoris ON kategoris.id = kerjasamas.kategori_id 
                JOIN statuses ON statuses.id = kerjasamas.status_id 
                JOIN usulans ON usulans.id = kerjasamas.usulan_id
            ) AS c
            WHERE c.id_kategori_mou = $filterKategoriMou
            ORDER BY c.id");
        }

        return view('kerjasama.arsip')
            ->with('kerjasamas', $kerjasamas)
            ->with('kategoriMous', $kategoriMous)
            ->with('filterKategoriMou', $filterKategoriMou);
    }
}
