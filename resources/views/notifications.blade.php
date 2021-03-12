@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col">
        <div class="row">
            <div class="scroll-notif">
                <span class="shortcut-notif" id="update">Update</span>
                <span class="shortcut-notif" id="pesan">Pesan</span>
                <span class="shortcut-notif" id="pembelian">Pembelian</span>
                <span class="shortcut-notif" id="penjualan">Penjualan</span>
            </div>
        </div>
        <h3 class="notif-title"></h3>
            <div class="sub-menu"></div>
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
@endsection
@section('scripts')
<script>
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

    contents = (params, base) => {
        let title, content = '', submenu = ``;
        id = params.trim().replace(' ', '_').toLowerCase();
        title = params.replace('_', ' ');
        title = title.trim().replace(/^\w/, (c) => c.toUpperCase());
        $.getJSON( "{{ url('/') }}" + '/web/v2/orders/' + base + '/' + id, function(data) {
            $.each(data, function(i, data) {
                if(data.status === id) {
                    content += `
                    <div class="row p-2">
                        <div class="notif-image">
                                <img class="notif-image-content" src="https://assets.exova.id/img/1.png" alt="">
                            </div>
                            <div class="notif-content-more">
                                <h5 class="mb-1">` + data.products['jasa_name'] + ` <strong>[` + new Date(data.deadline).toDateString() + `]</strong></h5>
                                <span>` + title + `</span>
                                <div>
                                    <small>` + data.created_at + `</small>
                                </div>
                            </div>
                            <div class="notif-btn ml-auto">
                                <button class="detail-btn btn btn-exova"><i class="fas fa-eye"></i></button>
                                `;
                                if(id === 'menunggu_pembayaran') {
                                    content += `
                                        <button class="delete-btn btn btn-danger"><i class="fas fa-trash"></i></button>
                                    `;
                                } else if(id === 'pesanan_masuk') {
                                    content += `
                                        <button class="accept-btn btn btn-success"><i class="fas fa-check"></i></button>
                                    `;
                                } else if((id === 'pesanan_dikirim' || id === 'permintaan_revisi') && base === 'pembelian') {
                                    content += `
                                        <button class="download-btn btn btn-success"><i class="fas fa-download"></i></button>
                                        <button class="revisi-btn btn btn-primary"><i class="fas fa-pencil-alt"></i></button>
                                    `;
                                    } else if(id === 'pesanan_diproses' && base === 'penjualan') {
                                        content += `
                                            <button class="upload-btn btn btn-success" data-label="pesanan_diproses" data-id="`+ data.order_id +`"><i class="fas fa-upload"></i></button>
                                        `;
                                    } else if(id === 'pesanan_selesai' && base === 'pembelian') {
                                        content += `
                                            <button class="download-btn btn btn-success"><i class="fas fa-download"></i></button>
                                        `;
                                    } else if(id === 'permintaan_revisi' && base === 'penjualan') {
                                        content += `
                                            <button class="upload-btn btn btn-success" data-label="permintaan_revisi" data-id="`+ data.order_id +`"><i class="fas fa-upload"></i></button>
                                        `;
                                    }
                                    content += `
                                        </div>
                                    </div>
                                    `;

                }
            })
            $('.notif-content').html(content);
            
            $(".accept-btn").on("click", function () {
                Toast.fire({
                    icon: 'success',
                    title: 'Pesanan diterima',
                })
            });
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
                            contents(label, path);
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
        if(['penjualan', 'pembelian'].includes(path)) {
            submenu += `<div class="scroll-notif">`;

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
            contents((path === 'penjualan') ? 'Pesanan Masuk' : 'Menunggu Pembayaran', path);

        } else if(['update', 'pesan'].includes(path)) {
            $.getJSON("{{ url('/') }}" + "/web/v2/notification/" + path, function(data) {
                content += `
                <div class="row">
                <div class="notif-image">
                        <img class="notif-image-content" src="https://assets.exova.id/img/1.png" alt="">
                    </div>
                    <div class="notif-content-more">
                        <h5 class="mb-1">`+ notif +`</h5>
                        <span>[Pesanan Masuk]</span>
                        <div>
                            <small>[2021-03-8 15:55]</small>
                        </div>
                    </div>
                    <div class="notif-btn ml-auto">
                        <button class="detail-btn btn btn-exova"><i class="fas fa-eye"></i></button>
                    </div>
                </div>
                `;
                $('.notif-content').html(content);
            });
        }
        $('.sub-menu').html(submenu);

    $(".shortcut-product").on("click", function () {
        $(".shortcut-product").removeClass("notif-active");
        $(this).addClass("notif-active");
        path = window.location.pathname.replace('/notifications/', '')
        contents($(this).attr('data-id'), path);
    });

    }
    $(".shortcut-notif").on("click", function () {
        $(".shortcut-notif").removeClass("notif-active");
        let notif = $(this).html();
        reload(notif);
    });
    path = window.location.pathname.replace('/notifications/', '')
    reload(path);

</script>
@endsection