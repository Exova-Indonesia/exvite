@extends('layouts.app')
@section('content')
<form action="{{ route('pay') }}" method="POST">
    @csrf
<div class="container mb-5">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-8 px-1">
                <div class="card mb-2">
                    <div class="card-header bg-white border-0">
                        <h5 class="m-0">Detail Pesanan & Pembeli</h5>
                    </div>
                    <div class="card-body row">
                        <div class="products col-lg-6">
                            Mohon Tunggu . . .
                        </div>
                        <div class="col-lg-6 py-1">
                            <li class="list-group-item border-dashed my-2">
                                <div class="product-cart-body">
                                    <div class="row">
                                        <div class="ml-3">
                                            <span> {{ Auth::user()->name }} </span>
                                            <p class="mb-0 text-muted"> {{ Auth::user()->address->address_name }} </p>
                                            <p class="mb-0 text-muted"> {{ Auth::user()->address->address }} </p>
                                            <p class="mb-0 text-muted"> {{ Auth::user()->address->city }} </p>
                                            <p class="mb-0 text-muted"> {{ Auth::user()->address->state }} </p>
                                            <p class="mb-0 text-muted"> {{ Auth::user()->phone }} </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </div>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-header bg-white border-0">
                        <h5 class="m-0">Metode Pembayaran</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 p-0">
                                <div class="col-lg-12">    
                                    <label class="payment-method-radio highlight-active" for="method1">
                                        <input type="radio" name="method" id="method1" value="QRIS" checked>
                                        QRIS - QR CODE
                                    </label>
                                </div>
                                <div class="col-lg-12">    
                                    <label class="payment-method-radio" for="method2">
                                        <input type="radio" name="method" id="method2" value="Mandiri">
                                        Virtual Account Mandiri
                                    </label>
                                </div>
                                <div class="col-lg-12">    
                                    <label class="payment-method-radio" for="method3">
                                        <input type="radio" name="method" id="method3" value="BNI">
                                        Virtual Account BNI
                                    </label>
                                </div>
                                <div class="col-lg-12">    
                                    <label class="payment-method-radio" for="method4">
                                        <input type="radio" name="method" id="method4" value="Permata">
                                        Virtual Account Permata
                                    </label>
                                </div>
                                <div class="col-lg-12">    
                                    <label class="payment-method-radio" for="method5">
                                        <input type="radio" name="method" id="method5" value="Bank Lainnya">
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
                    <div class="card-header bg-white border-0">
                        <h5 class="m-0">Payments Detail</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div>
                                    <span>Metode Pembayaran</span>
                                    <span class="float-right text-right method">QRIS</span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="mb-2">
                                <span class="text-muted">Total Pembelian</span>
                                    <span class="float-right text-right buy_price"></span>
                                </div>
                                <div class="mt-2">
                                <span class="text-muted">Biaya Layanan</span>
                                    <span class="float-right text-right serv_price"></span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <strong>Total Pembayaran</strong>
                                <span class="float-right text-right total"></span>
                            </li>
                            <button type="submit" class="btn btn-success snap">Bayar</button>
                        </ul> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection