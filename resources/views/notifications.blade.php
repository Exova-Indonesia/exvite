@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col">
        <div class="row">
            <div class="scroll-notif">
                <span class="shortcut-notif" id="update">Update</span>
                <span class="shortcut-notif" id="pesan">Pesan</span>
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

    reload = (params) => {
        let notif, content = ``, submenu = ``;
        notif = params.trim().replace(/^\w/, (c) => c.toUpperCase());
        $(".notif-title").html(notif);
        
        window.history.pushState(notif, 'Exova Indonesia - ' + notif, '/notifications/' + notif.toLowerCase());

        path = window.location.pathname.replace('/notifications/', '')

        $('#' + path).addClass("notif-active");
        if(['update', 'pesan'].includes(path)) {
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
                        <button class="detail-btn btn btn-exova" data-target="#orderModal" data-toggle="modal"><i class="fas fa-eye"></i></button>
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
        $(this).addClass("notif-active");
        let notif = $(this).html();
        reload(notif);
    });

    path = window.location.pathname.replace('/notifications/', '')
    reload(path);

    $('#orderModal').on('show.bs.modal', function(e) {
        let btn = $(e.relatedTarget);
        let content = ``, label = btn.data('label');
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
                                        <td class="text-right text-capitalize font-weight-bold">Rp`+ numeral(data.details.unit_price).format('0,0') +`</td>
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
                                    </tr>
                                    <tr>
                                        <td>Deadline</td>
                                        <td class="text-right font-weight-bold">`+ new Date(data.deadline).toDateString() +`</td>
                                    </tr>
                                    <tr>
                                        <td>Catatan</td>
                                        <td class="text-right font-weight-bold">`+ data.note +`</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Order</td>
                                        <td class="text-right font-weight-bold">`+ new Date(data.created_at).toDateString() +`</td>
                                    </tr>
                                    <tr>
                                        <td>Invoice</td>
                                        <td class="text-right text-primary font-weight-bold">`+ data.invoice +`</td>
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
                                        </tr>
                                    `;
                                    }
                                content += `</tbody>
                            </table>
                        </div>
                    `;
                    $('.modal-body').html(content);
                },
                error: function(data) {
                    console.log(data);
                },
                beforeSend: function(data) {
                    $('.modal-body').html("Loading...");
                }
            });

        label = label.replace('_', ' ');
        label = label.trim().replace(/^\w/, (c) => c.toUpperCase());
        $('#orderModalLabel').html(label);
    });
});
</script>
@endsection