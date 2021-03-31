@extends('layouts.app')
@section('content')
<div class="container mb-5">
    <div class="col-lg-12">
        <div class="row m-0">
            <div class="col-lg-7 col-sm-12 p-0 mx-1">
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
                                            <p class="mb-0 text-muted"> {{ Auth::user()->address->city }} </p>
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
                                        <div class="input-style input-style-always-active has-borders has-icon mb-4">    
                                            <input type="date" data-id="{{ $o->cart_id }}" class="form-control" id="title" value="{{ date('Y-m-d', strtotime($o->deadline)) }}">
                                            <label for="title" class="color-theme opacity-50 text-uppercase font-700 font-10">Deadline Proyek</label>
                                        </div>
                                        @error('produk')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-12">
                                        <input type="file" data-id="{{ $o->cart_id }}" name="example" class="form-control" id="examples">
                                    </div>
                                    <div class="form-group col-lg-12 mx-1">
                                        <div class="input-style input-style-always-active has-borders has-icon mb-4">    
                                            <textarea type="text" data-id="{{ $o->cart_id }}" name="notes" class="form-control" id="notes">{{ $o->note }}</textarea>
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
            <div class="col-lg-4 col-sm-12 mx-1">
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
    const uploadOptions = {
        checkValidity: true,
        labelFileTypeNotAllowed: `Format tidak sesuai`,
        allowFileEncode: true,
        allowFileTypeValidation: true,
        credits: false,
        labelIdle: `<span class="filepond--label-action">Pilih</span> contoh proyek`,
        imagePreviewHeight: 175,
        allowReplace: true,
        allowFileSizeValidation: true,
        // maxFiles: maxFiles,
        maxTotalFileSize: '50MB',
    }
    FilePond.registerPlugin(
        FilePondPluginFileEncode,
        FilePondPluginImagePreview,
        FilePondPluginImageExifOrientation,
        FilePondPluginFileValidateSize,
        FilePondPluginFileValidateType,
    );
    const pond = FilePond.create( document.querySelector('input[name="example"]'), uploadOptions );
    pond.on('warning', (error, file) => {
        if(error.body === "Max files") {
            $('#menu-warning-2').addClass("menu-active");
            $('.menu-hider').addClass("menu-active");
            $('.error-message').html("Max files upload is 3");
        }
    });
        FilePond.setOptions({
        server: { 
            url: "{{ route('upload.pictures') }}",
            headers: { 
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        },
    });

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