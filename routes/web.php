<?php

use App\Http\Controllers\BentukKegiatanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KerjasamaController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UsulanController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BuktiKerjasamaController;
use App\Http\Controllers\BuktiKegiatanController;
use App\Http\Controllers\BuktiKerjasama2Controller;
use App\Http\Controllers\KategoriMouController;
use App\Http\Controllers\KegiatanBerdasarkanMitraController;
use App\Http\Controllers\KerjasamaTanpaKegiatanController;
use App\Http\Controllers\KerjasamaBerdasarkanMitraController;
use App\Http\Controllers\KerjasamaTanpaMouController;
use App\Http\Controllers\KlasifikasiMitraController;
use App\Http\Controllers\NegaraController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SemuaBuktiKegiatanController;
use App\Models\BuktiKerjasama;
use App\Models\Kerjasama;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Route::group(['middleware' => 'prevent-back-history'], function () {
//     Auth::routes();
// });

// custom delete route
Route::delete('kegiatans/customDestroyKegiatan/{id_kegiatan}', [App\Http\Controllers\KegiatanController::class, 'customDestroy'])->name('customDestroyKegiatan')->middleware(['auth', 'prevent-back-history']); //route untuk melakukan delete data kegiatan melalui show kerjasama

// Route::get();

Route::delete('kerjasamas/customDestroyKerjasama/{id_kerjasama}', [App\Http\Controllers\KerjasamaController::class, 'customDestroy'])->name('customDestroyKerjasama')->middleware(['auth', 'prevent-back-history']); //route untuk melakukan delete data kerjasama melalui usulan show blade

Route::resource('mitras', MitraController::class)->middleware(['auth', 'prevent-back-history']);
Route::resource('dosens', DosenController::class)->middleware(['auth', 'prevent-back-history']);
Route::resource('kegiatans', KegiatanController::class)->middleware(['auth', 'prevent-back-history']);
Route::resource('kerjasamas', KerjasamaController::class)->middleware(['auth', 'prevent-back-history']);
Route::resource('units', UnitController::class)->middleware(['auth', 'prevent-back-history']);
Route::resource('usulans', UsulanController::class)->middleware(['auth', 'prevent-back-history']);
Route::resource('statuses', StatusController::class)->middleware(['auth', 'prevent-back-history']);
Route::resource('kategoris', KategoriController::class)->middleware(['auth', 'prevent-back-history']);
Route::resource('users', UserController::class)->middleware(['auth', 'prevent-back-history']);
Route::resource('profiles', ProfileController::class)->middleware(['auth', 'prevent-back-history']);
Route::resource('kategori_mous', KategoriMouController::class)->middleware(['auth', 'prevent-back-history']);
Route::get('/arsip_kerjasamas', [App\Http\Controllers\KerjasamaController::class, 'arsip'])->name('arsip_kerjasamas')->middleware(['auth', 'prevent-back-history']);


// other route
Route::resource('buktiKerjasamas', BuktiKerjasamaController::class)->middleware(['auth', 'prevent-back-history']); //route yang mengarah untuk memperlihatkan bukti kerjasama
Route::resource('buktiKegiatans', BuktiKegiatanController::class)->middleware(['auth', 'prevent-back-history']); //route yang mengarah untuk memperlihatkan bukti kegiatan
Route::resource('bentuk_kegiatans', BentukKegiatanController::class)->middleware(['auth', 'prevent-back-history']); //bentuk kegiatan
Route::resource('negaras', NegaraController::class)->middleware(['auth', 'prevent-back-history']); //negara
Route::resource('klasifikasi_mitras', KlasifikasiMitraController::class)->middleware(['auth', 'prevent-back-history']); //negara
Route::resource('kerjasama_dengan_mous', KerjasamaTanpaKegiatanController::class)->middleware(['auth', 'prevent-back-history']); //route untuk mengarah ke kerjasama yang tidak memiliki kegiatan
Route::resource('kerjasama_tanpa_mous', KerjasamaTanpaMouController::class)->middleware(['auth', 'prevent-back-history']); //route untuk mengarah ke kerjasama yang tidak memiliki kegiatan
Route::resource('kegiatan_berdasarkan_mitras', KegiatanBerdasarkanMitraController::class)->middleware(['auth', 'prevent-back-history']); //notifikasi kegaitan terbaru
Route::resource('semua_laporan_kegiatans', SemuaBuktiKegiatanController::class)->middleware(['auth', 'prevent-back-history']); //notifikasi kegaitan terbaru
Route::get('/reminder', [App\Http\Controllers\ReminderController::class, 'index'])->name('reminder');


// route notifikasi
Route::get('notification_kegiatans', [App\Http\Controllers\NotificationController::class, 'kegiatan'])->middleware(['auth', 'prevent-back-history']); //notifikasi kegaitan terbaru
Route::get('notification_kegiatan_belum_ada_buktis', [App\Http\Controllers\NotificationController::class, 'kegiatanPerluBukti'])->middleware(['auth', 'prevent-back-history']); //notifikasi kegiatan yang tidak memiliki bukti kegiatan

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard')->middleware(['prevent-back-history']);

Route::get('/kegiatans/create/{id_kerjasama}', function ($id_kerjasama) {
    $data = Kerjasama::find($id_kerjasama);
    // $SPK = BuktiKerjasama::where('kerjasama_id', $id_kerjasama);
    $SPK = DB::select("SELECT bukti_kerjasamas.* 
    FROM bukti_kerjasamas
    JOIN kerjasamas ON kerjasamas.id = bukti_kerjasamas.kerjasama_id
    WHERE jenis_file = 'S' AND kerjasama_id = $id_kerjasama");

    if (isset($data->id)) {
        $val = [
            'id' => $data->id,
            'name' => $data->nama_kerja_sama,
        ];
        // $SPK1 = [
        //     'id_spk' => $SPK->id,
        //     'name' => $SPK->nama_file,
        //     'jenis' => $SPK->jenis_file,
        // ];
        $response = [
            'success' => true,
            'message' => "Kerjasama ditemukan",
            'data' => $val,
            'spk' => $SPK,
        ];
    } else {
        $response = [
            'success' => false,
            'message' => "Kerjasama tidak ditemukan"
        ];
    }
    return response()->json($response);
});

Route::get('/kegiatans/edit/{id_kerjasama}', function ($id_kerjasama) {
    $data = Kerjasama::find($id_kerjasama);
    // $SPK = BuktiKerjasama::where('kerjasama_id', $id_kerjasama);
    $SPK = DB::select("SELECT bukti_kerjasamas.* 
    FROM bukti_kerjasamas
    JOIN kerjasamas ON kerjasamas.id = bukti_kerjasamas.kerjasama_id
    WHERE jenis_file = 'S' AND kerjasama_id = $id_kerjasama");

    if (isset($data->id)) {
        $val = [
            'id' => $data->id,
            'name' => $data->nama_kerja_sama,
        ];
        // $SPK1 = [
        //     'id_spk' => $SPK->id,
        //     'name' => $SPK->nama_file,
        //     'jenis' => $SPK->jenis_file,
        // ];
        $response = [
            'success' => true,
            'message' => "Kerjasama ditemukan",
            'data' => $val,
            'spk' => $SPK,
        ];
    } else {
        $response = [
            'success' => false,
            'message' => "Kerjasama tidak ditemukan"
        ];
    }
    return response()->json($response);
});
