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
        // Send email to pic
        $getDataForReminder = DB::select("SELECT kegiatans.id, bentuk_kegiatans.bentuk AS 'bentuk_kegiatan', kegiatans.tanggal_mulai, kegiatans.tanggal_sampai, users.name AS 'name', users.email AS 'email_pic', UK.name AS 'nama_kaprodi', UK.email AS 'email_kaprodi', bukti_kegiatans.nama_bukti_kegiatan, users.level AS 'level', usulans.unit_id
        FROM kegiatans 
        JOIN users ON users.id = user_id 
        JOIN kerjasamas ON kerjasamas.id = kegiatans.kerjasama_id 
        JOIN usulans ON usulans.id = kerjasamas.usulan_id 
        JOIN bentuk_kegiatans ON bentuk_kegiatans.id = kegiatans.bentuk_kegiatan_id
        LEFT JOIN bukti_kegiatans ON bukti_kegiatans.kegiatans_id = kegiatans.id 
        LEFT JOIN (SELECT * FROM `users` WHERE level = 'K') AS UK ON UK.unit_id = usulans.unit_id 
        WHERE (bukti_kegiatans.nama_bukti_kegiatan IS NULL AND (DATEDIFF(kegiatans.tanggal_sampai, NOW()) <= -30))");

        if (count($getDataForReminder) > 0) {
            for ($i = 0; $i < count($getDataForReminder); $i++) {
                $details = [
                    'title' => 'Reminder',
                    'pic_name' => $getDataForReminder[$i]->name,
                    'id_kegiatan' => $getDataForReminder[$i]->id,
                    'pic_level' => $getDataForReminder[$i]->level,
                    'id_unit' => $getDataForReminder[$i]->unit_id,
                    'tanggal_mulai' => $getDataForReminder[$i]->tanggal_mulai,
                    'tanggal_sampai' => $getDataForReminder[$i]->tanggal_sampai,
                    'bentuk_kegiatan' => $getDataForReminder[$i]->bentuk_kegiatan,
                    'nama_kaprodi' => $getDataForReminder[$i]->nama_kaprodi,

                ];
                if ($getDataForReminder[$i]->level == 'K') {
                    Mail::to($getDataForReminder[$i]->email_pic)->send(new \App\Mail\Reminder30DaysMail($details));
                } else {
                    Mail::to($getDataForReminder[$i]->email_pic)->send(new \App\Mail\Reminder30DaysMail($details));
                    Mail::to($getDataForReminder[$i]->email_kaprodi)->send(new \App\Mail\Reminder30DaysMailKaprodi($details));
                }
            }

            $toastr = array(
                'info' => 'Pengiriman Reminder berhasil',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($toastr);
        }
    }
}
