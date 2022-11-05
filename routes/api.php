<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('events' , [\App\Http\Controllers\EventController::class , 'index'] );
Route::get('eventss' , [\App\Http\Controllers\EventController::class , 'index'] )->name('payment.success');
Route::get('eventss' , [\App\Http\Controllers\EventController::class , 'index'] )->name('payment.cancel');
Route::get('events/{id}' , [\App\Http\Controllers\EventController::class , 'show'] );
Route::post('events' , [\App\Http\Controllers\EventController::class , 'store'] );
Route::post('payment_success' , [\App\Http\Controllers\EventController::class , 'paymentSuccess'] );
Route::post('payment_faild' , [\App\Http\Controllers\EventController::class , 'paymentFaild'] );
