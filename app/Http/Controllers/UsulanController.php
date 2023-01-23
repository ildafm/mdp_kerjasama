<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Kerjasama;
use App\Models\Usulan;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mitra;
use App\Models\Status;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UsulanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $usulans = Usulan::All();

        return view('usulan.index')
            ->with('usulans', $usulans);
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
        $mitras = Mitra::All();
        $units  = Unit::All();

        return view('usulan.create')
            ->with('users', $users)
            ->with('mitras', $mitras)
            ->with('units', $units);
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
        // simpan usulan
        if ($request->usulan != '' || $request->usulan != null) {
            $validateData = $request->validate([
                'usulan' => 'required',
                'bentuk_kerjasama' => 'required',
                'kontak_kerjasama' => 'required|max:15',
                'rencana_kegiatan' => 'required',
                'nama_mitra' => 'required',
                'nama_pengusul' => 'required',
                'nama_unit' => 'required',
                'type' => 'required',
            ]);

            $usulan = new Usulan();
            $usulan->usulan = $validateData['usulan'];
            $usulan->bentuk_kerjasama = $validateData['bentuk_kerjasama'];
            $usulan->kontak_kerjasama = $validateData['kontak_kerjasama'];
            $usulan->rencana_kegiatan = $validateData['rencana_kegiatan'];
            $usulan->type = $validateData['type'];
            $usulan->mitra_id = $validateData['nama_mitra'];
            $usulan->user_id = $validateData['nama_pengusul'];
            $usulan->unit_id = $validateData['nama_unit'];

            $usulan->save();

            // Send email to admin
            $findAdmin = DB::select("SELECT users.id, users.kode_dosen, users.name AS 'name', users.email, users.level 
            FROM users
            WHERE users.level = 'A'");
            $nowHourQuerry = DB::select("SELECT Hour(Now()) as 'jam_sekarang'");

            $nowHour = $nowHourQuerry[0]->jam_sekarang;
            if ($nowHour <= 10) {
                $salam = 'Selamat pagi';
            } elseif ($nowHour <= 14) {
                $salam = 'Selamat siang';
            } elseif ($nowHour <= 18) {
                $salam = 'Selamat sore';
            } elseif ($nowHour < 24) {
                $salam = 'Selamat malam';
            }
            $nama_usulan = $validateData['usulan'];
            $bentuk_kerjasama = $validateData['bentuk_kerjasama'];
            $kontak_kerjasama = $validateData['kontak_kerjasama'];

            $pengusul_id = $validateData['nama_pengusul'];
            $findPengusul = DB::select("SELECT users.id, users.kode_dosen, users.name AS 'name' , users.email, users.level
            FROM users
            WHERE users.id = $pengusul_id");

            $id_usulan = $usulan->id; //get id usulan for send emails            
            for ($i = 0; $i < count($findAdmin); $i++) {
                $details = [
                    'title' => 'Usulan Baru',
                    'admin_name' => $findAdmin[$i]->name,
                    'salam' => $salam,
                    'usulan' => $nama_usulan,
                    'bentuk_kerjasama' => $bentuk_kerjasama,
                    'nama_pengusul' => $findPengusul[0]->name,
                    'kontak_kerjasama' => $kontak_kerjasama,
                    'id_usulan' => $id_usulan,
                ];
                Mail::to($findAdmin[$i]->email)->send(new \App\Mail\newUsulanMail($details));
            }

            $request->session()->flash('pesan', 'Penambahan data berhasil');
            return redirect()->route('usulans.index');
        }
        // simpan kerjasama
        else {
            $validateData = $request->validate([
                'nama_kerja_sama' => 'required',
                'tanggal_mulai' => 'required',
                'tanggal_sampai' => 'required|date|date_format:Y-m-d|after:tanggal_mulai',
                'nama_kategori' => 'required',
                'nama_status' => 'required',
                'usulan_id' => 'required',
            ]);

            $kerjasama = new Kerjasama();

            $kerjasama->nama_kerja_sama = $validateData['nama_kerja_sama'];
            $kerjasama->tanggal_mulai = $validateData['tanggal_mulai'];
            $kerjasama->tanggal_sampai = $validateData['tanggal_sampai'];
            $kerjasama->kategori_id = $validateData['nama_kategori'];
            $kerjasama->status_id = $validateData['nama_status'];
            $kerjasama->usulan_id = $validateData['usulan_id'];

            $kerjasama->save();

            $request->session()->flash('pesan', 'Penambahan data berhasil');
            return redirect()->route('usulans.show', $kerjasama->usulan_id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usulan  $usulan
     * @return \Illuminate\Http\Response
     */
    public function show(Usulan $usulan)
    {
        //
        $getKerjasama = DB::select("SELECT * FROM (
            SELECT kerjasamas.id AS 'id_kerjasama', kerjasamas.nama_kerja_sama, mou.nomor_file AS 'no_mou', mou.file AS 'file_mou', kategori_mous.nama_kategori AS 'kategori_mou', kerjasamas.bidang, kerjasamas.tanggal_mulai, kerjasamas.tanggal_sampai, kerjasamas.kategori_id, kategoris.nama_kategori, statuses.nama_status
            FROM kerjasamas 
            LEFT JOIN (SELECT * FROM bukti_kerjasamas WHERE jenis_file = 'M') AS mou ON mou.kerjasama_id = kerjasamas.id 
            LEFT JOIN kategori_mous ON mou.kategori_mou_id = kategori_mous.id
            JOIN kategoris ON kategoris.id = kerjasamas.kategori_id 
            JOIN statuses ON statuses.id = kerjasamas.status_id 
            JOIN usulans ON usulans.id = kerjasamas.usulan_id
            WHERE kerjasamas.usulan_id = $usulan->id
        ) AS c
        ORDER BY c.id_kerjasama");

        $kategoris = Kategori::All();
        $statuses = Status::All();
        $kerjasamas = Kerjasama::All();

        return view('usulan.show')
            ->with('usulan', $usulan)
            ->with('kategoris', $kategoris)
            ->with('statuses', $statuses)
            ->with('kerjasamas', $kerjasamas)
            ->with('getKerjasama', $getKerjasama);;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usulan  $usulan
     * @return \Illuminate\Http\Response
     */
    public function edit(Usulan $usulan)
    {
        //

        $this->authorize('viewAny', User::class);

        $mitras = Mitra::All();
        $units  = Unit::All();
        $users = User::All();

        return view('usulan.edit')
            ->with('mitras', $mitras)
            ->with('units', $units)
            ->with('usulans', $usulan)
            ->with('users', $users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usulan  $usulan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usulan $usulan)
    {
        //
        $this->authorize('viewAny', User::class);

        $this->validate($request, [
            'usulan' => 'required',
            'bentuk_kerjasama' => 'required',
            'kontak_kerjasama' => 'required|max:15',
            'rencana_kegiatan' => 'required',
            'nama_mitra' => 'required',
            'nama_pengusul' => 'required',
            'nama_unit' => 'required',
            'hasil_penjajakan' => 'required',
            'type' => 'required',
        ]);

        if ($request->hasil_penjajakan != 'B') {
            $this->validate($request, [
                'keterangan_hasil_penjajakan' => 'required',
            ]);
        }

        $usulan = Usulan::findOrFail($usulan->id);

        $usulan->update([
            'usulan' => $request->usulan,
            'bentuk_kerjasama' => $request->bentuk_kerjasama,
            'kontak_kerjasama' => $request->kontak_kerjasama,
            'rencana_kegiatan' => $request->rencana_kegiatan,
            'mitra_id' => $request->nama_mitra,
            'user_id' => $request->nama_pengusul,
            'unit_id' => $request->nama_unit,
            'hasil_penjajakan' => $request->hasil_penjajakan,
            'keterangan' => $request->keterangan_hasil_penjajakan,
            'type' => $request->type,
        ]);

        $request->session()->flash('pesan', 'Perubahan data berhasil');
        return redirect()->route('usulans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usulan  $usulan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usulan $usulan)
    {
        //
        $this->authorize('viewAny', User::class);

        try {
            $usulan->delete();
            return redirect()->route('usulans.index')->with('pesan', "Hapus data usulan $usulan->usulan berhasil");
        } catch (\Throwable $th) {
            return redirect()->back()->with('pesan_error', "Gagal menghapus data");
        }
    }
}
