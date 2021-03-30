@extends('layouts.app')
@section('content')
<form>
    @csrf
<div class="container mb-5">
    <div class="col-lg-12">
        <div class="row">
            <div class="@if(!empty($data[0])) col-lg-8 col-sm-12 @else col-sm-12 col-lg-12 @endif px-1">
                <div class="card mb-2 border-0">
                    <div class="card-header border-0">
                        <h5 class="m-0"> @lang('payments.cart.title') </h5>
                    </div>
                    <div class="card-body pt-0">
                        <ul class="list-group">
                        @if(!empty($data[0]))
                            @foreach($data as $j)
                            <li class="list-group-item border-dashed my-2 parent" data-id="{{ $j->cart_id }}">
                                <div class="product-cart-body">
                                    <div class="row">
                                        <div class="ml-2 cart-image">
                                            <img width="70" height="70" src="@if($j->product_type == 'Jasa') {{ $j->jasa['cover']['small'] }} @elseif($j->product_type == 'Subscription') https://assets.exova.id/img/1.png @endif" alt="Products Icons">
                                        </div>
                                        <div class="ml-3">
                                            <p class="mb-1"> 
                                                @if($j->product_type == 'Jasa') 
                                                    {{ $j->jasa->jasa_name }}
                                                @elseif($j->product_type == 'Subscription') 
                                                    {{ $j->plan->plan_name }}
                                                @endif
                                            </p>
                                            <p class="mb-1"><strong>IDR {{ number_format($j->unit_price, 0) }}</strong></p>
                                            <p class="mb-1">{{ $j->product_type }}</p>
                                        </div>
                                    </div>
                                    <div class="del-btn-cart">
                                        <button type="button" class="btn btn-danger delete-cart" data-id="{{ $j->cart_id }}"><i class="fas fa-trash"></i></button>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12 px-1">
                <div class="card">
                    <div class="card-header border-0">
                        <h5 class="m-0">@lang('payments.cart.paymenttitle')</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="mb-2">
                                <span class="text-muted">@lang('payments.cart.subtotal')</span>
                                    <span class="float-right text-right buy_price_cart"></span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <strong>@lang('payments.cart.total')</strong>
                                <span class="float-right text-right buy_price_cart"></span>
                            </li>
                            <button type="button" class="btn btn-success next">@lang('payments.cart.next')</button>
                            @else
                            <div class="mx-auto">
                            <div class="row">
                                <div>
                                <img width="240px" height="192px" src="{{ asset('/images/icons/empty_cart.svg') }}" alt="icon">
                                </div>
                                <div class="ml-2 my-auto">
                                <span>
                                @lang('payments.cart.empty')<br>
                                <a href="/" class="btn btn-success">@lang('payments.cart.search')</a>
                                </span>
                                </div>
                            </div>
                            @endif
                        </ul> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection