<?php

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
    return view('welcome');
});

Route::get('payment/{amount}', [\App\Http\Controllers\EventController::class,'paymob'])->name('pa');
Route::post('charge', [\App\Http\Controllers\PaymentController::class,'charge'] );
Route::get('success', [\App\Http\Controllers\PaymentController::class,'success']);
Route::get('error', [\App\Http\Controllers\PaymentController::class,'error']);
