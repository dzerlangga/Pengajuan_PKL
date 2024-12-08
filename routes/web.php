<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\PdfController;
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
	Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::prefix('persuratan')->group(function () {
        Route::get('{status}', [SuratController::class,'index'])->name('surat');
        Route::get('{status}/edit/{id}', [SuratController::class,'editForm'])->name('surat.edit');
        Route::get('surat-draft/add', [SuratController::class,'addForm'])->name('surat.add');
        Route::post('surat-draft/update', [SuratController::class, 'update'])->name('surat.store');
        Route::post('surat-draft/store', [SuratController::class, 'store'])->name('surat.store');
        Route::put('surat-draft/status/{id}', [SuratController::class,'editStatus'])->name('surat.editStatus');
        Route::delete('surat-draft/delete/{id}', [SuratController::class, 'delete'])->name('surat.delete');

    });

    Route::prefix('master-data')->group(function () {
        // JURUSAN
        Route::get('jurusan', [JurusanController::class,'index'])->name('jurusan');
        Route::get('jurusan/add', [JurusanController::class,'addForm'])->name('jurusan.add');
        Route::get('jurusan/edit/{id}', [JurusanController::class, 'editForm'])->name('jurusan.edit');
        Route::post('jurusan/store', [JurusanController::class, 'store'])->name('jurusan.store');
        Route::put('jurusan/update/{id}', [JurusanController::class, 'update'])->name('jurusan.update');
        Route::delete('jurusan/{id}', [JurusanController::class, 'delete'])->name('jurusan.delete');

        // PERUSAHAAN
        Route::get('perusahaan', [PerusahaanController::class,'index'])->name('perusahaan');
        Route::get('perusahaan/add', [PerusahaanController::class,'addForm'])->name('perusahaan.add');
        Route::get('perusahaan/edit/{id}', [PerusahaanController::class, 'editForm'])->name('perusahaan.edit');
        Route::post('perusahaan/store', [PerusahaanController::class, 'store'])->name('perusahaan.store');
        Route::put('perusahaan/update/{id}', [PerusahaanController::class, 'update'])->name('perusahaan.update');
        Route::delete('perusahaan/{id}', [PerusahaanController::class, 'delete'])->name('perusahaan.delete');

        // PROGRAM
        Route::get('program', [ProgramController::class,'index'])->name('program');
        Route::get('program/add', [ProgramController::class,'addForm'])->name('program.add');
        Route::get('program/edit/{id}', [ProgramController::class, 'editForm'])->name('program.edit');
        Route::post('program/store', [ProgramController::class, 'store'])->name('program.store');
        Route::put('program/update/{id}', [ProgramController::class, 'update'])->name('program.update');
        Route::put('program/status/{id}', [ProgramController::class, 'updateStatus'])->name('program.status');
        Route::delete('program/{id}', [ProgramController::class, 'delete'])->name('program.delete');
    });

    Route::get('/pdf/{id}', [PdfController::class, 'exportPdf']);

    Route::get('/logout', [SessionsController::class, 'destroy']);
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/pengajuanpkl', [SiswaController::class, 'index'])->name('program');
    Route::get('/pengajuanpkl/form', [SiswaController::class, 'form'])->name('formPengajuan');
    Route::get('/pengajuanpkl/rekomendasi', [SiswaController::class, 'rekomendasi'])->name('rekomendasi');
    Route::get('/admin', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
    Route::post('/pengajuanpkl/store', [SuratController::class, 'store'])->name('pengajuan.store');
});

Route::get('/pengajuanpkl', [SiswaController::class, 'index'])->name('program');
