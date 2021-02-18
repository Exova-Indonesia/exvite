@extends('layouts.app')
@section('content')
<div class="container mb-5">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-8 p-0">
                <div class="card mb-2 border-0">
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
                                            <p class="mb-0 text-muted"> {{ Auth::user()->phone }} </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php $i = 1; ?>
                            @foreach($order as $o)
                            <li class="list-group-item parent" data-id="{{ $o->cart_id }}">
                                <div class="form-group p-0 col-md-12">
                                    <div class="mb-2"><strong>Pesanan <?php echo $i++ ?></strong></div>
                                    <div class="mb-3">
                                        <h5 class="m-0"> {{ $o->jasa->seller->name }} </h5>
                                        <small> {{ $o->jasa->seller->address->city }} </small>
                                    </div>
                                    <div class="row mb-3">
                                        <div><img class="mx-2 border p-2" width="70px" height="70px" src="{{ $o->jasa->jasa_thumbnail }}" alt="Thumbnail"></div>
                                        <div class="ml-3">
                                            <p class="m-0"> {{ $o->jasa->jasa_name }}</p>
                                            <p class="m-0"><small>Tipe Pesanan : {{ $o->product_type }}</small></p>
                                            <p class="m-0"><span><strong>IDR {{ number_format($o->unit_price, 0) }}</strong></span></p>
                                        </div>
                                    </div>
                                </div>
                                @if($o->product_type == 'Jasa')
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="title">Deadline Proyek <span class="text-danger">*</span></label>
                                        <input type="date" data-id="{{ $o->cart_id }}" id="title" class="form-control" value="{{ date('Y-m-d', strtotime($o->deadline)) }}">
                                        @error('produk')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <form class="uploadFile" data-id="{{ $o->cart_id }}" type="POST" enctype="multipart/form-data">
                                            @csrf
                                            <label for="uploadFile{{ $o->cart_id }}">Contoh Proyek</label>
                                            <input type="hidden" name="id" value="{{ $o->cart_id }}">
                                            <input type="file" id="uploadFile{{ $o->cart_id }}" data-id="{{ $o->cart_id }}" class="form-control" name="example">
                                            <small>
                                                <span data-id="{{ $o->cart_id }}" id="progress{{ $o->cart_id }}" class="text-danger f_name" role="button">
                                                    {{ $o->example_ori }}
                                                </span>
                                            </small>
                                        </form>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label for="note">Catatan</label>
                                        <textarea name="note" data-id="{{ $o->cart_id }}" id="note" cols="10" rows="5" class="form-control">{{ $o->note }}</textarea>
                                        <small class="text-mutes cstring{{ $o->cart_id }}"></small>
                                    </div>
                                </div>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-white border-0">
                        <h5 class="m-0">@lang('payments.cart.paymenttitle')</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="mb-2">
                                <span class="text-muted">@lang('payments.cart.subtotal') ({{ count($order) }})</span>
                                    <span class="float-right text-right buy_price_cart"></span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <strong>Total Tagihan</strong>
                                <span class="float-right text-right buy_price_cart"></span>
                            </li>
                            <button type="button" class="btn btn-success savenext">Simpan & Lanjutkan</button>

                            <!-- <div class="mx-auto">
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
                            </div> -->
                        </ul> 
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
    function store(id, content, type) {
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('order.update', '"+id+"') }}",
            type: 'PUT',
            data: { id:id, content:content, type:type },
            success: function(data) {
                if(data.type == 'File') {
                    Toast.fire({
                        icon: 'error',
                        title: data.status,
                    })
                    $('#progress' + id).html('');
                    $('#uploadFile' + id).val('');
                }
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
    $('textarea[name=note]').on('keyup', function() {
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Access-Control-Allow-Origin': '*',
            }
        });
        $.ajax({
            url: "{{ route('cart.finish') }}",
            type: "POST",
            data: { cart_id: cart },
            success: function (data) {
                if (data.status) {
                    Toast.fire({
                        icon: 'error',
                        title: data.status,
                    })
                } else {
                    window.location = '/payments';
                }
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