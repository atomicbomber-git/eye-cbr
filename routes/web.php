<?php

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

use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\BantuanController;
use App\Http\Controllers\CaseAnalysisController;
use App\Http\Controllers\CaseVerificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\TentangSayaController;
use App\Http\Controllers\UnverifiedCaseController;
use App\Http\Controllers\VerifiedCaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect("/", "/home");
Auth::routes();


Route::resource('konsultasi', class_basename(KonsultasiController::class))
    ->parameter('konsultasi', 'kasus');

Route::get('home', class_basename(HomeController::class))->name('home');
Route::get('bantuan', class_basename(BantuanController::class))->name('bantuan');
Route::get('tentang-saya', class_basename(TentangSayaController::class))->name('tentang-saya');
Route::get('admin-home', class_basename(AdminHomeController::class))->name('admin-home');


Route::group(['prefix' => '/kasus-terverifikasi', 'as' => 'verified_case.'], function () {
    Route::get('/index', [VerifiedCaseController::class, 'index'])->name('index');
    Route::get('/create', [VerifiedCaseController::class, 'create'])->name('create');
    Route::post('/store', [VerifiedCaseController::class, 'store'])->name('store');
    Route::get('/edit/{case_record}', [VerifiedCaseController::class, 'edit'])->name('edit');
    Route::post('/update/{case_record}', [VerifiedCaseController::class, 'update'])->name('update');
    Route::post('/hapus/{case_record}', [VerifiedCaseController::class, 'delete'])->name('delete');
    Route::post('/unverify/{case_record}', [CaseVerificationController::class, 'delete'])->name('unverify');
});

Route::group(['prefix' => '/kasus-belum-terverifikasi', 'as' => 'unverified_case.'], function () {
    Route::get('/index', [UnverifiedCaseController::class, "index"])->name('index');
    Route::get('/create', [UnverifiedCaseController::class, "create"])->name('create');
    Route::post('/store', [UnverifiedCaseController::class, "store"])->name('store');
    Route::get('/edit/{case_record}', [UnverifiedCaseController::class, "edit"])->name('edit');
    Route::post('/update/{case_record}', [UnverifiedCaseController::class, "update"])->name('update');
    Route::post('/hapus/{case_record}', [UnverifiedCaseController::class, "delete"])->name('delete');
    Route::post('/verifikasi/{case_record}', [CaseVerificationController::class, 'create'])->name('verify');
});

Route::group(['prefix' => '/analisis-kasus', 'as' => 'case_analysis.'], function () {
    Route::get('/show/{case_record}', [CaseAnalysisController::class, 'show'])->name('show');
});

Route::group(['prefix' => '/gejala', 'as' => 'feature.'], function () {
    Route::get('/index', [FeatureController::class, 'index'])->name('index');
});
