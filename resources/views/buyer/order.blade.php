@extends('layouts.app')
@section('content')
<div class="container mb-5">
    <div class="col-lg-12">
        <div class="row m-0">
            <div class="col-lg-8 col-sm-12 p-0">
                <div class="card mb-2 border-0 mx-1">
                    <div class="card-header border-0 bg-white">
                        <h5 class="m-0">Detail Pesanan</h5>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group">
                            <li class="list-group-item">
                                    <div class="form-group p-0 col-md-12">
                                        <div class="pb-2">
                                            <strong>Pembeli</strong>
                                        </div>
                                        <div class="border-dashed border-top p-3">
                                            <span> {{ Auth::user()->name }} </span>
                                            <p class="mb-0 text-muted"> {{ Auth::user()->address->city }} </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @foreach($order as $o)
                            <li class="list-group-item parent" data-id="{{ $o->cart_id }}">
                                <div class="form-group p-0 col-md-12">
                                    <div class="mb-2"><strong>Pesanan {{ $loop->iteration }}</strong></div>
                                    <div class="mb-3">
                                        <h5 class="m-0"> @if($o->product_type == 'Jasa') 
                                            {{ $o->jasa->seller->name }}
                                        @elseif($o->product_type == 'Create') @else @endif </h5>
                                        <small> @if($o->product_type == 'Jasa') 
                                            {{ $o->jasa->seller->address->district['name'] }}
                                        @elseif($o->product_type == 'Create') @else @endif </small>
                                    </div>
                                    <div class="row mb-3">
                                        <div><img class="mx-2 border" width="70px" height="70px" src="@if($o->product_type == 'Jasa') {{ $o->jasa->cover['small'] }}
                                        @elseif($o->product_type == 'Subscription') https://assets.exova.id/img/1.png @endif" alt="Thumbnail"></div>
                                        <div class="ml-2">
                                            <p class="m-0"> @if($o->product_type == 'Jasa') 
                                            {{ $o->jasa->jasa_name }}
                                            @elseif($o->product_type == 'Create') @else {{ $o->plan->plan_name }} @endif</p>
                                            <p class="m-0"><small>Tipe Pesanan : {{ $o->product_type }}</small></p>
                                            <p class="m-0"><span><strong>Rp{{ number_format($o->unit_price, 0) }}</strong></span></p>
                                        </div>
                                    </div>
                                </div>
                                @if($o->product_type == 'Jasa')
                                <div class="row m-0">
                                    <div class="form-group col-lg-6 col-sm-12">
                                        <div class="mx-1 input-style input-style-always-active has-borders has-icon mb-4">    
                                            <input type="date" data-id="{{ $o->cart_id }}" class="form-control deadlines" value="{{ date('Y-m-d', strtotime($o->details['deadline'] ?? '')) }}">
                                            <label for="dates" class="color-theme opacity-50 text-uppercase font-700 font-10">Deadline Proyek</label>
                                        </div>
                                    </div>
                                    @foreach($o->jasa->additional as $key=>$a)
                                    <div class="form-group col-lg-6 col-sm-12">
                                        <div class="mx-1 input-style input-style-always-active has-borders has-icon mb-4">    
                                            <select class="add-additional" name="additional" data-id="{{ $o->cart_id }}" id="form5">
                                                <option value="{{ $a->id . '-' . 0 }}">Tidak perlu</option>
                                                @if(count($o->additional) < 1)
                                                <option value="{{ $a->id . '-' . 0 }}" selected hidden>Pilih Paket</option>
                                                @endif
                                                @foreach($o->additional as $x)
                                                <option value="{{ $a->id . '-' . 0 }}" selected hidden>{{ $x->quantity }}</option>
                                                @endforeach
                                                @for($i=1; $i<10; $i++)
                                                <option value="{{ $a->id . '-' . $i }}">
                                                    +{{ $i * $a->add_day . ' Hari' . ' - ' . 'Rp' . number_format($i * $a->price, 0) }}</option>
                                                @endfor
                                            </select>
                                            <label class="color-theme opacity-50 text-uppercase font-700 font-10">{{ $a->title }}</label>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="form-group col-lg-12 mx-1">
                                        <div class="input-style input-style-always-active has-borders has-icon mb-4">    
                                            <textarea type="text" data-id="{{ $o->cart_id }}" name="notes" class="form-control" id="notes">{{ $o->details['notes'] }}</textarea>
                                            <label for="note" class="color-theme opacity-50 text-uppercase font-700 font-10">Catatan</label>
                                        </div>
                                        <small class="text-mutes cstring{{ $o->cart_id }}"></small>
                                    </div>
                                </div>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            <div class="col-lg-4 col-sm-12">
                <div class="card">
                    <div class="checkout__order mx-1">
                        <h5 class="text-uppercase m-0">Detail Pembayaran</h5>
                        <div class="checkout__order__product pb-0">
                            <ul class="p-0 my-2">
                                <li>
                                    <span class="top__text">Jasa</span>
                                    <span class="top__text__right">Subtotal</span>
                                </li>
                                <li class="products_subtotal"></li>
                            </ul>
                        </div>
                        <div class="additional_products">
                        </div>
                            <div class="checkout__order__total">
                            <ul class="p-0 my-2">
                                <li>Total <span class="total_price"></span></li>
                            </ul>
                        </div>
                        <button type="button" class="btn btn-exova w-100 savenext">Buat Pesanan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    let content, id, data, words = 0, cart = [];
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
        let calculatePrice = () => {
            $.getJSON("{{ url('cart/data') }}", function (data) {
                let subtotal = 0,
                    total, dataLength,
                    priceAddTotal = 0,
                    addContent = `<div class="checkout__order__product pb-0">
                    <ul class="p-0 my-2">
                    <li>
                    <span class="top__text">Tambahan</span>
                    </li>
                    <li>`,
                    addProduct = ``;
                    dataLength = data.length;
                    let dataAddLength = 0;
                    $.each(data, function (i, data) {
                        $.each(data.additional, function (i, data) {
                        let priceAdd =
                            parseInt(data.quantity) *
                            parseInt(data.additional.price);
                        priceAddTotal += parseInt(priceAdd);
                        addContent += `<div>`
                            + data.additional.title + `(` +data.quantity +`)<span>Rp` +
                            numeral(
                                parseInt(data.quantity) *
                                    parseInt(data.additional.price)
                            ).format("0,0") +
                            `</span></div>
                        `;
                    });
                    dataAddLength = data.additional.length;
                    let prod_price =
                    parseInt(data.unit_price) * parseInt(data.quantity);
                    subtotal += parseInt(prod_price);
                    total = parseInt(subtotal) + parseInt(priceAddTotal);
                });
                addContent += `</li></ul></div>`;
                addProduct +=`Pesanan (` + dataLength + `) <span>` + "Rp" + numeral(subtotal).format("0,0") + `</span>`;
                if(dataAddLength !== 0) {
                    $(".additional_products").html(addContent);
                } else {
                    $(".additional_products").html('');
                }
                $(".products_subtotal").html(addProduct);
                $(".total_price").html("Rp" + numeral(total).format("0,0"));
            });
        };

        calculatePrice();
    function store(id, content, type) {
        $.ajax({
            url: "{{ route('order.update', '"+id+"') }}",
            type: 'PUT',
            data: { id:id, content:content, type:type },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                calculatePrice();
            },
            error: function() {
                //
            },
        });
    }

    $('input[type=date]').on('change', function() {
        id = $(this).attr('data-id');
        content = $(this).val();
        store(id, content, 'Date');
    });
    $('select[name=additional]').on('change', function() {
        id = $(this).attr('data-id');
        content = $(this).val();
        store(id, content, 'Additional');
    });
    $('textarea[name=notes]').on('keyup', function() {
        id = $(this).attr('data-id');
        content = $(this).val();
        words = content.length;
        store(id, content, 'Note');
        $('.cstring' + id).html(words + '/125');
    });
    $('.f_name').on('click', function() {
        id = $(this).attr('data-id');
        store(id, content, 'File');
    });
    $('.savenext').on('click', function() {
        $('.parent').each(function() {
            cart.push($(this).attr('data-id'));
        });
        $.ajax({
            url: "{{ route('cart.finish') }}",
            type: "POST",
            data: { cart_id: cart },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (data) {
                window.location = '/payments';
            },
            error: function () {
                //
            }
        })
    });

    $('.uploadFile').on('change', function(e) {
        e.preventDefault();
            id = $(this).attr('data-id');
            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: `{{ route('order.store') }}`,
            type: 'POST',
            data: new FormData(this),
            cache: false,
            processData: false,
            contentType: false,
            enctype: 'multipart/form-data',
            dataType: 'json',
            xhr: function() {
                let xhr = $.ajaxSettings.xhr();
                xhr.upload.addEventListener('progress', function(event) {
                    if(event.lengthComputable) {
                        let percent = Math.ceil(event.loaded / event.total * 100);
                        $('#progress' + id).html(percent + '%');
                    }
                }, true)
                return xhr;
            },
            success: function(data) {
                Toast.fire({
                    icon: 'success',
                    title: data.status,
                });
                $('#progress' + id).html(data.files);
            },
            error: function(data) {
                //
            }
        });
    });
});
</script>
@endsection