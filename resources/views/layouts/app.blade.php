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

    <!-- Scripts -->
    <script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}" defer></script>
    <script src="{{ asset('js/vendor/jquery-ui.js') }}" defer></script>
    <script src="{{ asset('js/vendor/bootstrap.min.js') }}" defer></script>

    <script src="{{ asset('js/owl.carousel.min.js') }}" defer></script>
    <script src="{{ asset('js/contact-form.js') }}" defer></script>
    <script src="{{ asset('js/ajaxchimp.js') }}" defer></script>
    <script src="{{ asset('js/scrollUp.min.js') }}" defer></script>
    <script src="{{ asset('js/magnific-popup.min.js') }}" defer></script>
    <script src="{{ asset('js/wow.min.js') }}" defer></script>
    <script src="{{ asset('particles.js/particles.js') }}" defer></script>
    <script src="{{ asset('tourguide.js/tourguide.min.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    

    <!--<link rel="dns-prefetch" href="//fonts.gstatic.com">-->
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/linearicons.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="tourguide.js/tourguide.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/timeline.css">

</head>
<body data-spy="scroll" data-target=".mainmenu-area" data-component="intro">
    <div id="app">
        <nav class="navbar mainmenu-area navbar-expand-md fixed-top p-3" data-spy="affix" data-offset-top="200">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ ('https://assets.exova.id/img/logo.png') }}" alt="Logo">
                </a>
                <button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse text-white" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto ">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto text-center">
                        <!-- Authentication Links -->
                        <li class="nav-item active">
                            <a class="nav-link" href="#dashboard_page">@lang('header.header.home')<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#services_page"> Layanan </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#faq">Bantuan</a>
                        </li>
                            <a class="nav-link" href="#tentang">Tentang Kami</a>
                        </li>
                        @guest
                                <li class="nav-item">
                                    <a class="btn btn-danger m-1 mr-2" href="#membership">Go Premium</a>
                                </li>
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="btn btn-outline-primary m-1" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-primary m-1" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a class="btn btn-danger m-1 mr-2" href="#membership">Go Premium</a>
                                <a id="navbarDropdown" class="navbar-brand dropdown-toggle ml-3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img class="rounded-circle" src="{{ Auth::user()->avatar }}" width="40" height="40" alt="avatar">
                                </a>

                                <div class="dropdown-menu dropdown-menu-right p-3" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-center pb-3">
                                        <img class="rounded-circle" src="{{ Auth::user()->avatar }}" width="80" height="80" alt="avatar">
                                        <h5 class="text-uppercase m-2">
                                            {{ Auth::user()->name }}
                                            <i role="button" class="fa fa-power-off text-danger" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"></i>
                                        </h5>
                                        <span> Bronze Customer </span>
                                    </a>
                                    <div class="border-top py-2">
                                        <div class="py-1"><a href="#">Pendapatan<span class="float-right">IDR 0</span></a></div>
                                        <div class="py-1"><a href="#">Refund<span class="float-right">IDR 0</span></a></div>
                                    </div>
                                    <a class="btn btn-primary w-100" href="#">
                                        {{ __('Lihat Profil') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="preloader">
            <span><img width="40px" height="40px" src="{{ ('https://assets.exova.id/img/1.png') }}"></span>
        </div>
        <main>
            @yield('content')
        </main>
    </div>
</body>
    <footer class="footer">
        <div class="container">
            <div class="col footer-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="footer-header">
                            <img src="{{ ('https://assets.exova.id/img/logo.png') }}">
                        </div>
                        <span>Exova Indonesia adalah tempat menyalurkan hobby jadi uang</span>
                    </div>
                    <div class="col-md-3">
                        <div class="footer-header">
                            Exova
                        </div>
                        <div><a href="#">Blog</a></div>
                        <div><a href="#">Bantuan</a></div>
                        <div><a href="#">Tentang Exova</a></div>
                        <div><a href="#">Exova Membership</a></div>
                    </div>
                    <div class="col-md-2">
                        <div class="footer-header">
                            Layanan
                        </div>
                        <div><a href="#">Exova Jasa</a></div>
                        <div><a href="#">Exova Creations</a></div>
                    </div>
                    <div class="col-md-3" data-component="follow">
                        <div class="footer-header">
                            Dapatkan Info Menarik
                        </div>
                        <div class="footer__newslatter">
                            <form action="#">
                                <input type="text" placeholder="Email">
                                <button type="submit" class="site-btn">Ikuti</button>
                            </form>
                            <div class="footer__social">
                                <a href="#"><i class="fab p-3 rounded-pill fa-twitter"></i></a>
                                <a href="#"><i class="fab p-3 rounded-pill fa-facebook"></i></a>
                                <a href="#"><i class="fab p-3 rounded-pill fa-instagram"></i></a>
                                <a href="#"><i class="fab p-3 rounded-pill fa-linkedin"></i></a>
                                <a href="#"><i class="fa p-3 rounded-pill fa-share-alt"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-cp">
                <span class="text-muted">{{ date('Y') }} {{ ('Copyright | ') }}<a href="#">{{ ('Exova Indonesia') }}</a></span>
                <div class="footer-cp-2">
                    <span class="text-muted"><a href="#">Kebijakan Privasi </a>|<a href="#"> Syarat & Ketentuan</a></span>
                </div>
            </div>
        </div>
    </footer>
</html>
