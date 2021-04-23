@extends('layouts.app')
@section('src-scripts')
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-rename/dist/filepond-plugin-file-rename.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
@endsection
@section('src-styles')
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
@endsection

@section('content')
<div class="page-content">
    <div class="container">
        <div class="col">
            <div class="row">
                <div class="scroll-notif">
                    <span class="shortcut-notif" id="pembelian" data-content="menunggu_pembayaran">Pembelian</span>
                    <span class="shortcut-notif" id="penjualan">Penjualan</span>
                    <span class="shortcut-notif" id="dibatalkan">Dibatalkan</span>
                </div>
            </div>
            <h3 class="notif-title"></h3>
                <div class="sub-menu"></div>
                <div class="col-lg-3 col-sm-12 ml-auto">
                    <div class="input-style mt-3 input-style-always-active has-icon mb-4">    
                        <input type="text" class="form-control border rounded-pill" name="search" id="search_id" placeholder="Cari pesanan disini" autocomplete="off">
                    </div>
                </div>
                <div class="notif-content"></div>
            <div class="file-minimize-upload" id="upload-bar">
                <div class="header-upload-bar">
                    <span role="button" class="close-upload-bar"><i class="fas fa-times"></i></span>
                    <span class="count-files float-right"></span>
                </div>
                <div class="file-minimize-body">
                    <input type="file" name="order_files" data-allow-reorder="true"
                    data-max-files="1" id="upload-order-files" data-status="0">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="orderModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
jQuery(function() {
$(document).ready(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

    contents = (params, base, search) => {
        let title, content = '', submenu = ``;
        if(search == '') {
            search = 'null';
        }
        id = params.trim().replace(' ', '_').toLowerCase();
        title = params.replace('_', ' ');
        title = title.trim().replace(/^\w/, (c) => c.toUpperCase());
        $('#search_id').attr('data-content', id);
        $.getJSON( "{{ url('/') }}" + '/web/v2/orders/' + base + '/' + id + '/' + search, function(data) {
            $.each(data, function(i, data) {
                if(data.status !== null) {
                    content += `
                    <div class="row m-0 flex-nowrap p-2">
                        <div class="notif-image">
                                <img class="notif-image-content" src="` + data.products.cover.small + `" alt="">
                            </div>
                            <div class="notif-content-more">
                                <h5 class="mb-1">` + data.products['jasa_name'] + `</h5>
                                <span>` + title + `</span>`;
                                if(['pembelian', 'penjualan'].includes(base)) {
                                    content += `
                                        <div><small>Sisa Waktu : `+ countdown(data.batal_otomatis) + `</small></div>
                                    `;
                                } else if(['dibatalkan'].includes(base)) {
                                    content += `
                                        <div><small>Status : `+ (data.status).trim().replace(/^\w/, (c) => c.toUpperCase()).replace('_', ' ') + `</small></div>
                                    `;
                                }
                            content +=`</div>
                            <div class="notif-btn ml-auto">
                            <button class="detail-btn btn btn-exova" data-label="detail_pesanan" data-id="` + data.order_id + `" data-toggle="modal" data-target="#orderModal"><i class="fas fa-eye" title="Lihat Detail"></i></button>
                            `;
                            if(id === 'menunggu_pembayaran') {
                                content += `
                                    <button class="repay-btn btn btn-success" data-label="detail_pembayaran" data-id="` + data.details.payments.payment_id + `"><i class="fas fa-credit-card"></i></button>
                                    <button class="delete-btn btn btn-danger" data-id="` + data.order_id + `"><i class="fas fa-trash"></i></button>
                                `;
                            } else if(id === 'pesanan_masuk') {
                                content += `
                                    <button class="reject-btn btn btn-danger" data-content="pesanan_ditolak" data-id="` + data.order_id + `" title="Tolak Pesanan"><i class="fas fa-times"></i></button>
                                    <button class="accept-btn btn btn-success" data-content="pesanan_diproses" data-id="` + data.order_id + `" title="Terima Pesanan"><i class="fas fa-check"></i></button>
                                `;
                            } else if(id === 'menunggu_konfirmasi' && base === 'pembelian') {
                                content += `
                                    <button class="reject-btn btn btn-danger" data-content="pesanan_dibatalkan" data-id="` + data.order_id + `" title="Tolak Pesanan"><i class="fas fa-times"></i></button>
                                `;
                            } else if(id === 'pesanan_dikirim' && base === 'pembelian') {
                                content += `
                                    <button class="finish-btn btn btn-success" data-content="pesanan_selesai" data-id="` + data.order_id + `" title="Selesaikan Pesanan"><i class="fas fa-check"></i></button>
                                    <button class="download-btn btn btn-success" data-id="` + data.order_id + `" title="Download"><i class="fas fa-download"></i></button>
                                    <button class="revisi-btn btn btn-primary" data-label="permintaan_revisi" data-id="` + data.order_id + `" data-toggle="modal" data-target="#orderModal" title="Minta Revisi"><i class="fas fa-pencil-alt"></i></button>
                                `;
                            } else if(id === 'pesanan_diproses' && base === 'penjualan') {
                                content += `
                                    <button class="upload-btn btn btn-success" data-label="pesanan_diproses" data-id="`+ data.order_id +`" title="Upload Pesanan"><i class="fas fa-upload"></i></button>
                                `;
                            } else if(id === 'pesanan_selesai' && base === 'pembelian') {
                                content += `
                                    <button class="download-btn btn btn-success" data-id="` + data.order_id + `" title="Download"><i class="fas fa-download"></i></button>
                                `;
                            } else if(id === 'permintaan_revisi' && base === 'penjualan') {
                                content += `
                                    <button class="upload-btn btn btn-success" data-label="permintaan_revisi" data-id="`+ data.order_id +`" title="Upload Revisian"><i class="fas fa-upload"></i></button>
                                `;
                            }
                        content += `
                            </div>
                        </div>
                        `;

                }
            })
            $('.notif-content').html(content);

            $('.download-btn').on('click', function() {
                 window.location = "{{ url('/download/orderan') }}/" + $(this).attr('data-id');
            });
            
            $(".accept-btn").on("click", function () {
                $.ajax({
                    url: "{{ url('order/orderan') }}",
                    type: 'PUT',
                    data: { 
                        id: $(this).attr('data-id'), type: 'orderan', status: $(this).attr('data-content')
                    },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function(data) {
                        path = window.location.pathname.replace('/notifications/', '');
                        contents('menunggu_konfirmasi', path, 'null');
                        Toast.fire({
                            icon: 'success',
                            title: 'Berhasil',  
                        });
                    },
                    error: function(data) {
                        // console.log(data)
                    }
                });
            });
            
            $(".finish-btn").on("click", function () {
                $.ajax({
                    url: "{{ url('order/finish') }}",
                    type: 'PUT',
                    data: { 
                        id: $(this).attr('data-id'), type: 'finish', status: $(this).attr('data-content')
                    },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function(data) {
                        path = window.location.pathname.replace('/notifications/', '');
                        contents('pesanan_dikirim', path, 'null');
                        Toast.fire({
                            icon: 'success',
                            title: 'Berhasil',  
                        });
                    },
                    error: function(data) {
                        // console.log(data)
                    }
                });
            });
            $(".reject-btn").on("click", function () {
                $.ajax({
                    url: "{{ url('order/reject') }}",
                    type: 'PUT',
                    data: { 
                        id: $(this).attr('data-id'), type: 'reject', status: $(this).attr('data-content')
                    },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function(data) {
                        path = window.location.pathname.replace('/notifications/', '');
                        contents('pesanan_masuk', path, 'null');
                        Toast.fire({
                            icon: 'success',
                            title: 'Berhasil',  
                        });
                    },
                    error: function(data) {
                        // console.log(data)
                    }
                });
            });

            $('.delete-btn').on('click', function() {
                $.ajax({
                    url: "{{ url('order') }}/" + $(this).attr('data-id'),
                    data: { id: $(this).attr('data-id') },
                    type: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function(data) {
                        path = window.location.pathname.replace('/notifications/', '');
                        contents('menunggu_pembayaran', path, 'null');
                    },
                    error: function(data) {
                        // console.log(data)
                    }
                });
            });

            
            $('.repay-btn').on('click', function() {
                $.ajax({
                    url: "{{ url('/repayment') }}/" + $(this).attr('data-id'),
                    type: 'GET',
                    success: function(data) {
                        window.open(data.url, '_blank');
                    },
                    error: function(data) {
                        // console.log(data);
                    },
                    beforeSend: function(data) {
                        $('.modal-body').html("Loading...");
                    }
                });
            })
            
            $('.decline-btn').on('click', function() {
                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "Kamu tidak akan bisa mengembalikan ini",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Ya, Tolak!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        Toast.fire({
                        icon: 'success',
                        title: 'Berhasil menghapus',
                        })
                    }
                });
            });

            $('.upload-btn').on('click', function() {
                let orid = $(this).attr('data-id');
                let label = $(this).attr('data-label');
                let status = $('.upload-order-files').attr('data-status');

                if(status == 1) {
                    Swal.fire({
                    title: 'Kamu sedang mengupload data',
                    text: "Mohon tunggu hingga proses upload selesai",
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Oke!'
                    })
                } else {
                    document.getElementById("upload-bar").style.bottom = "-1rem";
                    const inputElement = document.querySelector('input[name="order_files"]');

                    FilePond.registerPlugin(
                        FilePondPluginFileEncode,
                        FilePondPluginImagePreview,
                        FilePondPluginImageExifOrientation,
                        FilePondPluginFileValidateSize,
                        FilePondPluginFileValidateType,
                        FilePondPluginFileRename,
                    );
                    const pond = FilePond.create( inputElement, {
                        labelIdle: `Pilih atau seret file <div><strong>Format : zip, jpg, jpeg, rar, png</strong></div>`,
                        labelFileTypeNotAllowed: `Format tidak sesuai`,
                        allowFileEncode: true,
                        allowFileTypeValidation: true,
                        credits: false,
                        allowRevert: false,
                        allowMultiple: false,
                        allowReplace: true,
                        allowFileSizeValidation: true,
                        maxTotalFileSize: '20MB',
                        acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg',
                        'zip', 'application/octet-stream',
                        'application/zip',
                        'application/x-zip',
                        'application/x-zip-compressed'],
                        labelMaxTotalFileSizeExceeded: 'Maximum total size exceeded',
                        labelMaxTotalFileSize: 'Maximum total file size is {filesize}',
                    } );
                    FilePond.setOptions({
                        server: { 
                            url: "{{ url('/web/v2/uploads/orders/') }}" + "/" + orid + "/" + label,
                            headers: { 
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                            },
                        },
                    });
                    function getUploadStatus(status){
                        let totalFiles = $('.filepond--item').length;
                        let completedFiles = $('.filepond--item[data-filepond-item-state="processing-complete"]').length;
                        let errorFiles = $('.filepond--item[data-filepond-item-state="processing-error"]').length;
                        if(status === 'success') {
                            $('.count-files').html(completedFiles + ' berhasil diupload');
                        } else {
                            $('.count-files').html(errorFiles + ' gagal diupload');
                        }
                        if(totalFiles === completedFiles) {
                            path = window.location.pathname.replace('/notifications/', '');
                            contents(label, path, 'null');
                        }
                    }
                    pond.onprocessfile = (error, response) => {
                        if (error) {
                            getUploadStatus('error')
                        } else {
                            getUploadStatus('success');
                        }
                    }

                    $('.upload-btn').attr('disabled', 'disabled');
                    $('#upload-order-files').attr('data-status', 1);

                    $('.close-upload-bar').on('click', function() {
                        let totalFiles = $('.filepond--item').length;
                        let completedFiles = $('.filepond--item[data-filepond-item-state="processing-complete"]').length;
                        let errorFiles = $('.filepond--item[data-filepond-item-state="processing-error"]').length;
                        if(totalFiles !== 0 && completedFiles == 0) {
                            Swal.fire({
                            title: 'Kamu sedang dalam tahap uploading',
                            text: "Apakah kamu yakin akan membatalkan?",
                            icon: 'warning',
                            showCancelButton: true,
                            cancelButtonColor: '#3085d6',
                            confirmButtonColor: '#d33',
                            cancelButtonText: 'Tidak, Lanjutkan!',
                            confirmButtonText: 'Ya!'
                            }).then((result) => {
                            if (result.isConfirmed) {
                                Toast.fire({
                                icon: 'success',
                                title: 'Berhasil membatalkan',
                                });
                                pond.onprocessfileabort = (file) => {
                                    //
                                }
                                pond.removeFiles();
                                $('.count-files').html('');
                            }
                        });
                        } else if(totalFiles == 0 || completedFiles !== 0 ) {
                            document.getElementById("upload-bar").style.bottom = "-35rem";
                            pond.removeFiles();
                            $('.count-files').html('');
                            $('.upload-btn').removeAttr('disabled');
                            $('.upload-order-files').attr('data-status', 0);
                        }
                    });
                }
            });
        })
    }

    reload = (params) => {
        let notif, content = ``, submenu = ``;
        notif = params.trim().replace(/^\w/, (c) => c.toUpperCase());
        $(".notif-title").html(notif);
        
        window.history.pushState(notif, 'Exova Indonesia - ' + notif, '/notifications/' + notif.toLowerCase());

        path = window.location.pathname.replace('/notifications/', '')

        $('#' + path).addClass("notif-active");
        if(['penjualan', 'pembelian', 'dibatalkan'].includes(path)) {
            submenu += `<div class="scroll-notif">`;

            if(['penjualan', 'pembelian'].includes(path)) {
                if(['penjualan'].includes(path)) {
                    submenu += `<span class="shortcut-product notif-active" data-id="pesanan_masuk">Pesanan Masuk</span>`;
                } else if(['pembelian'].includes(path)) {
                    submenu += `
                        <span class="shortcut-product notif-active" data-id="menunggu_pembayaran">Menunggu Pembayaran</span>
                        <span class="shortcut-product" data-id="menunggu_konfirmasi">Menunggu Konfirmasi</span>
                    `;
                }
                submenu += `
                    <span class="shortcut-product" data-id="pesanan_diproses">Pesanan Diproses</span>
                    <span class="shortcut-product" data-id="pesanan_dikirim">Pesanan Dikirim</span>
                    <span class="shortcut-product" data-id="permintaan_revisi">Permintaan Revisi</span>
                    <span class="shortcut-product" data-id="pesanan_selesai">Pesanan Selesai</span>
                </div>
                `;
            } else if(['dibatalkan'].includes(path)) {
                submenu += `
                    <span class="shortcut-product notif-active" data-id="pesanan_dibatalkan">Pesanan Dibatalkan</span>
                    <span class="shortcut-product" data-id="pesanan_ditolak">Pesanan Ditolak</span>
                    <span class="shortcut-product" data-id="batal_otomatis">Batal Otomatis</span>
                </div>
                `;    
            }
            contents((path === 'penjualan') ? 'Pesanan Masuk' : (path === 'pembelian') ? 'Menunggu Pembayaran' : 'Pesanan Dibatalkan', path, 'null');
        }
        $('.sub-menu').html(submenu);

    $(".shortcut-product").on("click", function () {
        $(".shortcut-product").removeClass("notif-active");
        $(this).addClass("notif-active");
        path = window.location.pathname.replace('/notifications/', '')
        contents($(this).attr('data-id'), path, 'null');
    });

    }
    $(".shortcut-notif").on("click", function () {
        $(".shortcut-notif").removeClass("notif-active");
        $(this).addClass("notif-active");
        let notif = $(this).html();
        reload(notif);
    });

        $("#search_id").on("keyup", function () {
            contents($(this).attr('data-content'), path, $(this).val());
        });

        $('#orderModal').on('show.bs.modal', function(e) {
        let btn = $(e.relatedTarget);
        let content = ``, label = btn.data('label');
        if(label === 'permintaan_revisi') {
            content = `
                <div class="revisi-field">
                    <div class="input-style input-style-always-active has-borders has-icon mb-4">    
                        <textarea type="text" class="form-control" id="reason"></textarea>
                        <label for="reason" class="color-theme opacity-50 text-uppercase font-700 font-10">Apa yang perlu direvisi?</label>
                    </div>
                    <div class="text-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary submit-revisi">Submit</button>
                    </div>
                </div>
            `;
            $('.modal-body').html(content);
        } else if(label === 'detail_pesanan') {
            $.ajax({
                url: "{{ url('order') }}/" + btn.data('id'),
                type: 'GET',
                success: function(data) {
                    content = `
                        <div class="order-detail">
                            <div class="text-center mb-3 logo-field">
                                <img
                                    data-src=""
                                    src="` + data.products.cover.small + `"
                                    width="125"
                                    height="125"
                                    class="rounded-circle shadow-xl preload-img"
                                />
                            </div>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Pembayaran</td>
                                        <td class="text-right text-capitalize font-weight-bold">Rp`+ numeral(data.details.subtotal).format('0,0') +`</td>
                                    </tr>
                                    <tr>
                                        <td>Pembeli</td>
                                        <td class="text-right text-capitalize font-weight-bold">`+ data.customer.name +`</td>
                                    </tr>
                                    <tr>
                                        <td>Penjual</td>
                                        <td class="text-right font-weight-bold">`+ data.products.seller.name +`</td>
                                    </tr>
                                    <tr>
                                        <td>Pesanan</td>
                                        <td class="text-right font-weight-bold">`+ data.products.jasa_name +`</td>
                                    </tr>`;
                                    $.each(data.details.additional, function(i, data) {
                                        content +=
                                        `<tr>
                                            <td>`+ data.title +`</td>
                                            <td class="text-right font-weight-bold">`+ data.quantity +`x +` + data.add_day + ` Hari</td>
                                        </tr>`;
                                    })

                                    content +=
                                    `<tr>
                                        <td>Deadline</td>
                                        <td class="text-right font-weight-bold">`+new Date(data.deadline).toString() +`</td>
                                    </tr>
                                    <tr>
                                        <td>Catatan</td>
                                        <td class="text-right font-weight-bold">`+ data.note +`</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Order</td>
                                        <td class="text-right font-weight-bold">`+ new Date(data.created_at).toString() +`</td>
                                    </tr>
                                    <tr>
                                        <td>Invoice</td>
                                        <td class="text-right text-primary font-weight-bold">`+ data.details.payments.invoice +`</td>
                                    </tr>`;
                                    if(data.example) {
                                        content+=`<tr>
                                            <td>File Contoh</td>
                                            <td class="text-right text-primary font-weight-bold">Download</td>
                                        </tr>`;
                                    }
                                    if(data.revisi_detail) {
                                        content += `
                                        <tr>
                                            <td>Revisi Detail</td>
                                            <td class="text-right font-weight-bold">` + data.revisi_detail.detail + `</td>
                                        </tr>`;
                                    }
                                    if(['pesanan_ditolak', 'pesanan_dibatalkan', 'batal_otomatis'].includes(data.status)) {
                                        content +=`
                                        <tr>
                                            <td>Status Pembatalan</td>
                                            <td class="text-right font-weight-bold">`+ (data.status).trim().replace(/^\w/, (c) => c.toUpperCase()).replace('_', ' ') +`</td>
                                        </tr>`;
                                    }
                                content += `</tbody>
                            </table>
                        </div>
                    `;
                    $('.modal-body').html(content);
                },
                error: function(data) {
                    // console.log(data);
                },
                beforeSend: function(data) {
                    $('.modal-body').html("Loading...");
                }
            });
        }

        $('.submit-revisi').on('click', function() {
            $.ajax({
                url: "{{ url('revision') }}",
                data: { reason: $('#reason').val(), id: btn.data('id') },
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function(data) {
                    path = window.location.pathname.replace('/notifications/', '');
                    contents('pesanan_dikirim', path, 'null');
                    $('#menu-success-2').addClass('menu-active');
                    $('.menu-hider').addClass('menu-active');
                    $('.success-message').text('Permintaan revisi berhasil dikirim');
                    $('.close').click();
                },
                error: function(data) {
                    $('#menu-warning-2').addClass('menu-active');
                    $('.menu-hider').addClass('menu-active');
                    $('.error-message').text('Permintaan revisi gagal karena ' + JSON.parse(data.responseText).statusMessage);
                }
            });
        });

        label = label.replace('_', ' ');
        label = label.trim().replace(/^\w/, (c) => c.toUpperCase());
        $('#orderModalLabel').html(label);
    });

    path = window.location.pathname.replace('/notifications/', '')
    reload(path);
});
});
</script>
@endsection