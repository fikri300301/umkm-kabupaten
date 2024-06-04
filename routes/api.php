<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\KecamatanController;
use App\Http\Controllers\Api\PelatihanController;

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

Route::get("/manage-kecamatan", [KecamatanController::class, 'index']);
Route::get("/pelatihan", [PelatihanController::class, 'index']);
Route::get("/pelatihan-satu", [PelatihanController::class, 'index']);