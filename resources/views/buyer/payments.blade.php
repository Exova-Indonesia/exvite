@extends('layouts.app')
@section('content')
<form action="{{ route('pay') }}" method="POST">
    @csrf
<div class="container mb-5">
    <div class="col-lg-12 col-sm-12">
        <div class="row">
            <div class="col-lg-8 col-sm-12 px-1">
                <div class="card mb-2">
                    <div class="card-header border-0">
                        <h5 class="m-0">Detail Pesanan & Pembeli</h5>
                    </div>
                    <div class="card-body row">
                        <div class="products col-sm-12 col-lg-6">
                            Mohon Tunggu . . .
                        </div>
                        <div class="col-lg-6 col-sm-12 py-1">
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
                    <div class="card-header border-0">
                        <h5 class="m-0">Metode Pembayaran</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-7 col-sm-12 col-md-7">
                                <div class="row">
                                    <div class="payment-method-radio notif-active col-lg-5" data-method="QRIS">
                                        QRIS - QR CODE
                                    </div>
                                    <div class="payment-method-radio col-lg-5" data-method="Mandiri">    
                                        Virtual Account Mandiri
                                    </div>
                                    <div class="payment-method-radio col-lg-5" data-method="BNI">    
                                        Virtual Account BNI
                                    </div>
                                    <div class="payment-method-radio col-lg-5" data-method="Permata">    
                                        Virtual Account Permata
                                    </div>
                                    <div class="payment-method-radio col-lg-5" data-method="Bank Lainnya">    
                                        Bank Lainnya
                                    </div>
                                    <div class="payment-method-radio col-lg-5" data-method="ExoWallet">    
                                        ExoWallet
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-sm-12 col-md-5 my-2">
                                <div class="method-desc">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12 px-1">
                <div class="card">
                <div class="checkout__order mx-1">
                    <h5 class="text-uppercase m-0">Detail Pembayaran</h5>
                    <div class="checkout__order__product pb-0">
                        <ul class="p-0 my-2">
                            <li>
                                <span class="top__text"></span>
                            </li>    
                            <li>Metode Pembayaran<span class="method">QRIS</span></li>
                            <li>Biaya Layanan<span class="serv_price"></span></li>
                        </ul>
                    </div>
                    <div class="checkout__order__product pb-0">
                        <ul class="p-0 my-2">
                            <li>
                                <span class="top__text">Jasa</span>
                                <span class="top__text__right">Total</span>
                            </li>
			    			<li>Total Pembelian <span class="buy_price"></span></li>
			    		</ul>
                    </div>
                        <div class="checkout__order__total">
                        <ul class="p-0 my-2">
                            <li>Total <span class="total"></span></li>
                        </ul>
                    </div>
                    <button type="button" class="btn btn-exova w-100 snap">Bayar</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection
@section('scripts')
<script>
    jQuery(function() {
        $(document).ready(function () {
        let products = ``;
        function price(val, pm_price, subtotal) {
            let pricing, total;
            if (val == "QRIS") {
                pricing = pm_price * subtotal;
            } else {
                pricing = parseInt(pm_price);
            }
            total = subtotal + pricing;
            $(".serv_price").html("IDR " + numeral(pricing).format("0,0"));
            $(".buy_price").html("IDR " + numeral(subtotal).format("0,0"));
            $(".total").html("IDR " + numeral(total).format("0,0"));
        }

        $.getJSON("{{ url('payments/data') }}", function (data) {
            let buy_price,
            subtotal = 0;
            $.each(data[1], function (i, data) {
                addSubtotal = 0;
                $.each(data.additional, function(i, add) {
                    addSubtotal += parseInt(add.price * add.quantity);
                });
                buy_price = parseInt(data.price);
                subtotal += buy_price;
                subtotal = subtotal + addSubtotal;
                products +=
                    `
                <div class="col-lg-12 col-sm-12 px-2">
                    <li class="list-group-item border-dashed my-2">
                        <div class="product-cart-body">
                            <div class="row m-0">
                                <div class="ml-2">
                                    <img width="70" height="70" src="` +
                                    data.picture +
                                    `" alt="Products Icons">
                                    </div>
                                    <div class="ml-3">
                                    <p class="mb-1">` +
                                    data.name +
                                    `</p>
                                    <p class="mb-1"><strong>IDR ` +
                                    numeral(data.price).format(0, 0) +
                                    `</strong></p>
                                    <p class="mb-1">` +
                                    data.type +
                                    `</p>
                                </div>
                            </div>
                        </div>
                    </li>
                </div>
                `;
                $(".products").html(products);
            });

            $('.snap').on('click', function () {
                let val = $(".notif-active").attr("data-method");
                $.ajax({
                    url: "{{ url('payments/pay') }}",
                    data: 'method=' + val,
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Access-Control-Allow-Origin': '*',
                    },
                    success: function (data) {
                        // console.log(data)
                        window.location = data.link;
                    },
                    error: function (data) {
                        // console.log(data);
                    }
                })
            })

            $(".payment-method-radio").on("click", function () {
                $(".payment-method-radio").removeClass("notif-active");
                $(this).addClass("notif-active");
                let val = $(this).attr("data-method");
                $(".method").html(val);
                $.each(data[0], function (i, data) {
                    if (val == data.pm_name) {
                        let content = "";
                        content +=
                            `
                    <img width="200" height="66" src="` +
                            data.pm_icons +
                            `" alt="Icons">
                    <p>` +
                            data.pm_description +
                            `</p>
                    `;
                        $(".method-desc").html(content);
                        price(val, data.pm_price, subtotal);
                    }
                });
            });

            let val = $(".notif-active").attr("data-method");
            price(val, data[0][0].pm_price, subtotal);
            let content = "";
            content +=
                `
            <img width="200" height="66" src="` +
                data[0][0].pm_icons +
                `" alt="Icons">
            <p>` +
                data[0][0].pm_description +
                `</p>
            `;
            $(".method-desc").html(content);
        });
    });
});
</script>
@endsection