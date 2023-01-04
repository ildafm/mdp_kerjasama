<?php

namespace App\Http\Controllers;

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
        $getDataForReminder = DB::select("SELECT kegiatans.id
        , bentuk_kegiatans.bentuk AS 'bentuk_kegiatan'
        , kegiatans.tanggal_mulai
        , kegiatans.tanggal_sampai
        , users.name AS 'name'
        , users.email AS 'email_pic'
        , UK.name AS 'nama_kaprodi'
        , UK.email AS 'email_kaprodi'
        , UE.email AS 'email_dekan'
        , UE.name AS 'nama_dekan'
        , UKA.email AS 'email_ka_unit'
        , UKA.name AS 'nama_ka_unit'
        , UA.email AS 'email_admin'
        , UA.name AS 'nama_admin'
        , bukti_kegiatans.nama_bukti_kegiatan
        , users.level AS 'pic_level'
        , usulans.unit_id
        FROM kegiatans 
        JOIN users ON users.id = user_id 
        JOIN kerjasamas ON kerjasamas.id = kegiatans.kerjasama_id 
        JOIN usulans ON usulans.id = kerjasamas.usulan_id 
        JOIN bentuk_kegiatans ON bentuk_kegiatans.id = kegiatans.bentuk_kegiatan_id
        LEFT JOIN bukti_kegiatans ON bukti_kegiatans.kegiatans_id = kegiatans.id 
        LEFT JOIN (SELECT * FROM `users` WHERE level = 'K') AS UK ON UK.unit_id = usulans.unit_id 
        LEFT JOIN (SELECT * FROM `users` WHERE level = 'E') AS UE ON UE.unit_id = usulans.unit_id 
        LEFT JOIN (SELECT * FROM `users` WHERE level = 'U') AS UKA ON UKA.unit_id = usulans.unit_id 
        LEFT JOIN (SELECT * FROM `users` WHERE level = 'A') AS UA ON UA.unit_id = usulans.unit_id
        WHERE (bukti_kegiatans.nama_bukti_kegiatan IS NULL AND (DATEDIFF(kegiatans.tanggal_sampai, NOW()) <= -30))");

        if (count($getDataForReminder) > 0) {
            for ($i = 0; $i < count($getDataForReminder); $i++) {
                $details = [
                    'title' => 'Reminder',
                    'pic_name' => $getDataForReminder[$i]->name,
                    'id_kegiatan' => $getDataForReminder[$i]->id,
                    'pic_level' => $getDataForReminder[$i]->pic_level,
                    'id_unit' => $getDataForReminder[$i]->unit_id,
                    'tanggal_mulai' => $getDataForReminder[$i]->tanggal_mulai,
                    'tanggal_sampai' => $getDataForReminder[$i]->tanggal_sampai,
                    'bentuk_kegiatan' => $getDataForReminder[$i]->bentuk_kegiatan,
                    'nama_kaprodi' => $getDataForReminder[$i]->nama_kaprodi,
                    'nama_dekan' => $getDataForReminder[$i]->nama_dekan,
                    'nama_ka_unit' => $getDataForReminder[$i]->nama_ka_unit,
                    'nama_admin' => $getDataForReminder[$i]->nama_ka_unit,
                ];
                if ($getDataForReminder[$i]->pic_level != 'D') {
                    Mail::to($getDataForReminder[$i]->email_pic)->send(new \App\Mail\Reminder30DaysMail($details));

                    //jika pic adalah kaprodi
                    if ($getDataForReminder[$i]->pic_level == 'K') {
                        if ($getDataForReminder[$i]->nama_dekan != null || $getDataForReminder[$i]->nama_dekan != "") {
                            Mail::to($getDataForReminder[$i]->email_dekan)->send(new \App\Mail\Reminder30DaysMailKaprodi($details));
                        }
                        // kirim ke ka unit
                        elseif ($getDataForReminder[$i]->nama_ka_unit != null || $getDataForReminder[$i]->nama_ka_unit != "") {
                            Mail::to($getDataForReminder[$i]->email_ka_unit)->send(new \App\Mail\Reminder30DaysMailKaprodi($details));
                        }
                        // kirim ke admin
                        elseif ($getDataForReminder[$i]->nama_admin != null || $getDataForReminder[$i]->nama_admin != "") {
                            Mail::to($getDataForReminder[$i]->email_admin)->send(new \App\Mail\Reminder30DaysMailKaprodi($details));
                        }
                    }

                    // jika pic adalah dekan
                    elseif ($getDataForReminder[$i]->pic_level == 'E') {
                        if ($getDataForReminder[$i]->nama_kaprodi != null || $getDataForReminder[$i]->nama_kaprodi != "") {
                            Mail::to($getDataForReminder[$i]->email_kaprodi)->send(new \App\Mail\Reminder30DaysMailKaprodi($details));
                        } elseif ($getDataForReminder[$i]->nama_ka_unit != null || $getDataForReminder[$i]->nama_ka_unit != "") {
                            Mail::to($getDataForReminder[$i]->email_ka_unit)->send(new \App\Mail\Reminder30DaysMailKaprodi($details));
                        } elseif ($getDataForReminder[$i]->nama_admin != null || $getDataForReminder[$i]->nama_admin != "") {
                            Mail::to($getDataForReminder[$i]->email_admin)->send(new \App\Mail\Reminder30DaysMailKaprodi($details));
                        }
                    }

                    // jika pic adalah ka unit
                    elseif ($getDataForReminder[$i]->pic_level == 'U') {
                        if ($getDataForReminder[$i]->nama_kaprodi != null || $getDataForReminder[$i]->nama_kaprodi != "") {
                            Mail::to($getDataForReminder[$i]->email_kaprodi)->send(new \App\Mail\Reminder30DaysMailKaprodi($details));
                        } elseif ($getDataForReminder[$i]->dekan != null || $getDataForReminder[$i]->dekan != "") {
                            Mail::to($getDataForReminder[$i]->email_dekan)->send(new \App\Mail\Reminder30DaysMailKaprodi($details));
                        } elseif ($getDataForReminder[$i]->nama_admin != null || $getDataForReminder[$i]->nama_admin != "") {
                            Mail::to($getDataForReminder[$i]->email_admin)->send(new \App\Mail\Reminder30DaysMailKaprodi($details));
                        }
                    }

                    // jika pic adalah admin
                    elseif ($getDataForReminder[$i]->pic_level == 'A') {
                        if ($getDataForReminder[$i]->nama_kaprodi != null || $getDataForReminder[$i]->nama_kaprodi != "") {
                            Mail::to($getDataForReminder[$i]->email_kaprodi)->send(new \App\Mail\Reminder30DaysMailKaprodi($details));
                        } elseif ($getDataForReminder[$i]->nama_dekan != null || $getDataForReminder[$i]->nama_dekan != "") {
                            Mail::to($getDataForReminder[$i]->email_dekan)->send(new \App\Mail\Reminder30DaysMailKaprodi($details));
                        } elseif ($getDataForReminder[$i]->nama_ka_unit != null || $getDataForReminder[$i]->nama_ka_unit != "") {
                            Mail::to($getDataForReminder[$i]->email_ka_unit)->send(new \App\Mail\Reminder30DaysMailKaprodi($details));
                        }
                    }
                }
                // jika pic adalah dosen
                else {
                    Mail::to($getDataForReminder[$i]->email_pic)->send(new \App\Mail\Reminder30DaysMail($details));

                    // kirim ke kaprodi
                    if ($getDataForReminder[$i]->nama_kaprodi != null || $getDataForReminder[$i]->nama_kaprodi != "") {
                        Mail::to($getDataForReminder[$i]->email_kaprodi)->send(new \App\Mail\Reminder30DaysMailKaprodi($details));
                    }
                    // kirim ke dekan
                    elseif ($getDataForReminder[$i]->nama_dekan != null || $getDataForReminder[$i]->nama_dekan != "") {
                        Mail::to($getDataForReminder[$i]->email_dekan)->send(new \App\Mail\Reminder30DaysMailKaprodi($details));
                    }
                    // kirim ke ka unit
                    elseif ($getDataForReminder[$i]->nama_ka_unit != null || $getDataForReminder[$i]->nama_ka_unit != "") {
                        Mail::to($getDataForReminder[$i]->email_kaprodi)->send(new \App\Mail\Reminder30DaysMailKaprodi($details));
                    }
                    // kirim ke admin
                    elseif ($getDataForReminder[$i]->nama_admin != null || $getDataForReminder[$i]->nama_admin != "") {
                        Mail::to($getDataForReminder[$i]->email_admin)->send(new \App\Mail\Reminder30DaysMailKaprodi($details));
                    }
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
