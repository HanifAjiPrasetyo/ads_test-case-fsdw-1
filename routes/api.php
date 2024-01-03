<?php

use Illuminate\Support\Facades\Route;
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

Route::middleware('auth:sanctum')->group(function () {
    // Daftar karyawan yang saat ini pernah mengambil cuti
    Route::get('/karyawan/cuti', [KaryawanController::class, 'karyawanCuti']);

    // Sisa cuti setiap karyawan
    Route::get('/karyawan/sisa-cuti', [KaryawanController::class, 'sisaCuti']);
});
