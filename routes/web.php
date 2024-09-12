<?php

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

Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('/director', DirectorController::class);
    Route::resource('/kavling', KavlingController::class);
    Route::resource('/parameter', ValueParameterController::class);

    Route::resource('/transaction', TransactionValueController::class);
});
