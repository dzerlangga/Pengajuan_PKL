<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\SiswaController;
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


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'home']);
	Route::get('dashboard', function () {
		return view('dashboard');
	})->name('dashboard');

    Route::prefix('persuratan')->group(function () {
        Route::get('surat-draft', function () {
            return view('persuratan.draft.index');
        })->name('surat-draft');
        Route::get('surat-diterima', function () {
            return view('persuratan.diterima.index');
        })->name('surat-diterima');
        Route::get('surat-ditolak', function () {
            return view('persuratan.ditolak.index');
        })->name('surat-ditolak');
    });

    Route::prefix('master-data')->group(function () {
        Route::get('jurusan', [JurusanController::class,'index'])->name('jurusan');
        Route::get('perusahaan', function () {
            return view('perusahaan.index');
        })->name('perusahaan');
        Route::get('pengumuman', function () {
            return view('pengumuman.index');
        })->name('pengumuman');
    });

    Route::get('/logout', [SessionsController::class, 'destroy']);
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/pengajuanpkl', [SiswaController::class, 'index']);
    Route::get('/pengajuanpkl/form', [SiswaController::class, 'form'])->name('formPengajuan');
    Route::get('/admin', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);

});

Route::get('/admin', function () {
    return view('session/login-session');
})->name('admin');
