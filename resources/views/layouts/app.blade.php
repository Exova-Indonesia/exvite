<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="Exova Indonesia adalah platform tempat menyalurkan hobby menjadi uang secara online, cepat, mudah, dan aman">
    <meta name="keywords" content="Freelancer, Exova Indonesia, Exova, E-Commerce, Freelancer Platform, 
    Lowongan Pekerjaan, Marketplace, Studio Online, Desainer, Photographer, Videographer, Web Developers,
    Apps Developers, Undangan Online, Online Invitations, Company Profile, Portfolio">
    <meta name="author" content="Exova Indonesia">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Exova Indonesia') }}</title>
    <link rel="icon" href="{{ ('https://assets.exova.id/img/1.png') }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- add before </body> -->
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-rename/dist/filepond-plugin-file-rename.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://vjs.zencdn.net/7.10.2/video.min.js"></script>

    <script type="text/javascript" src="{{ asset('scripts/custom.js') }}" defer></script>
    <script src="{{ asset('datatables/jquery.dataTables.js') }}" defer></script>
    <script src="{{ asset('datatables-bs4/js/dataTables.bootstrap4.js') }}" defer></script>
    <!-- <script src="{{ asset('tourguide.js/tourguide.min.js') }}" defer></script> -->
    <!-- <script src="{{ asset('sweetalert2/sweetalert2.min.js') }}" defer></script> -->
    <script src="{{ asset('js/main.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('scripts/bootstrap.min.js') }}" defer></script>


    <!--<link rel="dns-prefetch" href="//fonts.gstatic.com">-->
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link rel="manifest" href="_manifest.json" data-pwa-version="set_in_manifest_and_pwa_js">
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/css/fontawesome-all.min.css') }}"/>
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('tourguide.js/tourguide.css') }}">
    <link rel="stylesheet" href="{{ asset('sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link href="https://vjs.zencdn.net/7.10.2/video-js.css" rel="stylesheet" />

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
        <a
          href="{{ url('/notifications') }}"
          class="header-icon header-icon-4"
          ><i class="fas fa-bell"></i
        ></a>
      </div>
      <div id="footer-bar" class="footer-bar-6">
        <a href="{{ url('/studio') }}" class=" @if(Request::is('studio')) active-nav @endif"
          ><i class="fa fa-business-time"></i><span>Studio</span></a
        >
        <a href="index-pages.html"
          ><i class="fa fa-heart"></i><span>Favorit</span></a
        >
      <a href="{{ url('/') }}" class="circle-nav @if(Request::is('/')) active-nav @endif">
      <i class="fa fa-home"></i>
      <span>Beranda</span>
      <em></em><strong><u></u></strong></a>
        <a href="{{ url('/bookings') }}" class=" @if(Request::is('notifications/pembelian') || Request::is('notifications/penjualan')) active-nav @endif"
          ><i class="fa fa-shopping-bag"></i><span>Pesanan</span></a
        >
        <a href="{{ url('/profile') }}" class="@if(Request::is('profile')) active-nav @endif"
          ><i class="fa fa-user"></i><span>Akun</span></a
        >
      </div>
      <div class="page-title page-title-fixed container">
        <h1>@if(Request::is('/')) 
          Exova
          @elseif(Request::segment(1) == 'products')
          Produk
          @elseif(Request::segment(1) == 'cart')
          Keranjang
          @elseif(Request::segment(1) == 'profile')
          Profil
          @endif</h1>
        @if(Request::is('/'))
        <a role="button"
          class="page-title-icon shadow-xl bg-theme color-theme"
          data-menu="menu-main"
          ><i class="fa fa-bars"></i
        ></a>
        @endif
        <a
          href="{{ url('cart') }}"
          class="page-title-icon shadow-xl bg-theme color-theme"
          ><i class="fa fa-shopping-cart"></i
        ></a>
        <a
          href="{{ url('notifications') }}"
          class="page-title-icon shadow-xl bg-theme color-theme"
          ><i class="fa fa-bell"></i
        ></a>
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
    </div>
    @yield('scripts')
</body>
</html>
