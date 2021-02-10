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

//Wallet
Route::get('/wallet', [App\Http\Controllers\WalletController::class, 'index']);
Route::post('/add/bank', [App\Http\Controllers\WalletController::class, 'addbank'])->name('bank.add');
Route::get('/bank/{id}', [App\Http\Controllers\WalletController::class, 'deletebank']);
Route::post('/transaction-details', [App\Http\Controllers\WalletController::class, 'transdetails']);

Route::post('/wallet/pendapatan', [App\Http\Controllers\WalletController::class, 'cekpendapatan']);
Route::post('/wallet/dana', [App\Http\Controllers\WalletController::class, 'cekdana']);
Route::post('/wallet/balance', [App\Http\Controllers\WalletController::class, 'cekbalance']);
Route::post('/wallet/minimum', [App\Http\Controllers\WalletController::class, 'cekminimum']);

Route::post('/wallet/cekuser', [App\Http\Controllers\WalletController::class, 'cekuser']);
Route::post('/wallet/send', [App\Http\Controllers\WalletController::class, 'send'])->name('wallet.send');
Route::post('/wallet/status/send', [App\Http\Controllers\WalletController::class, 'sendstatus']);

Route::post('/wallet/withdraw', [App\Http\Controllers\WalletController::class, 'withdraw'])->name('wallet.withdraw');
Route::get('/history/export', [App\Http\Controllers\WalletController::class, 'export_history']);
// Route::get('/tests', [App\Http\Controllers\WalletController::class, 'tests']);

// Payments
Route::get('/payments', [App\Http\Controllers\PaymentsController::class, 'index']);
Route::post('/payments', [App\Http\Controllers\PaymentsController::class, 'products']);
Route::get('/data/payments', [App\Http\Controllers\PaymentsController::class, 'data']);
Route::post('/payments/pay', [App\Http\Controllers\PaymentsController::class, 'pay'])->name('pay');
Route::get('/payments/handling', [App\Http\Controllers\PaymentsHandling::class, 'handling']);

// Cart
Route::get('/purchase/{id}/{name}', [App\Http\Controllers\CartController::class, 'cart']);
Route::get('/cart', [App\Http\Controllers\CartController::class, 'index']);
Route::delete('/cart', [App\Http\Controllers\CartController::class, 'delete']);
Route::put('/cart', [App\Http\Controllers\CartController::class, 'update']);
Route::post('/cart', [App\Http\Controllers\CartController::class, 'finish']);
Route::get('/cart/data', [App\Http\Controllers\CartController::class, 'cart_data']);
Route::get('/cart/create', [App\Http\Controllers\CartController::class, 'cart_create']);
Route::get('/order/details', [App\Http\Controllers\CartController::class, 'tes_session']);

// Highlight
Route::get('/highlight', [App\Http\Controllers\HighlightController::class, 'index']);
Route::get('/highlight/all', [App\Http\Controllers\HighlightController::class, 'all']);

Route::get('/send', function() {
    $name = Auth::user()->name;
    auth()->user()->notify(new \App\Notifications\MailResetPasswordNotification($name));
    return redirect('/');
});