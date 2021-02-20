<?php

// namespace App\Http\Controllers; 
// use Auth;

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

Route::middleware('auth')->group(function() {
    Route::put('/profile/check/{id}', [App\Http\Controllers\ProfileController::class, 'check'])->name('profile.check');
    Route::get('/profile/data', [App\Http\Controllers\ProfileController::class, 'data'])->name('profile.data');
    Route::resource('/profile', App\Http\Controllers\ProfileController::class);
});

Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/search', [App\Http\Controllers\HomeController::class, 'autocomplete']);
Route::get('auth/{provider}', [App\Http\Controllers\Auth\AuthController::class, 'redirectToProvider']);
Route::get('auth/{provider}/callback', [App\Http\Controllers\Auth\AuthController::class, 'handleProviderCallback']);

//Wallet
Route::post('/add/bank', [App\Http\Controllers\WalletController::class, 'addbank'])->name('bank.add');
Route::get('/bank/{id}', [App\Http\Controllers\WalletController::class, 'deletebank']);
Route::post('/transaction-details', [App\Http\Controllers\WalletController::class, 'transdetails']);

Route::middleware(['auth'])->prefix('wallet')->group(function() {
    Route::get('/', [App\Http\Controllers\WalletController::class, 'index']);
    Route::post('/pendapatan', [App\Http\Controllers\WalletController::class, 'cekpendapatan']);
    Route::post('/dana', [App\Http\Controllers\WalletController::class, 'cekdana']);
    Route::post('/balance', [App\Http\Controllers\WalletController::class, 'cekbalance']);
    Route::post('/minimum', [App\Http\Controllers\WalletController::class, 'cekminimum']);
    Route::post('/cekuser', [App\Http\Controllers\WalletController::class, 'cekuser']);
    Route::post('/send', [App\Http\Controllers\WalletController::class, 'send'])->name('wallet.send');
    Route::post('/status/send', [App\Http\Controllers\WalletController::class, 'sendstatus']);
    Route::post('/withdraw', [App\Http\Controllers\WalletController::class, 'withdraw'])->name('wallet.withdraw');
});

Route::get('/history/export', [App\Http\Controllers\WalletController::class, 'export_history']);
// Route::get('/tests', [App\Http\Controllers\WalletController::class, 'tests']);

// Payments
Route::middleware('auth', 'cartsession')->prefix('payments')->group(function() {
    Route::get('/', [App\Http\Controllers\PaymentsController::class, 'index']);
    Route::post('/', [App\Http\Controllers\PaymentsController::class, 'products']);
    Route::get('/data', [App\Http\Controllers\PaymentsController::class, 'data']);
    Route::post('/pay', [App\Http\Controllers\PaymentsController::class, 'pay'])->name('pay');
});

Route::get('/payments/handling', [App\Http\Controllers\PaymentsHandling::class, 'handling']);

// Cart
Route::middleware('auth')->prefix('cart')->group(function() {
    Route::get('/', [App\Http\Controllers\CartController::class, 'index']);
    Route::delete('/', [App\Http\Controllers\CartController::class, 'delete']);
    Route::put('/', [App\Http\Controllers\CartController::class, 'update']);
    Route::post('/', [App\Http\Controllers\CartController::class, 'finish'])->name('cart.finish');
    Route::get('/data', [App\Http\Controllers\CartController::class, 'cart_data']);
    Route::get('/create', [App\Http\Controllers\CartController::class, 'cart_create']);
});
Route::get('/purchase/{id}/{name}', [App\Http\Controllers\CartController::class, 'cart']);

// Highlight
Route::get('/highlight', [App\Http\Controllers\HighlightController::class, 'index']);
Route::get('/highlight/all', [App\Http\Controllers\HighlightController::class, 'all']);

Route::middleware('auth', 'cartsession')->group(function() {
    Route::resource('/order', App\Http\Controllers\OrderController::class);
});


Route::get('/send', function() {
    $name = Auth::user()->name;
    auth()->user()->notify(new \App\Notifications\MailResetPasswordNotification($name));
    return redirect('/');
});