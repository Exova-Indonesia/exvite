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
Route::get('/province/{id}', [App\Http\Controllers\ApiController::class, 'province']);
Route::get('/city/{id}', [App\Http\Controllers\ApiController::class, 'city']);
Route::get('/postal/{id}', [App\Http\Controllers\ApiController::class, 'postal']);
Route::get('/indonesian', [App\Http\Controllers\ApiController::class, 'allAddress']);
