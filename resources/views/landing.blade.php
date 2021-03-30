@extends('layouts.app')
@section('content')
      <div class="page-content">
        <div
          class="splide double-slider visible-slider slider-no-dots"
          id="double-slider-1"
        >
          <div class="splide__track">
            <div class="splide__list">
              <div class="splide__slide ps-3">
                <div
                  data-card-height="220"
                  class="card shadow-xl rounded-m bg-6"
                >
                  <div class="card-bottom text-center">
                    <h4 class="color-white font-800 mb-3">PWA Ready</h4>
                  </div>
                  <div class="card-overlay bg-gradient"></div>
                </div>
              </div>
              <div class="splide__slide ps-3">
                <div
                  data-card-height="220"
                  class="card shadow-xl rounded-m bg-16"
                >
                  <div class="card-bottom text-center">
                    <h4 class="color-white font-800 mb-3">Bootstrap</h4>
                  </div>
                  <div class="card-overlay bg-gradient"></div>
                </div>
              </div>
              <div class="splide__slide ps-3">
                <div
                  data-card-height="220"
                  class="card shadow-xl rounded-m bg-19"
                >
                  <div class="card-bottom text-center">
                    <h4 class="color-white font-800 mb-3">Dark Mode</h4>
                  </div>
                  <div class="card-overlay bg-gradient"></div>
                </div>
              </div>
              <div class="splide__slide ps-3">
                <div
                  data-card-height="220"
                  class="card shadow-xl rounded-m bg-31"
                >
                  <div class="card-bottom text-center">
                    <h4 class="color-white font-800 mb-3">SCSS & RTL</h4>
                  </div>
                  <div class="card-overlay bg-gradient"></div>
                </div>
              </div>
              <div class="splide__slide ps-3">
                <div
                  data-card-height="220"
                  class="card shadow-xl rounded-m bg-33"
                >
                  <div class="card-bottom text-center">
                    <h4 class="color-white font-800 mb-3">Mobile Kit</h4>
                  </div>
                  <div class="card-overlay bg-gradient"></div>
                </div>
              </div>
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
                                    <h4 class="color-white text-end">****6345</h4>
                                </div>
                            <div class="card-bottom ps-3 pb-2">
                                <h5 class="color-white">Rp20,000,000</h5>
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
                        <li class="col-lg-3 col-sm-10 col-md-12" title="{{ $f->jasa_name }}">
                            <a class="product-seller" href="{{ url('/studios/' . strtolower(str_replace(' ','-',$f->seller['name']))) }}" title="{{ $f->seller['name'] }}">
                                <div class="row m-0">
                                    <div class="product-seller-pp">
                                        <img width="40px" height="40px" src="{{ $f->seller['logo']['medium'] }}" alt="Picture">
                                    </div>
                                    <div class="product-seller-name">
                                        <span>{{ explode(' ', $f->seller['name'])[0] }}</span>
                                    </div>
                                </div>
                            </a>
                            <div class="col-sm-12 col-lg-12 pe-2">
                                <div class="card card-style mr-0 mt-2 text-ellipsis ml-2">
                                <img src="{{ $f->cover['small'] }}" class="img-fluid image-products-250">
                                    <div class="px-2 white-space-normal">
                                    <a href="{{ url('products/' . strtolower(str_replace(' ','-', $f->jasa_name))) }}">
                                    <p class="color-highlight font-600 font-11 mb-n1 pt-1">{{ $f->subcategory['parent']['name'] }}</p>
                                        <h5 class="font-14">{{ $f->jasa_name }}</h5>
                                        <p class="font-12 line-height-s mb-2">
                                          {{ $f->jasa_deskripsi }}
                                        </p>
                                        <!-- <s class="font-12 m-0">Rp</s> -->
                                        <h5 class="font-14 price-rating">Rp{{ number_format($f->jasa_price, 0) }}<span class="float-right"><i class="fa fa-star text-warning"></i>{{ $f->jasa_rating }}</span></h5>
                                        </a>
                                        <div class="d-flex footer-products">
                                            <div class="likers" role="button" data-id="{{ $f->jasa_id }}" title="Tambah ke favorit">
                                                <i class="fa fa-heart"></i>
                                            </div>
                                            <div class="cart-add" role="button" data-id="{{ $f->jasa_id }}" title="Tambah ke keranjang">
                                                <i class="fa fa-shopping-cart"></i>
                                            </div>
                                            <div class="comments font-11" role="button">
                                                Tambah Diskusi
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
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
<div id="menu-success-2" class="menu menu-box-bottom bg-green-dark rounded-m" data-menu-height="335" data-menu-effect="menu-over" style="display: block; height: 335px;">
    <h1 class="text-center mt-4"><i class="fa fa-3x fa-check-circle scale-box color-white shadow-xl rounded-circle"></i></h1>
        <h1 class="text-center mt-3 font-700 color-white">Keren</h1>
            <p class="boxed-text-l success-message color-white opacity-70">

        </p>
    <a href="#" class="close-menu btn btn-m btn-center-m button-s shadow-l rounded-s text-uppercase font-600 bg-white color-black">Keren, Thanks!</a>
</div>
<div id="menu-warning-2" class="menu menu-box-bottom bg-red-dark rounded-m" data-menu-height="335" data-menu-effect="menu-over" style="display: block; height: 335px;">
    <h1 class="text-center mt-4"><i class="fa fa-3x fa-times-circle scale-box color-white shadow-xl rounded-circle"></i></h1>
        <h1 class="text-center mt-3 text-uppercase color-white font-700">Aduchh!</h1>
            <p class="boxed-text-l error-message color-white opacity-70">
            
        </p>
    <a href="#" class="close-menu btn btn-m btn-center-l button-s shadow-l rounded-s text-uppercase font-600 bg-white color-black">Hmmm, Yaudah deh</a>
</div>
<div class="menu-hider"></div>
@endsection
@section('scripts')
<script>
  $(document).ready(function() {
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
                console.log(data);
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
  });
</script>
@endsection
