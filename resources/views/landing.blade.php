@extends('layouts.app')
@section('content')
      <div class="page-content">
        <div
          class="splide double-slider visible-slider slider-no-dots"
          id="double-slider-1"
        >
          <div class="splide__track">
            <div class="splide__list">
              @foreach($category as $s)
              <div class="splide__slide ps-3">
                <div
                  data-card-height="220"
                  class="card shadow-xl rounded-m bg-6"
                >
                  <div class="card-bottom text-center">
                    <h4 class="color-white font-800 mb-3">{{ $s->name }}</h4>
                  </div>
                  <div class="card-overlay bg-gradient"></div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
        <div class="container mb-5">
            <div class="col-lg-6 m-auto">
                <div class="input-group mb-4 border rounded-pill p-2">
                    <div class="input-group-prepend border-0">
                        <button type="button" class="btn btn-link text-info">
                            <i class="fa fa-search h3 mb-0 align-bottom" aria-hidden="true"></i>
                        </button>
                    </div>
                        <input id="search" type="search" autocomplete="off" placeholder="@lang('home.header.search')" aria-describedby="button-addon4" class="form-control bg-transparent border-0">
                </div>
            </div>
            <div class="row col-lg-8 m-auto">
                <div class="col-5 px-1">
                    <div class="card mx-0 mb-2 card-style bg-33" data-card-height="130">
                        <div class="card-bottom">
                            <h2 class="color-white text-center mb-n1">Banners</h2>
                            <p class="color-white text-center opacity-50 pb-3">
                                Promo &amp; Promo
                            </p>
                        </div>
                    </div>
                        <a class="card mx-0 mb-2 card-style bg-20" data-card-height="130">
                            <div class="card-top ps-3 pt-3">
                                <h1 class="color-white font-19">Saldo</h1>
                            </div>
                                <div class="card-center pe-3">
                                    <h4 class="color-white text-end">****{{ substr($balance->wallet_id, -4) }}</h4>
                                </div>
                            <div class="card-bottom ps-3 pb-2">
                                <h5 class="color-white">Rp{{ number_format($balance->balance, 0) }}</h5>
                            </div>
                            <div class="card-overlay bg-gradient"></div>
                        </a>
                    </div>
                <div class="col-7 px-1">
                    <a class="card mx-0 card-style default-link bg-6" data-card-height="270">
                        <div class="card-bottom">
                            <h2 class="color-white text-center mb-n1">Banners</h2>
                            <p class="color-white text-center opacity-50 pb-3">
                                Promo &amp; Promo
                            </p>
                        </div>
                        <div class="card-overlay bg-gradient"></div>
                    </a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="col-12">
                <div class="section-title">
                    <h2 class="s-title d-block">Terlaris <a href="{{ url('/products/terlaris') }}" class="text-capitalize font-14">Lihat Semua</a></h2>
                </div>
                <div class="row mx-2">
                    <ul class="product-slide col-lg-12">
                      @forelse($seller as $f)
                        <x-productcard :products="$f" />
                      @empty
                      @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <div class="card card-style">
          <h4 class="font-28 text-center color-theme font-800 pt-3 mt-3">
            Exova
          </h4>
          <p class="boxed-text-l mb-4">
            @lang('home.header.description')
          </p>
          <div class="text-center mb-4">
            <a
              href="#"
              class="icon icon-xs rounded-sm shadow-l mr-1 bg-facebook"
              ><i class="fab fa-facebook-f"></i
            ></a>
            <a href="#" class="icon icon-xs rounded-sm shadow-l mr-1 bg-twitter"
              ><i class="fab fa-twitter"></i
            ></a>
            <a href="#" class="icon icon-xs rounded-sm shadow-l mr-1 bg-phone"
              ><i class="fa fa-phone"></i
            ></a>
            <a
              href="#"
              data-menu="menu-share"
              class="icon icon-xs rounded-sm mr-1 shadow-l bg-red-dark"
              ><i class="fa fa-share-alt"></i
            ></a>
            <a
              href="#"
              class="back-to-top icon icon-xs rounded-sm shadow-l bg-highlight color-white"
              ><i class="fa fa-arrow-up"></i
            ></a>
          </div>
          <div class="divider mb-3"></div>
          <div class="row text-center mb-3 pl-3 pr-3">
            <a class="font-11 col-4" href="#">Privacy Policy</a>
            <a class="font-11 col-4" href="#">Terms of Service</a>
            <a class="font-11 col-4" href="#">About Exova</a>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
@section('modals')

@endsection
@section('scripts')
<script>
  $(document).ready(function() {
    $('#modalReview').on('show.bs.modal', function(e) {
      let btn = $(e.relatedTarget);
      $.ajax({
        url: "{{ url('web/v2/rating') }}/" + btn.data('id'),
        type: "GET",
        success: function(data) {
          let content = ``;
          $.each(data, function(i, data) {
            content += `
              <div class="row m-0">
                <div class="me-2">
                  <img class="rounded-circle" src="` + data.users.avatar.small + `" width="50" height="50" alt="Profile Picture">
                </div>
                <div class="review-content">
                  <h5 class="m-0">` + data.users.name + `</h5>
                  <p class="m-0">` + data.content + `</p>
                </div>
                <div class="ml-auto text-right">
                  <div><small>` + new Date(data.created_at).toDateString() + `</small></div>
                  <div><small>` + numeral(data.rating).format('0.00') + ` <i class="fa fa-star text-warning"></i> </small></div>
                </div>
              </div>
              <div class="divider m-3"></div>
            `;
          });
          $('.modal-body').html(content)
          $('.modal-title').html('Review & Rating')
        },
        error: function(data) {
          // 
        },
        beforeSend: function(data) {
          $('.modal-body').html('Loading...');
        }
      });
    });
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
                // console.log(data);
            },
        });
    });

    $(".cart-add").on("click", function () {
        let id;
        id = $(this).attr("data-id");

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                "Access-Control-Allow-Origin": "*",
            },
        });
        $.ajax({
            url: "{{ url('cart/add') }}",
            type: "POST",
            data: { id: id },
            success: function (data) {
              $('#menu-success-2').addClass('menu-active');
              $('.menu-hider').addClass('menu-active');
              $(".success-message").text(data.statusMessage);
            },
            error: function (data) {
              $('#menu-warning-2').addClass('menu-active');
              $('.menu-hider').addClass('menu-active');
              $(".error-message").text(JSON.parse(data.responseText).statusMessage);
            },
        });
    });
    $(".favorit-add").on("click", function () {
      let id;
      id = $(this).attr("data-id");
      $.ajax({
        url: "{{ route('products.favorit') }}",
        type: "POST",
        data: { id: id },
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (data) {
          $('#menu-success-2').addClass('menu-active');
          $('.menu-hider').addClass('menu-active');
          $(".success-message").text(data.statusMessage);
        },
        error: function (data) {
          $('#menu-warning-2').addClass('menu-active');
          $('.menu-hider').addClass('menu-active');
          $(".error-message").text(JSON.parse(data.responseText).statusMessage);
        },
      });
    });
  });
</script>
@endsection
