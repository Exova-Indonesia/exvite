@extends('layouts.app')
@section('content')
<form>
    @csrf
<div class="container mb-5">
    <div class="col-lg-12">
        <div class="row">
            <div class="@if(!empty($data[0])) col-lg-8 @else col-lg-12 @endif px-1">
                <div class="card mb-2 border-0">
                    <div class="card-header bg-white border-0">
                        <h5 class="m-0"> @lang('payments.cart.title') </h5>
                    </div>
                    <div class="card-body pt-0">
                        <ul class="list-group">
                        @if(!empty($data[0]))
                            <li class="list-group-item border-bottom-0">
                                <div class="cart-header">
                                    <input class="form-check-input master-check" type="checkbox" name="selectAll">
                                    <label class="form-check-label m-0">@lang('payments.cart.chooseall')</label>
                                    <a class="float-right text-danger delete-cart" role="button"><i class="fas fa-trash"></i> @lang('payments.cart.delete')</a>
                                </div>
                            </li>
                            @foreach($data as $j)
                            <li class="list-group-item border-dashed my-2 parent" data-id="{{ $j->cart_id }}">
                                <div class="product-cart-header">
                                    <div class="cart-bando mb-2">
                                        <div class="float-left">
                                            <input class="sub-check" data-type="{{ $j->product_type }}" data-id="{{ $j->cart_id }}" id="sub-check{{ $j->cart_id }}" type="checkbox">
                                            <span class="ml-1">@lang('payments.cart.choose')</span>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-muted mr-2">Subtotal</span>
                                            <strong id="subtotal-{{ $j->cart_id }}"></strong>
                                        </div>
                                    </div>
                                    <h5 class="m-0"><i class="fas fa-crown align-text-top text-warning"></i> {{ $j->jasa->seller->name }}</h5>
                                    <p class="text-muted">Sidoarjo</p>
                                </div>
                                <div class="product-cart-body">
                                    <div class="row">
                                        <div class="ml-2">
                                            <img width="70" height="70" src="{{ $j->jasa->jasa_thumbnail }}" alt="Products Icons">
                                        </div>
                                        <div class="ml-3">
                                            <p class="mb-1">{{ $j->jasa->jasa_name }}</p>
                                            <p class="mb-1"><strong>IDR {{ number_format($j->jasa->jasa_price, 0) }}</strong></p>
                                            <p class="mb-1">{{ $j->jasa->jasa_subcategory }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-cart-footer">
                                    <div class="float-left mt-3">
                                        <div role="button">
                                            <span class="text-primary" id="catatan{{ $j->cart_id }}">Catatan </span>
                                            <span id="notes{{ $j->cart_id }}"></span>
                                        </div>
                                        <div class="catField" id="catField{{ $j->cart_id }}">
                                            <input class="form-control rounded-pill" id="fieldcat{{ $j->cart_id }}" max="125" type="text">
                                            <small class="text-muted ml-2" id="countstring{{ $j->cart_id }}"></small>
                                        </div>
                                    </div>
                                    <div class="float-right mt-3">
                                        <div class="row">
                                            <div class="text-center">
                                                <span role="button" class="minus-quantity bg-primary rounded-circle text-white" id="minus-quantity{{ $j->cart_id }}"><i class="fas fa-minus"></i></span>
                                                <input class="form-quantity" id="form-quantity{{ $j->cart_id }}" type="number" min="1" value="{{ $j->quantity }}">
                                                <span role="button" class="plus-quantity bg-primary rounded-circle text-white" id="plus-quantity{{ $j->cart_id }}"><i class="fas fa-plus"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 px-1">
                <div class="card">
                    <div class="card-header">
                        @lang('payments.cart.paymenttitle')
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
                                <img width="240px" height="192px" src="{{ asset('/images/icons/shopping_cart.svg') }}" alt="icon">
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