<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
    <script src="{{ asset('js/main.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--<link rel="dns-prefetch" href="//fonts.gstatic.com">-->
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/linearicons.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/timeline.css">
</head>
<body data-spy="scroll" data-target=".mainmenu-area">
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
                            <a class="nav-link" href="#dashboard_page">Dashboard <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#services_page"> Layanan </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tutorial">Cara Kerja</a>
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
                                    <a class="dropdown-item text-center">
                                        <img class="rounded-circle" src="{{ Auth::user()->avatar }}" width="80" height="80" alt="avatar">
                                        <h5 class="text-uppercase m-2">
                                            {{ Auth::user()->name }}
                                            <i role="button" class="fa fa-power-off text-danger" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"></i>
                                        </h5>
                                        <p> Bronze Customer </p>
                                    </a>
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
<span><i class="lnr lnr-sun"></i></span>
</div>
        <main>
            @yield('content')
        </main>
        <footer class="footer">
            <div class="container">
                <span class="text-muted">{{ date('Y') }} {{ ('Copyright All Rights Reserved | ') }}<a href="#">{{ ('Exova Indonesia') }}</a></span>
            </div>
        </footer>
    </div>
</body>
</html>
