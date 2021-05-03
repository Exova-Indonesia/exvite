<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="@lang('home.header.meta.description')">
    <meta name="keywords" content="@lang('home.header.meta.keywords')">
    <meta name="author" content="Exova Indonesia">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Exova Indonesia') }}</title>
    <link rel="icon" href="{{ ('https://assets.exova.id/img/1.png') }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>

    @yield('src-scripts')
    @yield('src-styles')

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script type="text/javascript" src="{{ asset('scripts/custom.js') }}" defer></script>
    <!-- <script src="{{ asset('tourguide.js/tourguide.min.js') }}" defer></script> -->
    <!-- <script src="{{ asset('sweetalert2/sweetalert2.min.js') }}" defer></script> -->
    <script src="{{ asset('js/main.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('scripts/bootstrap.min.js') }}" defer></script>

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.5/plyr.css" />
    <link rel="manifest" href="_manifest.json" data-pwa-version="set_in_manifest_and_pwa_js">
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/css/fontawesome-all.min.css') }}"/>
    <!-- <link rel="stylesheet" href="{{ asset('tourguide.js/tourguide.css') }}"> -->
    <!-- <link rel="stylesheet" href="{{ asset('sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}"> -->

</head>
  <body class="theme-light" data-highlight="highlight-red">
    <div id="preloader">
      <div class="spinner-border color-highlight" role="status"></div>
    </div>
    <div id="page">
      <div class="header header-auto-show container header-fixed header-logo-center">
        <a href="{{ url('/') }}" class="header-title">Exova</a>
        <a 
          href="{{ url('/cart') }}" 
          class="header-icon header-icon-1"
          ><i class="fas fa-shopping-cart"></i
        ></a>
      @basemenu
        <a
          href="{{ url('/notifications') }}"
          class="header-icon header-icon-4"
          ><i class="fas fa-bell"></i
        ></a>
        @else
        <a
          href="{{ url('/') }}"
          class="header-icon header-icon-4"
          ><i class="fas fa-home"></i
        ></a>
        @endbasemenu
      </div>

      @basemenu
      <div id="footer-bar" class="footer-bar-6">
        <a href="{{ url('/studio') }}" class=" @if(Request::is('studio')) active-nav @endif"
          ><i class="fa fa-business-time"></i><span>Studio</span></a
        >
        <a href="{{ url('/favorit') }}" class=" @if(Request::is('favorit')) active-nav @endif"
          ><i class="fa fa-heart"></i><span>Favorit</span></a
        >
      <a href="{{ url('/') }}" class="circle-nav @if(Request::is('/') || Request::is('products/' . strtolower(str_replace(' ', '-', $seller->jasa_name ?? '')))) active-nav @endif">
      <i class="fa fa-home"></i>
      <span>Beranda</span>
      <em></em><strong><u></u></strong></a>
        <a href="{{ url('/notifications/pembelian') }}" class=" @if(Request::is('notifications/pembelian') || Request::is('notifications/penjualan')) active-nav @endif"
          ><i class="fa fa-shopping-bag"></i><span>Pesanan</span></a
        >
        <a href="{{ url('/profile') }}" class="@if(Request::is('profile')) active-nav @endif"
          ><i class="fa fa-user"></i><span>Akun</span></a
        >
      </div>
      @endbasemenu

      <div class="page-title page-title-fixed container">
        <h1>@if(Request::is('/')) 
          <img src="https://assets.exova.id/img/logo.png" alt="Logo">
          @elseif(Request::segment(1) == 'products')
          Produk
          @elseif(Request::segment(1) == 'cart')
          Keranjang
          @elseif(Request::segment(1) == 'order')
          Order
          @elseif(Request::segment(1) == 'profile')
          Profil
          @elseif(Request::segment(1) == 'favorit')
          Favorit
          @elseif(Request::segment(1) == 'wallet')
          E-Wallet
          @endif</h1>
        @if(Request::is('/'))
        <a role="button"
          class="page-title-icon shadow-xl bg-theme color-theme"
          data-menu="menu-main"
          ><i class="fa fa-bars"></i
        ></a>
        @endif
        @cart
        <a
          href="{{ url('cart') }}"
          class="page-title-icon shadow-xl bg-theme color-theme"
          ><i class="fa fa-shopping-cart"></i
        ></a>
        @else
        <a
          href="{{ url('notifications') }}"
          class="page-title-icon shadow-xl bg-theme color-theme"
          ><i class="fa fa-bell"></i
        ></a>
        @endcart
        @basemenu
        <a
          href="{{ url('notifications') }}"
          class="page-title-icon shadow-xl bg-theme color-theme"
          ><i class="fa fa-bell"></i
        ></a>
        @else
        <a
          href="{{ url('/') }}"
          class="page-title-icon shadow-xl bg-theme color-theme"
          ><i class="fa fa-home"></i
        ></a>
        @endbasemenu
      </div>
      <div class="page-title-clear"></div>
      <div
        id="menu-main"
        class="menu menu-box-left rounded-0"
        data-menu-width="280"
        data-menu-active="nav-welcome"
        data-menu-load="{{ url('components/sidebar') }}"
      ></div>
      @yield('content')
      @yield('modals')
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

    <!-- Modal Review -->
    <div class="modal fade" id="modalReview" tabindex="-1" role="dialog" aria-labelledby="modalReviewLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalReviewLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

          </div>
        </div>
      </div>
    </div>

    </div>
    @yield('scripts')
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
                // console.log(data);
            },
        });
    });

    $(".cart-add").on("click", function () {
        $.ajax({
            url: "{{ url('cart/add') }}",
            type: "POST",
            data: { id: $(this).attr("data-id") },
            headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
              "Access-Control-Allow-Origin": "*",
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
</body>
</html>
