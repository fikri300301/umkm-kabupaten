<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BidangController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\ProkerController;
use App\Http\Controllers\BantuanController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RoleAndPermission;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\PerizinanController;

use App\Http\Controllers\CategoryPelatihanController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/account', [UserController::class, 'account'])->middleware(['auth'])->name('account');
Route::post('/account-update', [UserController::class, 'update'])->middleware(['auth'])->name('update-profile-account');
Route::post('/account-password', [UserController::class, 'updatePassword'])->middleware(['auth'])->name('update-password-account');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'penggunaRestrict'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    //manage umkm
    Route::middleware(['role_or_permission:super-admin|create-umkm'])->name('create-')->group(function () {
        Route::get('/create-umkm', [UmkmController::class, 'createDashboard'])->name('umkm');
    });

    Route::middleware(['role_or_permission:super-admin|store-umkm'])->name('store-')->group(function () {
        Route::post('/dashboard/store-umkm', [UmkmController::class, 'storeDashboard'])->name('umkm');
    });


    Route::middleware(['role_or_permission:super-admin|full-umkm'])->name('full-')->group(function () {
        Route::get('/full-umkm', [UmkmController::class, 'fullView'])->name('umkm');
    });

    Route::middleware(['role_or_permission:super-admin|export-umkm'])->name('export-')->group(function () {
        Route::get('/full-umkm/export/excel', [UmkmController::class, 'export_excel'])->name('umkm');
    });


    Route::middleware(['role_or_permission:super-admin|edit-umkm'])->name('edit-')->group(function () {
        Route::get('/dashboard/edit-umkm/{slug_umkm}', [UmkmController::class, 'editDashboard'])->name('umkm');
    });

    Route::middleware(['role_or_permission:super-admin|update-umkm'])->name('update-')->group(function () {
        Route::post('/dashboard/update-umkm/{slug_umkm}', [UmkmController::class, 'updateDashboard'])->name('umkm');
    });


    //manage kecamatan 
    Route::middleware(['role_or_permission:super-admin|show-kecamatan'])->name('manage-')->group(function () {
        Route::get('/manage-kecamatan', [KecamatanController::class, 'index'])->name('kecamatan');
    });

    //manage desa

    Route::middleware(['role_or_permission:super-admin|show-desa'])->name('manage-')->group(function () {
        Route::get('/manage-desa', [DesaController::class, 'index'])->name('desa');
    });

    // category
    Route::middleware(['role_or_permission:super-admin|show-category'])->name('manage-')->group(function () {
        Route::get('/manage-kelas', [CategoryController::class, 'index'])->name('kelas');
    });

    // bidang 
    Route::middleware(['role_or_permission:super-admin|show-bidang'])->name('manage-')->group(function () {
        Route::get('/manage-bidang', [BidangController::class, 'index'])->name('bidang');
    });

    //pelatihan
    Route::middleware(['role_or_permission:super-admin|show-pelatihan'])->name('manage-')->group(function () {
        Route::get('manage-pelatihan', [PelatihanController::class, 'index'])->name('pelatihan');
    });

    Route::middleware(['role_or_permission:super-admin|show-category-pelatihan'])->name('manage-')->group(function () {
        Route::get('/manage-category-pelatihan', [CategoryPelatihanController::class, 'index'])->name('category-pel');
    });

    Route::middleware(['role_or_permission:super-admin|show-peserta'])->name('manage-')->group(function () {
        Route::get('/umkm/pelatihan/{slug_pelatihan}', [PelatihanController::class, 'list'])->name('peserta-pel');
    });

    // Bantuan
    Route::middleware(['role_or_permission:super-admin|show-bantuan'])->name('manage-')->group(function () {
        Route::get('manage-bantuan', [BantuanController::class, 'index'])->name('bantuan');
    });

    Route::middleware(['role_or_permission:super-admin|show-penerima-bantuan'])->name('manage-')->group(function () {
        Route::get('/umkm/bantuan/{slug_bantuan}', [BantuanController::class, 'list'])->name('penerima-ban');
    });


    //perizinan

    Route::middleware(['role_or_permission:super-admin|show-perizinan'])->name('manage-')->group(function () {
        Route::get('manage-perizinan', [PerizinanController::class, 'index'])->name('perizinan');
    });

    Route::middleware(['role_or_permission:super-admin|show-penerima-izin'])->name('manage-')->group(function () {
        Route::get('/umkm/perizinan/{slug_perizinan}', [PerizinanController::class, 'list'])->name('penerima-izin');
    });


    // manage role and permissions
    Route::middleware(['role_or_permission:super-admin|show-permission'])->name('manage-')->group(function () {
        Route::get('/manage-permission', [RoleAndPermission::class, 'indexPermission'])->name('permission');
    });
    Route::middleware(['role_or_permission:super-admin|show-role'])->name('manage-')->group(function () {
        Route::get('/manage-role', [RoleAndPermission::class, 'indexRole'])->name('role');
    });







    //about user
    Route::middleware(['role_or_permission:super-admin|show-user'])->name('manage-')->group(function () {
        Route::get('/manage-users', [UserController::class, 'indexDashboard'])->name('users');
    });
    // Route::middleware(['role_or_permission:super-admin|show-config'])->name('profile-')->group(function () {
    //     Route::get('/profile-bem',[ConfigController::class, 'indexDashboard'])->name('bem');
    // });
    // Route::middleware(['role_or_permission:super-admin|show-config'])->name('update-')->group(function () {
    //     Route::post('/update-bem',[ConfigController::class, 'updateDashboard'])->name('bem');
    // });

    // Route::middleware(['role_or_permission:super-admin|create-config'])->name('create-')->group(function () {
    //     Route::get('/create-bem',[ConfigController::class, 'createDashboard'])->name('bem');
    // });

    // Route::middleware(['role_or_permission:super-admin|store-config'])->name('store-')->group(function () {
    //     Route::post('/store-bem',[ConfigController::class, 'storeDashboard'])->name('bem');
    // });

});