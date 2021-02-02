@extends('layouts.app')
@section('content')
<div class="container mb-5">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-8 px-1">
                <div class="card mb-2">
                    <div class="card-header">
                        Detail Pesanan | Detail Pembeli
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 py-1">
                                <div class="row">
                                    <div class="mx-2 border p-2">
                                        <img width="80" height="80" src="https://assets.exova.id/img/1.png">
                                    </div>
                                    <div class="mx-2">
                                        <div class="">
                                            <h5 class="m-0">Nama Produk</h5>
                                        </div>
                                        <div class="">
                                            <span>IDR 124,000</span>
                                        </div>
                                        <div class="">
                                            <span>Kategori</span>
                                        </div>
                                        <div class="">
                                            <span>Catatan</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 py-1">
                                <div class="row">
                                    <div class="mx-2 border p-2">
                                        <img width="80" height="80" src="https://assets.exova.id/img/1.png">
                                    </div>
                                    <div class="mx-2">
                                        <div class="">
                                            <h5 class="m-0">Nama Produk</h5>
                                        </div>
                                        <div class="">
                                            <span>IDR 124,000</span>
                                        </div>
                                        <div class="">
                                            <span>Kategori</span>
                                        </div>
                                        <div class="">
                                            <span>Catatan</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="float-right">Nama Produk</span>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-header">
                        Metode Pembayaran
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 p-0">
                                <div class="col-lg-12">    
                                    <label class="payment-method-radio highlight-active" for="method1">
                                        <input type="radio" name="method" id="method1" value="gopay" checked>
                                        QRIS - QR CODE
                                    </label>
                                </div>
                                <div class="col-lg-12">    
                                    <label class="payment-method-radio" for="method2">
                                        <input type="radio" name="method" id="method2" value="vamandiri">
                                        Virtual Account Mandiri
                                    </label>
                                </div>
                                <div class="col-lg-12">    
                                    <label class="payment-method-radio" for="method3">
                                        <input type="radio" name="method" id="method3" value="vabni">
                                        Virtual Account BNI
                                    </label>
                                </div>
                                <div class="col-lg-12">    
                                    <label class="payment-method-radio" for="method4">
                                        <input type="radio" name="method" id="method4" value="vapermata">
                                        Virtual Account Permata
                                    </label>
                                </div>
                                <div class="col-lg-12">    
                                    <label class="payment-method-radio" for="method5">
                                        <input type="radio" name="method" id="method5" value="otherbank">
                                        Bank Lainnya
                                    </label>
                                </div>
                                <div class="col-lg-12">    
                                    <label class="payment-method-radio" for="method6">
                                        <input type="radio" name="method" id="method6">
                                        ExoWallet
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6 my-2">
                                <div class="method-desc">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 px-1">
                <div class="card">
                    <div class="card-header">
                        Payments Detail
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div>
                                    <span>Metode Pembayaran</span>
                                    <span class="float-right text-right status">BCA</span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="mb-2">
                                <span class="text-muted">Total Pembelian</span>
                                    <span class="float-right text-right status">IDR 12,100</span>
                                </div>
                                <div class="mt-2">
                                <span class="text-muted">Biaya Layanan</span>
                                    <span class="float-right text-right status">IDR 12,100</span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <strong>Total Pembayaran</strong>
                                <span class="float-right text-right to">IDR 12,100</span>
                            </li>
                            <button type="button" class="btn btn-success">Bayar</button>
                        </ul> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection