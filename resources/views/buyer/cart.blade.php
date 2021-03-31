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
@section('modals')
<div id="menu-success-2" class="menu menu-box-bottom bg-green-dark rounded-m" data-menu-height="335" data-menu-effect="menu-over" style="display: block; height: 335px;">
    <h1 class="text-center mt-4"><i class="fa fa-3x fa-check-circle scale-box color-white shadow-xl rounded-circle"></i></h1>
        <h1 class="text-center mt-3 font-700 color-white">Keren</h1>
            <p class="boxed-text-l success-message color-white opacity-70">

        </p>
    <a href="#" class="close-menu btn btn-m btn-center-m button-s shadow-l rounded-s text-uppercase font-600 bg-white color-black">Keren, Thanks!</a>
</div>
<div id="menu-warning-2" class="menu menu-box-bottom bg-red-dark rounded-m" data-menu-height="335" data-menu-effect="menu-over" style="display: block; height: 335px;">
    <h1 class="text-center mt-4"><i class="fa fa-3x fa-times-circle scale-box color-white shadow-xl rounded-circle"></i></h1>
        <h1 class="text-center mt-3 text-uppercase color-white font-700">Aduchh!</h1>
            <p class="boxed-text-l error-message color-white opacity-70">
            
        </p>
    <a href="#" class="close-menu btn btn-m btn-center-l button-s shadow-l rounded-s text-uppercase font-600 bg-white color-black">Hmmm, Yaudah deh</a>
</div>
<div class="menu-hider"></div>
@endsection
@section('scripts')
<script>
  $(document).ready(function() {
    $(".delete-cart").on("click", function (event) {
      $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
                "Access-Control-Allow-Origin": "*",
            },
        });
        $.ajax({
            url: "{{ url('cart') }}",
            type: "DELETE",
            data: "id=" + $(this).attr("data-id"),
            success: function (data) {
              $('#menu-success-2').addClass('menu-active');
              $('.menu-hider').addClass('menu-active');
              $(".success-message").text(data.status);
              setInterval(() => {
                window.location = window.location;
              }, 1000);
            },
            error: function (data) {
                console.log(data);
            },
        });
    });
  });
</script>
@endsection