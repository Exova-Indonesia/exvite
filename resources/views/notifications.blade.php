@extends('layouts.app')
@section('content')
<div class="container mb-5">
    <div class="col-lg-12">
        <div class="row">
            <div class="scroll-notif">
                <span class="shortcut-notif" id="update">Update</span>
                <span class="shortcut-notif" id="pesan">Pesan</span>
                <span class="shortcut-notif" id="pembelian">Pembelian</span>
                <span class="shortcut-notif" id="penjualan">Penjualan</span>
            </div>
        </div>
        <h3 class="notif-title">All</h3>
        <div class="col-lg-12">
            <div class="row notif-content">

            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    reload = (params) => {
        let notif, content = ``;
        notif = params.trim().replace(/^\w/, (c) => c.toUpperCase());
        $(".notif-title").html(notif);
        
        window.history.pushState(notif, 'Exova Indonesia - ' + notif, '/notifications/' + notif.toLowerCase());

        path = window.location.pathname.replace('/notifications/', '')

        $('#' + path).addClass("notif-active");
        if(['update', 'pesan'].includes(path)) {
            content += `
            <div class="notif-image">
                    <img class="notif-image-content" src="https://assets.exova.id/img/1.png" alt="">
                </div>
                <div class="notif-content-more">
                    <h5 class="mb-1">`+ notif +` Promo Exova Tahun 2021 <strong>[Deadline 27 Jan]</strong></h5>
                    <span>[Pesanan Masuk]</span>
                    <div>
                        <small>[2021-03-8 15:55]</small>
                    </div>
                </div>
                <div class="notif-btn ml-auto">
                    <button class="notif-btn-content btn btn-exova"><i class="fas fa-eye"></i></button>
                    <button class="notif-btn-content btn btn-success"><i class="fas fa-check"></i></button>
                    <button class="notif-btn-content decline-order btn btn-danger"><i class="fas fa-times"></i></button>
            </div>
            `;
        }

        $('.notif-content').html(content);
        $(".notif-btn-content").on("click", function () {
            console.log($(this).html());
        });
        $('.decline-order').on('click', function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
        });
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