<?php

// namespace App\Http\Controllers;
// use Auth;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\InvoiceMail;
use App\Exports\Transactions;
use App\Models\Transaction;
use Illuminate\Support\Facades\Notification;
use App\Notifications\MailResetPasswordNotification;
use App\Notifications\TransactionMail;

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



// Studio
Route::middleware('auth')->group(function() {
    Route::resource('/mystudio', App\Http\Controllers\Studio\StudioController::class);
    Route::resource('/studio', App\Http\Controllers\Studio\RegisterController::class);
    Route::get('/manage/{id}', [App\Http\Controllers\Studio\StudioController::class, 'manage']);
    Route::get('/share/{id}', [App\Http\Controllers\Studio\StudioController::class, 'share']);
    Route::get('/studios/{slug}', [App\Http\Controllers\Studio\StudioController::class, 'studios'])->name('view.studio');
    Route::delete('picture/{id}', [App\Http\Controllers\Studio\StudioController::class, 'destroy_picture']);
    Route::put('profil/studio/{id}', [App\Http\Controllers\Studio\StudioController::class, 'edit_profil'])->name('studio.profil.update');
});

Route::middleware('auth')->prefix('upload')->group(function() {
    Route::post('/studio/logo', [App\Http\Controllers\UploadController::class, 'logo_studio'])->name('upload.logo');
    Route::post('/uploads/jasapictures', [App\Http\Controllers\UploadController::class, 'jasa_picture'])->name('upload.pictures');
});

Route::get('/welcome', function (Request $request) {
    // return response()->json($request->session()->get('cart_shopping'));
    // $data = App\Models\Cart::where('cart_id', 1110088696)->delete();
    return auth()->user()->studio->id;
});

Route::get('/components/sidebar', function (Request $request) {
    return view('components.side-bar');
});

Route::get('/transaksi', function () {
    $details = Transaction::with('debitedwallet.walletusers')
    ->where('wal_transaction_id', 2241039626085026)
    ->first();
    return view('exports.transaction', ['details' => $details]);
});

// Route::post('/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();

//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');


// Web Api
Route::middleware('auth')->prefix('/web/v2')->group(function() {
    Route::get('/orders/penjualan/{submenu}/{search}', [App\Http\Controllers\ApiController::class, 'penjualan'])->name('penjualan');
    Route::get('/orders/pembelian/{submenu}/{search}', [App\Http\Controllers\ApiController::class, 'pembelian'])->name('pembelian');
    Route::get('/notification/update', [App\Http\Controllers\ApiController::class, 'update'])->name('update');
    Route::get('/notification/pesan', [App\Http\Controllers\ApiController::class, 'pesan'])->name('pesan');
    Route::post('/uploads/orders/{id}/{label}', [App\Http\Controllers\ApiController::class, 'store_order_files'])->name('order.files');
    Route::get('/subcategory/{id}', [App\Http\Controllers\ApiController::class, 'getSubCategory'])->name('api.subcategory');
    Route::get('/category', [App\Http\Controllers\ApiController::class, 'getCategory'])->name('api.category');
    Route::get('/products/pictures/{id}', [App\Http\Controllers\ApiController::class, 'getPictures'])->name('api.pictures');
    Route::get('/products/{id}', [App\Http\Controllers\ApiController::class, 'getProducts'])->name('api.products');
    Route::get('/products/additional/{id}', [App\Http\Controllers\ApiController::class, 'getAdditional'])->name('api.additional.products');
    Route::get('/rating/{id}', [App\Http\Controllers\ApiController::class, 'getRating'])->name('api.rating');
});
    Route::get('/provinces', [App\Http\Controllers\ApiController::class, 'provinces']);
    Route::get('/regencies/{id}', [App\Http\Controllers\ApiController::class, 'regencies']);
    Route::get('/districts/{id}', [App\Http\Controllers\ApiController::class, 'districts']);
    Route::get('/villages/{id}', [App\Http\Controllers\ApiController::class, 'villages']);

    Route::get('/province/{id}', [App\Http\Controllers\ApiController::class, 'province']);
    Route::get('/regencie/{id}', [App\Http\Controllers\ApiController::class, 'regencie']);
    Route::get('/district/{id}', [App\Http\Controllers\ApiController::class, 'district']);
    Route::get('/village/{id}', [App\Http\Controllers\ApiController::class, 'village']);


Route::middleware('auth')->group(function() {
    Route::put('profile/check/{id}', [App\Http\Controllers\ProfileController::class, 'check'])->name('profile.check');
    Route::get('profile/data', [App\Http\Controllers\ProfileController::class, 'data'])->name('profile.data');
    Route::resource('/profile', App\Http\Controllers\ProfileController::class);
});

Route::middleware('auth')->group(function() {
    Route::resource('/notifications', App\Http\Controllers\NotificationController::class);
});

Auth::routes(['verify' => true]);
Route::middleware('auth')->group(function() {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/autocomplete', [App\Http\Controllers\HomeController::class, 'autocomplete']);
    Route::get('/search/{title}', [App\Http\Controllers\HomeController::class, 'search']);
});
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
    Route::post('/saldo', [App\Http\Controllers\WalletController::class, 'cekbalance']);
    Route::post('/minimum', [App\Http\Controllers\WalletController::class, 'cekminimum']);
    Route::post('/cekuser', [App\Http\Controllers\WalletController::class, 'cekuser']);
    Route::post('/send', [App\Http\Controllers\WalletController::class, 'send'])->name('wallet.send');
    Route::post('/status/send', [App\Http\Controllers\WalletController::class, 'sendstatus']);
    Route::post('/withdraw', [App\Http\Controllers\WalletController::class, 'withdraw'])->name('wallet.withdraw');
    Route::get('/redirect/{id}/{type}', [App\Http\Controllers\WalletController::class, 'redirectTransaction']);
});

Route::get('/history/export/all', [App\Http\Controllers\ExportController::class, 'tes'])->name('transaction.all');
Route::post('/download', [App\Http\Controllers\ExportController::class, 'download'])->name('download');
Route::get('/download/{type}/{id}', [App\Http\Controllers\ExportController::class, 'download_orders'])->name('download.orderan');
Route::get('/view/{path}', [App\Http\Controllers\ExportController::class, 'view'])->name('view');
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
    Route::post('/add', [App\Http\Controllers\CartController::class, 'add']);
    Route::post('/', [App\Http\Controllers\CartController::class, 'finish'])->name('cart.finish');
    Route::get('/data', [App\Http\Controllers\CartController::class, 'cart_data']);
    Route::get('/create', [App\Http\Controllers\CartController::class, 'cart_create']);
});
Route::get('/purchase/{id}/{name}', [App\Http\Controllers\CartController::class, 'products']);

// Highlight
Route::get('/highlight', [App\Http\Controllers\HighlightController::class, 'index']);
Route::get('/highlight/all', [App\Http\Controllers\HighlightController::class, 'all']);

Route::middleware('auth', 'cartsession')->group(function() {
    Route::resource('/order', App\Http\Controllers\OrderController::class);
    Route::post('/revision', [App\Http\Controllers\OrderController::class, 'revisi']);
});

// Products Page
Route::middleware('auth')->group(function() {
    Route::resource('/products', App\Http\Controllers\ProductController::class);
    Route::post('/favorite/products', [App\Http\Controllers\ProductController::class, 'add_favorite'])->name('products.favorit');
    Route::post('/diskusi/new', [App\Http\Controllers\ProductController::class, 'add_diskusi'])->name('diskusi.new');
});


Route::get('/send', function() {
    // $data = User::whereHas('subs', function($q) {
    //     $q->where('plan_id', 1);
    // })->get();
    $name = User::where('id', Auth::user()->id)->first();
    $details = Transaction::with('debitedwallet.walletusers')
    ->where('wal_transaction_id', 20210224302018)
    ->first();
    // $pdf = PDF::loadview('exports.transaction', ['details' => $details])->setPaper('a4', 'potrait');
    // Storage::put('invoice.pdf', $pdf->output());
    // return $pdf->store(Lang::get('wallet.history.title').'.pdf');
    // return Excel::store(new Transactions(2241039626085026), 'trans.xlsx');
    // return response()->json($details);
    // auth()->user()->notify(new \App\Notifications\MailResetPasswordNotification($name));
    // return redirect('/');
    
    // $name->notify(new TransactionMail($name->name, $details));
    // auth()->user()->notify(new TransactionMail($details));
    // Notification::send($name, new TransactionMail($details));
    // Mail::to(Auth::user())->send(new InvoiceMail($details));

});