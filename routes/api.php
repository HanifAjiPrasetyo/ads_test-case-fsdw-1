<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\KaryawanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// Login & Register Routes
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'web'])->group(function () {
    // 3 karyawan pertama gabung
    Route::get('/karyawan/first-three-karyawan', [KaryawanController::class, 'firstThreeKaryawan']);

    // Daftar karyawan yang saat ini pernah mengambil cuti
    Route::get('/karyawan/pernah-cuti', [KaryawanController::class, 'karyawanCuti']);

    // Sisa cuti setiap karyawan
    Route::get('/karyawan/sisa-cuti', [KaryawanController::class, 'sisaCuti']);

    // CRUD Karyawan API
    Route::resource('karyawan', KaryawanController::class);

    // CRUD Cuti API
    Route::resource('cuti', CutiController::class);

    // Logout
    Route::get('/logout', [AuthController::class, 'logout']);
});
