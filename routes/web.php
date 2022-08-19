<?php

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
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;

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

Route::delete('kegiatans/customDestroyKegiatan/{id_kegiatan}', [App\Http\Controllers\KegiatanController::class, 'customDestroy'])->name('customDestroyKegiatan')->middleware(['auth']);

Route::delete('kerjasamas/customDestroyKerjasama/{id_kerjasama}', [App\Http\Controllers\KerjasamaController::class, 'customDestroy'])->name('customDestroyKerjasama')->middleware(['auth']);

Route::resource('mitras', MitraController::class)->middleware(['auth']);
Route::resource('dosens', DosenController::class)->middleware(['auth']);
Route::resource('kegiatans', KegiatanController::class)->middleware(['auth']);
Route::resource('kerjasamas', KerjasamaController::class)->middleware(['auth']);
Route::resource('units', UnitController::class)->middleware(['auth']);
Route::resource('usulans', UsulanController::class)->middleware(['auth']);
Route::resource('statuses', StatusController::class)->middleware(['auth']);
Route::resource('kategoris', KategoriController::class)->middleware(['auth']);
Route::resource('users', UserController::class)->middleware(['auth']);
Route::resource('profiles', ProfileController::class)->middleware(['auth']);

Route::resource('buktiKerjasamas', BuktiKerjasamaController::class)->middleware(['auth']);
Route::resource('buktiKegiatans', BuktiKegiatanController::class)->middleware(['auth']);
Route::get('notification_kegiatan', [App\Http\Controllers\NotificationController::class, 'kegiatan'])->middleware(['auth']);
Route::get('notification_kegiatan_belum_ada_bukti', [App\Http\Controllers\NotificationController::class, 'kegiatanPerluBukti'])->middleware(['auth']);


// Route::get('/mahasiswa/create', [MahasiswaController::class, 'create']);

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
