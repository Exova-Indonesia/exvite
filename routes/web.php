<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/search', [App\Http\Controllers\HomeController::class, 'autocomplete']);
Route::get('auth/{provider}', [App\Http\Controllers\Auth\AuthController::class, 'redirectToProvider']);
Route::get('auth/{provider}/callback', [App\Http\Controllers\Auth\AuthController::class, 'handleProviderCallback']);

///Wallet
Route::post('/wallet/ceksaldo', [App\Http\Controllers\WalletController::class, 'ceksaldo']);
Route::post('/wallet/send', [App\Http\Controllers\WalletController::class, 'send'])->name('wallet.send');
Route::post('/wallet/status/send', [App\Http\Controllers\WalletController::class, 'sendstatus']);

Route::post('/wallet/withdraw', [App\Http\Controllers\WalletController::class, 'withdraw'])->name('wallet.withdraw');

Route::get('/send', function() {
    $name = Auth::user()->name;
    auth()->user()->notify(new \App\Notifications\MailResetPasswordNotification($name));
    return redirect('/');
});