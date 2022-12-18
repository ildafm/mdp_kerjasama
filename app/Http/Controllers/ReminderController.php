<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ReminderController extends Controller
{
    //
    //controller ini digunakan hanya untuk button send reminder yang hanya bisa digunakan oleh level Admin
    public function index(Request $request)
    {
        // Send email to user
        // $findUsers = User::findOrFail($kegiatan->user_id);
        // $tanggalMulaiKegiatan = $validateData['tanggal_mulai'];
        // $tanggalSampaiKegiatan = $validateData['tanggal_sampai'];
        // $id_kegiatan = $kegiatan->id; //get id kegiatan for send email

        // $details = [
        //     'title' => 'Kegiatan Baru',
        //     'user_name' => $findUser->name,
        //     'tanggal_mulai' => $tanggalMulaiKegiatan,
        //     'tanggal_sampai' => $tanggalSampaiKegiatan,
        //     'id_kegiatan' => $id_kegiatan,
        // ];

        // Mail::to($findUser->email)->send(new \App\Mail\Reminder30DaysMail($details));

        // $request->session()->flash('pesan', 'Penambahan data berhasil');
        // return redirect()->route('kegiatans.index');

        $getDataForReminder = DB::select("SELECT kegiatans.id, kegiatans.tanggal_mulai, kegiatans.tanggal_sampai, users.name AS 'name', users.email, bukti_kegiatans.nama_bukti_kegiatan
        FROM kegiatans
        JOIN users ON users.id = user_id
        LEFT JOIN bukti_kegiatans ON bukti_kegiatans.kegiatans_id = kegiatans.id
        WHERE bukti_kegiatans.nama_bukti_kegiatan IS NULL AND (kegiatans.tanggal_sampai - DATE(NOW()) <= -30)");
        if (count($getDataForReminder) > 0) {
            for ($i = 0; $i < count($getDataForReminder); $i++) {
                $details = [
                    'title' => 'Reminder',
                    'user_name' => $getDataForReminder[$i]->name,
                    'id_kegiatan' => $getDataForReminder[$i]->id,
                ];
                Mail::to($getDataForReminder[$i]->email)->send(new \App\Mail\Reminder30DaysMail($details));
            }

            $toastr = array(
                'info' => 'Pengiriman Reminder berhasil',
                'alert-type' => 'success'
            );
            // $request->session()->flash('pesan', 'Pengiriman Reminder berhasil');
            return redirect()->back()->with($toastr);
        }
    }
}
