<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KerjasamaController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UsulanController;
use App\Http\Controllers\StatusController;

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
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::resource('mitras', MitraController::class);
Route::resource('dosens', DosenController::class);
Route::resource('kegiatans', KegiatanController::class);
Route::resource('kerjasamas', KerjasamaController::class);
Route::resource('units', UnitController::class);
Route::resource('usulans', UsulanController::class);
Route::resource('statuses', StatusController::class);