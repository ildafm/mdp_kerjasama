<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KerjasamaController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UsulanController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\BuktiKerjasamaController;
use App\Http\Controllers\BuktiKegiatanController;

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

// Route::get('/dashboard', [DashboardController::class, 'index']);

Route::resource('mitras', MitraController::class);
Route::resource('dosens', DosenController::class);
Route::resource('kegiatans', KegiatanController::class);
Route::resource('kerjasamas', KerjasamaController::class);
Route::resource('units', UnitController::class);
Route::resource('usulans', UsulanController::class);
Route::resource('statuses', StatusController::class);
Route::resource('kategoris', KategoriController::class);
Route::resource('users', UserController::class);

Route::resource('buktiKerjasamas', BuktiKerjasamaController::class);
Route::resource('buktiKegiatans', BuktiKegiatanController::class);

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::get('/reset2', function(){return view('reset2');});
