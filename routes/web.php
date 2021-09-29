<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MonitoringController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [AuthController::class, 'index']);
Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/home', [MonitoringController::class, 'index']);
Route::get('/download', [MonitoringController::class, 'download']);
Route::post('/dataPetugas', [MonitoringController::class, 'getPetugasbykab'])->name('datapetugas');
Route::post('/dataBackup', [MonitoringController::class, 'getFile'])->name('databackup');
