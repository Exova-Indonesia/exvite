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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::put('/wallet/status/send', [App\Http\Controllers\WalletController::class, 'sendstatus']);
Route::get('/payments/handling', [App\Http\Controllers\PaymentsHandling::class, 'handling']);
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'data'])->name('data.profile');
Route::get('/provinces/{id}', [App\Http\Controllers\ApiController::class, 'province']);
Route::get('all/provinces/', [App\Http\Controllers\ApiController::class, 'province_all']);
Route::get('/regencies/{id}', [App\Http\Controllers\ApiController::class, 'city']);
Route::get('/districts/{id}', [App\Http\Controllers\ApiController::class, 'districts']);
Route::get('/villages/{id}', [App\Http\Controllers\ApiController::class, 'villages']);
Route::get('/indonesian', [App\Http\Controllers\ApiController::class, 'allAddress']);
