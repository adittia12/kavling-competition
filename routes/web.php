<?php

use App\Http\Controllers\DisplayCompetitionController;
use App\Http\Controllers\Master\DirectorController;
use App\Http\Controllers\Master\KavlingController;
use App\Http\Controllers\Master\ValueParameterController;
use App\Http\Controllers\Transaction\TransactionValueController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(DisplayCompetitionController::class)->group(function() {
    Route::get('/', 'displayDireksi')->name('display_values');
    Route::get('/display_kavling/{id}', 'displayKavling')->name('kavling_data');
    Route::get('/penilaian_kavling/{id_kavling}/{id_direksi}', 'displayPenilaian')->name('penilaian_garden');
    Route::post('store_penilaian/{dir_id}', 'storePenilaian')->name('store_value');
    Route::get('/penilaian/edit/{id_kavling}/{id_direksi}','editPenilaian')->name('edit_penilaian_garden');
    Route::post('/penilaian/update/{id_kavling}/{id_direksi}', 'updatePenilaian')->name('update_penilaian_garden');
});

Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('/director', DirectorController::class);
    Route::resource('/kavling', KavlingController::class);
    Route::resource('/parameter', ValueParameterController::class);

    Route::resource('/transaction', TransactionValueController::class);
    Route::controller(TransactionValueController::class)->group(function() {
        Route::get('display_rank', 'displayRank')->name('display_peringkat');
        Route::get('value_transaction', 'viewTransaction')->name('transaction_datavalue');
        Route::get('/export_ranking', 'exportRanking')->name('export.ranking');
    });
});
