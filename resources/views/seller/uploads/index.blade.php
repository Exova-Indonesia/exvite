@extends('seller.layouts.app')
@section('content')
<form class="formdata" type="POST" enctype="multipart/form-data">
    <div class="my-5">
        <div class="col-lg-12 px-3">
            <div class="cover-field"></div>
            <div class="divider"></div>
            <div class="row my-2">
                <div class="col-lg-4 col-sm-12">
                    <h3 class="font-500">Picture Information</h3>
                    <p>Lorem</p>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <div class="upload-jasa-field p-4 shadow-sm">
                        <div class="col-lg-12 col-sm-12 px-1 picture-field">

                        </div>
                        <div class="row m-0 data-pictures">

                        </div>
                        <div class="text-right">
                            <button type="button" class="btn btn-success add-video">Tambahkan Video</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="video-field"></div>
            <div class="divider"></div>
            <div class="row my-2">
                <div class="col-lg-4 col-sm-12">
                    <h3 class="font-500">Title & Description</h3>
                    <p>Lorem</p>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <div class="upload-jasa-field p-4 shadow-sm">
                        <div class="input-style input-style-always-active has-borders has-icon mb-4">
                            <input type="text" class="form-control" name="title" id="title" autocomplete="off" value="{{ $products->jasa_name }}">
                            <label for="title" class="color-theme opacity-50 text-uppercase font-700 font-10">Nama Portfolio</label>
                        </div>
                        <div class="input-style input-style-always-active has-borders has-icon mb-4">
                            <textarea type="text" class="form-control" name="description" id="descrip">{{ $products->jasa_deskripsi }}</textarea>
                            <label for="descrip" class="color-theme opacity-50 text-uppercase font-700 font-10">Deskripsi Portfolio</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="divider"></div>
            <div class="row my-2">
                <div class="col-lg-4 col-sm-12">
                    <h3 class="font-500">Category & Tags</h3>
                    <p>Lorem</p>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <div class="upload-jasa-field p-4 shadow-sm">
                        <div class="row m-0">
                            <div class="input-style col-lg-6 col-sm-12 pe-1 input-style-always-active has-borders has-icon mb-4">
                                <select type="text" class="form-control" name="category" id="cat">
                                    @if(empty($products->jasa_subcategory))
                                    <option value="" selected hidden disabled>Pilih Kategori</option>
                                    @else
                                    <option value="{{ $products->subcategory->parent['id'] }}" selected hidden>{{ $products->subcategory->parent['name'] }}</option>
                                    @endif
                                    @foreach($category as $s)
                                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                                    @endforeach
                                </select>
                                <label for="cat" class="color-theme opacity-50 text-uppercase font-700 font-10">Category</label>
                            </div>
                            <div class="input-style col-lg-6 col-sm-12 ps-1 input-style-always-active has-borders has-icon mb-4">
                                <select type="text" class="form-control" name="subcategory" id="subcat">
                                    @if(empty($products->jasa_subcategory))
                                    @else
                                    <option value="{{ $products->subcategory['id'] }}" selected hidden>{{ $products->subcategory['name'] }}</option>
                                    @endif
                                </select>
                                <label for="subcat" class="color-theme opacity-50 text-uppercase font-700 font-10">SubCategory</label>
                            </div>
                        </div>
                        <div class="input-style input-style-always-active has-borders has-icon mb-4">
                            <input type="text" class="form-control w-100" name="tags" value="">
                            <label for="tags" class="color-theme opacity-50 text-uppercase font-700 font-10">Hashtags</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="divider"></div>
            <div class="row my-2">
                <div class="col-lg-4 col-sm-12">
                    <h3 class="font-500">Price</h3>
                    <p>Lorem</p>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <div class="upload-jasa-field p-4 shadow-sm">
                        <div class="input-style input-style-always-active has-borders has-icon mb-4">
                            <input type="text" class="form-control" name="price_start" id="price" autocomplete="off" value="Rp{{ number_format($products->jasa_price, 0) }}">
                            <label for="price" class="color-theme opacity-50 text-uppercase font-700 font-10">Start At</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="divider"></div>
                <div class="row my-2">
                    <div class="col-lg-4 col-sm-12">
                        <h3 class="font-500">Revision</h3>
                        <p>Lorem</p>
                    </div>
                    <div class="col-lg-8 col-sm-12">
                        <div class="upload-jasa-field p-4 shadow-sm">
                            
                            <div class="row m-0">
                                <div class="input-style col-lg-2 col-sm-12 px-1 input-style-always-active has-borders has-icon mb-4">    
                                    <input type="hidden" class="form-control" id="revisi_id" value="{{ ($products->additional->where('title', 'Revisi')->first())->id ?? '' }}">
                                    <input type="number" min="0" max="10" class="form-control" name="revisi_count" id="rev_count" value="{{ ($products->additional->where('title', 'Revisi')->first())->quantity ?? 1 }}" autocomplete="off">
                                    <label for="rev_count" class="color-theme opacity-50 text-uppercase font-700 font-10">Quantity</label>
                                </div>
                                <div class="input-style col-lg-5 col-sm-12 px-1 input-style-always-active has-borders has-icon mb-4">    
                                    <input type="text" class="form-control" name="revisi_price" id="rev_price" value="{{ rupiah(($products->additional->where('title', 'Revisi')->first())->price ?? 0) }}" autocomplete="off">
                                    <label for="rev_price" class="color-theme opacity-50 text-uppercase font-700 font-10">Revision Price</label>
                                </div>
                                <div class="input-style col-lg-5 col-sm-12 px-1 input-style-always-active has-borders has-icon mb-4">    
                                    <select type="text" class="form-control" name="revisi_waktu" id="rev_day">
                                    @if(! empty($products->additional->where('title', 'Revisi')->first()))
                                        <option value="{{ ($products->additional->where('title', 'Revisi')->first())->add_day }}" selected hidden>{{ ($products->additional->where('title', 'Revisi')->first())->add_day }} Hari</option>
                                    @endif
                                    @for($i=1; $i<=14; $i++)
                                    <option value="{{ $i }}">{{ $i }} Hari</option>
                                    @endfor
                                    </select>
                                    <label for="rev_day" class="color-theme opacity-50 text-uppercase font-700 font-10">Tambahakan Waktu</label>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            <div class="divider"></div>
            <div class="row my-2">
                <div class="col-lg-4 col-sm-12">
                    <h3 class="font-500">Layanan Tambahan</h3>
                    <p>Lorem</p>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <div class="upload-jasa-field p-4 shadow-sm">
                        <div class="target-additional">
                            @forelse($products->additional->where('title', '!=', 'Revisi') as $d)
                            <div class="row count-additional" id="EX-{{ $loop->iteration }}">
                                <div class="input-style col-lg-3 col-sm-12 px-1 input-style-always-active has-borders has-icon mb-4">
                                    <input type="text" class="form-control" name="add_name" placeholder="name" autocomplete="off" value="{{ $d->title }}">
                                    <input type="hidden" class="form-control" name="id" value="{{ $d->id }}">
                                    <label for="addtional_name" class="color-theme opacity-50 text-uppercase font-700 font-10">Title</label>
                                </div>
                                <div class="input-style col-lg-3 col-sm-5 px-1 input-style-always-active has-borders has-icon mb-4">
                                    <input type="text" class="form-control add_price" name="add_price" placeholder="price" autocomplete="off" value="Rp{{ number_format($d->price, 0) }}">
                                    <label for="addtional_price" class="color-theme opacity-50 text-uppercase font-700 font-10">Price</label>
                                </div>
                                <div class="input-style col-lg-2 col-sm-5 px-1 input-style-always-active has-borders has-icon mb-4">
                                    <input type="text" class="form-control" name="quantity" placeholder="quantity" autocomplete="off" value="{{ $d->quantity }}">
                                    <label for="addtional_price" class="color-theme opacity-50 text-uppercase font-700 font-10">Quantity</label>
                                </div>
                                <div class="input-style col-lg-3 col-sm-5 px-1 input-style-always-active has-borders has-icon mb-4">
                                    <select type="text" class="form-control" placeholder="day" name="add_day">
                                        <option value="{{ $d->add_day }}" selected hidden>{{ $d->add_day }} Hari</option>
                                        @for($i=1; $i<=14; $i++) <option value="{{ $i }}">{{ $i }} Hari</option>
                                            @endfor
                                    </select>
                                    <label for="addtional_day" class="color-theme opacity-50 text-uppercase font-700 font-10">Tambahan Waktu</label>
                                </div>
                                <div class="col-lg-1 col-sm-2 p-3">
                                    <button type="button" class="delete_additional" data-id="{{ $d->id }}" data-count="{{ $loop->iteration }}">
                                        <i class="text-danger font-16 fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            @empty
                            @endforelse
                        </div>
                        <div class="border-dashed p-3 mb-3 text-center add_additional" role="button">
                            <button type="button">Tambahkan Layanan</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row m-0 float-right">
                <div class="m-1">
                    <a href="{{ url('/mystudio/produk') }}" type="button" class="btn btn-danger">Kembali</a>
                </div>
                <div class="m-1">
                    <button type="button" class="btn btn-exova submit">Simpan & Publikasikan</button>
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
    <a href="#" class="close-menu btn btn-m btn-center-m button-s shadow-l rounded-s text-uppercase font-600 bg-white color-black">Great, Thanks!</a>
</div>
<div id="menu-warning-2" class="menu menu-box-bottom bg-red-dark rounded-m" data-menu-height="335" data-menu-effect="menu-over" style="display: block; height: 335px;">
    <h1 class="text-center mt-4"><i class="fa fa-3x fa-times-circle scale-box color-white shadow-xl rounded-circle"></i></h1>
    <h1 class="text-center mt-3 text-uppercase color-white font-700">Aduchh!</h1>
    <p class="boxed-text-l error-message color-white opacity-70">

    </p>
    <a href="#" class="unmodal btn btn-m btn-center-l button-s shadow-l rounded-s text-uppercase font-600 bg-white color-black">Hmmm, Check again?</a>
</div>
<div class="menu-hider"></div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        dataPictures = () => {
            let dataPic = ``,
                fieldPic = ``,
                coverPic = ``;
            $.getJSON("{{ url('/web/v2/products/pictures') }}/" + {{ $products->jasa_id }}, function(data) {
                let maxFiles = 3 - (data.pictures).length;
                fieldPic = `
                    <label for="jp">Picture</label>
                        <input type="file" class="form-control jpclass" 
                    data-allow-reorder="true" name="jasa_picture" data-max-files="` + maxFiles + `" multiple>
                `;
                if(! data.jasa_thumbnail) {
                    coverPic = `
                        <div class="row my-2">
                            <div class="col-lg-4 col-sm-12">
                                <h3 class="font-500">Cover</h3>
                                <p>Lorem</p>
                            </div>
                            <div class="col-lg-8 col-sm-12">
                                <div class="upload-jasa-field p-4 shadow-sm">
                                    <div class="col-lg-12 col-sm-12 px-1 cover-field">
                                    <label for="cover">Cover</label>
                                        <input type="file" id="cover" class="form-control coverclass" 
                                    data-allow-reorder="true" name="cover_picture">
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                }

                if ((data.pictures).length >= 3) {
                    $('.picture-field').removeClass("d-block");
                    $('.picture-field').addClass("d-none");
                } else {
                    $('.picture-field').removeClass("d-none");
                    $('.picture-field').addClass("d-block");
                }
                $.each(data.pictures, function(i, index) {
                    dataPic += `
                        <div class="col-lg-4 col-sm-12 col-md-6">
                            <div class="delete-picture" role="button" data-id="` + index.id + `"><i class="fa fa-trash text-danger"></i></div>`;
                    if (index.id === parseInt(data.jasa_thumbnail)) {
                        dataPic += `<div class="cover-picture"><span>Cover</span></div>`;
                    }
                    dataPic += `<img class="p-1 my-pictures-portfolio" src="` + index.medium + `" alt="">
                        </div>
                    `;
                })
                $('.picture-field').html(fieldPic);
                $('.data-pictures').html(dataPic);
                $('.cover-field').html(coverPic);
                $('.delete-picture').on('click', function() {
                    let id = $(this).attr('data-id');
                    $.ajax({
                        url: "{{ url('/picture') }}/" + id,
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function(data) {
                            dataPictures();
                        },
                        error: function(data) {
                            // console.log(data)
                        }
                    });
                });
                const pictures = {
                    labelMaxTotalFileSizeExceeded: `Ukuran file melebihi batas`,
                    labelMaxTotalFileSize: `Maksimal total ukuran file adalah {filesize}`,
                    labelMaxFileSize: `Maksimal ukuran file adalah {filesize}`,
                    checkValidity: true,
                    labelFileTypeNotAllowed: `Format tidak sesuai`,
                    allowFileEncode: true,
                    allowFileTypeValidation: true,
                    credits: false,
                    labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
                    imagePreviewHeight: 175,
                    allowReplace: true,
                    allowFileSizeValidation: true,
                    acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg'],
                    maxTotalFileSize: '25MB',
                    server: {
                        url: "{{ route('upload.pictures') }}",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                    },
                }
                const videos = {
                    labelMaxTotalFileSizeExceeded: `Ukuran file melebihi batas`,
                    labelMaxFileSizeExceeded: `Ukuran file terlalu besar`,
                    labelMaxTotalFileSize: `Maksimal total ukuran file adalah {filesize}`,
                    labelMaxFileSize: `Maksimal ukuran file adalah {filesize}`,
                    checkValidity: true,
                    labelFileTypeNotAllowed: `Format tidak sesuai`,
                    allowFileEncode: true,
                    allowFileTypeValidation: true,
                    credits: false,
                    labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
                    allowReplace: true,
                    acceptedFileTypes: ['video/mp4', 'video/avi', 'video/mov', 'video/3gp'],
                    allowFileSizeValidation: true,
                    maxTotalFileSize: '150MB',
                    maxFileSize: '75MB',
                    server: {
                        url: "{{ route('upload.pictures') }}",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                    },
                }
                FilePond.registerPlugin(
                    FilePondPluginFileEncode,
                    FilePondPluginImagePreview,
                    FilePondPluginImageExifOrientation,
                    FilePondPluginFileValidateSize,
                    FilePondPluginFileValidateType,
                );
                const pond = FilePond.create(document.querySelector('input[name="jasa_picture"]'), pictures);
                FilePond.create(document.querySelector('input[name="cover_picture"]'), pictures);
                pond.on('warning', (error, file) => {
                    if (error.body === "Max files") {
                        $('#menu-warning-2').addClass("menu-active");
                        $('.menu-hider').addClass("menu-active");
                        $('.error-message').html("Max files upload is 3");
                    }
                });
                // Video Field
                $('.add-video').on('click', function() {
                    let videoField = ``;
                    let count = 0;
                    let videoMax = 2 - (data.videos).length;
                    videoField += `
                    <div class="divider"></div>
                    <div class="row my-2">
                        <div class="col-lg-4 col-sm-12">
                            <h3 class="font-500">Video Information</h3>
                            <p>Lorem</p>
                        </div>
                        <div class="col-lg-8 col-sm-12">
                            <div class="upload-jasa-field p-4 shadow-sm">
                                <div class="col-lg-12 col-sm-12 px-1 video-input">
                                    <label for="video">Video</label>
                                        <input type="file" id="video" class="form-control videoclass" 
                                    data-allow-reorder="true" name="jasa_video" data-max-files="`+ videoMax +`" multiple>
                                </div>
                                <div class="row m-0">`;
                                $.each(data.videos, function(i, index) {
                                    videoField +=
                                    `<div class="col-lg-6 col-sm-12 py-1">
                                        <video class="data-videos" id="player`+ count +`" playsinline controls>
                                            <source src="{{ storage('`+ index.path +`') }}" />
                                        </video>
                                        <div class="text-right">
                                            <button class="delete-video p-1" role="button" data-id="` + index.id + `"><i class="fa fa-trash font-18 text-danger"></i></button>
                                        </div>
                                    </div>
                                    `;
                                    count++;
                                });
                                videoField +=
                                `</div>
                            </div>
                        </div>
                    </div>
                    `;
                    $('.video-field').html(videoField);
                    FilePond.create(document.querySelector('input[name="jasa_video"]'), videos);
                    const player = Array.from(document.querySelectorAll('.data-videos')).map(p => new Plyr(p, {
                        hideControls: true,
                        controls: ['play-large', 'play', 'progress'],
                    }));
                    if ((data.videos).length >= 2) {
                        $('.video-input').removeClass("d-block");
                        $('.video-input').addClass("d-none");
                    } else {
                        $('.video-input').removeClass("d-none");
                        $('.video-input').addClass("d-block");
                    }
                    $('.delete-video').on('click', function() {
                        let id = $(this).attr('data-id');
                        $.ajax({
                            url: "{{ url('/video') }}/" + id,
                            type: "DELETE",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            success: function(data) {
                                dataPictures();
                            },
                            error: function(data) {
                                // console.log(data)
                            }
                        });
                    });
                });
            });
        }
        $('.unmodal').on('click', function() {
            $('#menu-warning-2').removeClass("menu-active");
            $('.menu-hider').removeClass("menu-active");
        });
        dataPictures();
        let counter = 0;
        $('.add_additional').on('click', function() {
            counter = $('.count-additional').length;
            counter++;
            let content = `
            <div class="row count-additional" id="EX-` + counter + `">
                <div class="input-style col-lg-3 col-sm-12 px-1 input-style-always-active has-borders has-icon mb-4">    
                    <input type="text" class="form-control" name="add_name" placeholder="name" autocomplete="off">
                        <label for="addtional_name" class="color-theme opacity-50 text-uppercase font-700 font-10">Title</label>
                </div>
                <div class="input-style col-lg-2 col-sm-12 px-1 input-style-always-active has-borders has-icon mb-4">    
                    <input type="number" min="0" class="form-control" name="quantity" placeholder="quantity" autocomplete="off">
                        <label for="addtional_name" class="color-theme opacity-50 text-uppercase font-700 font-10">Quantity</label>
                </div>
                <div class="input-style col-lg-3 col-sm-5 px-1 input-style-always-active has-borders has-icon mb-4">    
                    <input type="text" class="form-control add_price" name="add_price" placeholder="price" autocomplete="off">
                        <label for="addtional_price" class="color-theme opacity-50 text-uppercase font-700 font-10">Price</label>
                </div>
                <div class="input-style col-lg-3 col-sm-5 px-1 input-style-always-active has-borders has-icon mb-4">    
                    <select type="text" class="form-control" placeholder="day" name="add_day">`
            for (let i = 1; i <= 14; i++) {
                content += `<option value="` + i + `">` + i + ` Hari</option>`
            }
            content += `</select>
                        <label for="addtional_day" class="color-theme opacity-50 text-uppercase font-700 font-10">Tambahan Waktu</label>
                </div>
                <div class="col-lg-1 col-sm-2 p-3">
                    <button type="button" class="delete_additional" data-count="` + counter + `">
                        <i class="text-danger font-16 fa fa-trash"></i>
                    </button>
                </div>
            </div>
            `;
            $('.target-additional').append(content);

            $('.delete_additional').on('click', function() {
                let count = $(this).attr('data-count');
                $('#EX-' + count).remove();
            });
            $('.add_price').on('keyup', function() {
                $(this).val('Rp' + numeral($(this).val()).format("0,0"))
            });
        });
        $('.add_price').on('keyup', function() {
            $(this).val('Rp' + numeral($(this).val()).format("0,0"))
        });

        $('.delete_additional').on('click', function() {
            let count = $(this).attr('data-count');
            let id = $(this).attr('data-id');
            $.ajax({
                url: "{{ url('/mystudio') }}/" + id,
                type: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(data) {
                    // console.log(data);
                },
                error: function(data) {
                    // console.log(data)
                }
            });
            $('#EX-' + count).remove();
        });

        // $('.delete').on('click', function() {
        //     $.ajax({
        //         url: "{{ url('/products') }}/" + {{ $products->jasa_id }},
        //         type: "DELETE",
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        //         },
        //         success: function(data) {
        //             $('.success-message').html(data.message);
        //             $('#menu-success-2').addClass('menu-active');
        //             $('.menu-hider').removeClass("menu-active");
        //             setInterval(() => {
        //                 window.location = data.url;
        //             }, 1000);
        //         },
        //         error: function(data) {
        //             // 
        //         },
        //     });
        //     $('#EX-' + count).remove();
        // });

        $('.submit').on('click', function() {
            let values = [];
            $('.target-additional .count-additional').each(function(index, field) {
                let data = {};
                $(field).find(".form-control").each(function(index, input) {
                    data[input.name] = input.value;
                });
                values.push(data);
            });
            let datainfo = [],
            datavideo = [];
            let info = {},
                pic = {};
            info['title'] = $('#title').val(),
                info['description'] = $('#descrip').val(),
                info['subcategory'] = $('#subcat').val(),
                info['price_start'] = $('#price').val(),
                info['revisi_count'] = $('#rev_count').val()
            info['revisi_price'] = $('#rev_price').val(),
                info['revisi_waktu'] = $('#rev_day').val(),
                info['revisi_type'] = 'Revision',
                info['cover_picture'] = $('input[name=cover_picture]').val(),
                info['rev_id'] = $('#revisi_id').val(),
                $('input[name=jasa_picture]').each(function(index, picture) {
                    datainfo.push(picture.value);
                })
                $('input[name=jasa_video]').each(function(index, video) {
                    datavideo.push(video.value);
                })

            $.ajax({
                url: "{{ url('/mystudio/' . $products->jasa_id) }}",
                // url: "https://webhook.site/7d655689-c052-43a8-900b-9a9d76c8e0f9",
                type: "PUT",
                data: {
                    data: values,
                    info: info,
                    picture: datainfo,
                    video: datavideo,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(data) {
                    if (data.status == 200) {
                        $('.success-message').html(data.message);
                        $('#menu-success-2').addClass('menu-active');
                        $('.menu-hider').removeClass("menu-active");
                        setInterval(() => {
                            window.location = data.url;
                        }, 1000);
                    }
                },
                error: function(data) {
                    // console.log(data)
                }
            });
        });
        

        $('#rev_price').on('keyup', function() {
            $(this).val('Rp' + numeral($(this).val()).format("0,0"))
        });

        $('#price').on('keyup', function() {
            $(this).val('Rp' + numeral($(this).val()).format("0,0"))
        });


        $('#cat').on('change', function() {
            let content = ``;
            $.getJSON("{{ url('/web/v2/subcategory') }}/" + $(this).val(), function(data) {
                $.each(data, function(i, data) {
                    content += `
                        <option value="` + data['id'] + `">` + data['name'] + `</option>
                    `;
                });
                $('#subcat').html(content);
            });
        });
    });
   
</script>
@endsection