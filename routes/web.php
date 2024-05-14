<?php

use App\Http\Controllers\Observasi\ApdController;
use App\Http\Controllers\Observasi\HandHygieneController;
use App\Http\Controllers\Report\ApdReportController;
use App\Http\Controllers\Report\HandReportController;
use App\Http\Controllers\Setting\PeriodeController;
use App\Http\Controllers\Setting\ProfesiController;
use App\Http\Controllers\Setting\ReportConfigController;
use App\Http\Controllers\Setting\RuanganController;
use App\Http\Controllers\Setting\TahunController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth'])->name('dashboard');

Route::get('users', [UserController::class, 'index'])->name('users.index');

Route::controller(HandHygieneController::class)->group(function () {
    Route::get('handhygiene', 'mulai')->name('handhygiene');
    Route::post('handhygiene', 'simpan_satu')->name('handhygiene.store');
    Route::post('handhygiene-lanjut', 'lanjut')->name('handhygiene.lanjut');
    Route::get('handhygiene-lanjut/{id?}', 'lanjut_input')->name('handhygiene.lanjut.input');
    Route::get('handhygiene-list', 'list')->name('handhygiene.list');
    Route::get('handhygiene-report', 'report')->name('handhygiene.report');
    Route::post('handhygiene-report-periode', 'report_periode')->name('handhygiene.report.periode');
    Route::post('handhygiene-posting', 'posting')->name('handhygiene.posting');
});
Route::controller(ApdController::class)->group(function () {
    Route::get('apd', 'mulai')->name('apd');
    Route::post('apd', 'simpan_satu')->name('apd.store');
    Route::post('apd-lanjut', 'lanjut')->name('apd.lanjut');
    Route::post('apd-posting', 'posting')->name('apd.posting');
    Route::get('apd-list', 'list')->name('apd.list');
    Route::get('apd-lanjut/{id?}', 'lanjut_input')->name('apd.lanjut.input');
    Route::get('apd-detail/{id?}', 'detail')->name('apd.lanjut.detail');
});
Route::middleware(['auth'])->group(function () {
    Route::controller(TahunController::class)->group(function () {
        Route::get('/tahun/{id}', 'edit');
        Route::get('/tahun-add', 'create');
        Route::post('/tahun-store', 'store');
        Route::get('/tahun', 'index');
        Route::post('/tahun-update', 'update');
    });
    Route::controller(ProfesiController::class)->group(function () {
        Route::get('/profesi/{id}', 'edit');
        Route::get('/profesi-add', 'create');
        Route::post('/profesi-store', 'store');
        Route::get('/profesi', 'index');
        Route::post('/profesi-update', 'update');
    });
    Route::controller(PeriodeController::class)->group(function () {
        Route::get('/periode/{id}', 'edit');
        Route::get('/periode-add', 'create');
        Route::post('/periode-store', 'store');
        Route::get('/periode', 'index');
        Route::post('/periode-update', 'update');
    });
    Route::controller(RuanganController::class)->group(function () {
        Route::get('/ruangan/{id}', 'edit');
        Route::get('/ruangan-add', 'create');
        Route::post('/ruangan-store', 'store');
        Route::get('/ruangan', 'index');
        Route::post('/ruangan-update', 'update');
    });
    Route::controller(ReportConfigController::class)->group(function () {
        Route::get('/report-config', 'index');
        Route::post('/report-store', 'store');
    });
    Route::controller(HandReportController::class)->group(function () {
        Route::get('/report-handhygiene', function () {
            return view('report.hand.index');
        });
        Route::get('/report-hh-permoment', 'rekap_permoment');
        Route::post('/report-hh-permoment-periode', 'rekap_permoment_periode');
        Route::get('/report-hh-perruangan-del/{id?}', 'hh_delete');
        Route::get('/report-hh-perruangan-edit/{id?}', 'hh_edit');
        Route::post('/report-hh-perruangan-store', 'hh_edit_store');
        Route::get('/report-hh-perruangan', 'rekap_perruangan');
        Route::post('/report-hh-perruangan-tahun', 'rekap_perruangan_tahun');
        Route::get('/report-hh-perperiode', 'rekap_perperiode');
        Route::post('/report-hh-perperiode-tahun', 'rekap_perperiode_tahun');
        Route::get('/report-hh-perprofesi', 'rekap_perprofesi');
        Route::post('/report-hh-perprofesi-tahun', 'rekap_perprofesi_tahun');
    });
    Route::controller(ApdReportController::class)->group(function () {
        Route::get('/report-apd', function () {
            return view('report.apd.index');
        });
        Route::get('/report-apd-perruangan', 'rekap_perruangan');
        Route::post('/report-apd-perruangan-tahun', 'rekap_perruangan_tahun');
        Route::get('/report-apd-perperiode', 'rekap_perperiode');
        Route::post('/report-apd-perperiode-tahun', 'rekap_perperiode_tahun');
    });
});
require __DIR__ . '/auth.php';