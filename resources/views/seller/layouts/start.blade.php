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
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>

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
      @yield('content')
    </div>
    @yield('scripts')
</body>
</html>
