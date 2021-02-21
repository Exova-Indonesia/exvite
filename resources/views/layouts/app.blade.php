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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}" defer></script>
    <script src="{{ asset('js/vendor/jquery-ui.js') }}" defer></script>
    <script src="{{ asset('js/vendor/bootstrap.min.js') }}" defer></script>

    <script src="{{ asset('datatables/jquery.dataTables.js') }}" defer></script>
    <script src="{{ asset('datatables-bs4/js/dataTables.bootstrap4.js') }}" defer></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}" defer></script>
    <script src="{{ asset('js/contact-form.js') }}" defer></script>
    <script src="{{ asset('js/ajaxchimp.js') }}" defer></script>
    <script src="{{ asset('js/scrollUp.min.js') }}" defer></script>
    <script src="{{ asset('js/magnific-popup.min.js') }}" defer></script>
    <script src="{{ asset('js/wow.min.js') }}" defer></script>
    <script src="{{ asset('particles.js/particles.js') }}" defer></script>
    <script src="{{ asset('tourguide.js/tourguide.min.js') }}" defer></script>
    <script src="{{ asset('sweetalert2/sweetalert2.min.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!--<link rel="dns-prefetch" href="//fonts.gstatic.com">-->
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('tourguide.js/tourguide.css') }}">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/timeline.css') }}">
    <link rel="stylesheet" href="{{ asset('sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

</head>
<body data-spy="scroll" data-target=".mainmenu-area" data-component="intro" class="@if(Request::is('/')) @else pt-120 @endif">
    <div id="app">
        <nav class="navbar mainmenu-area navbar-expand-md fixed-top p-3 @if(Request::is('/')) @else bg-white shadow-nav @endif">
            <div class="container">
                <a class="navbar-logo" href="{{ url('/') }}">
                    <img src="{{ ('https://assets.exova.id/img/logo.png') }}" alt="Logo">
                </a>
                <button class="navbar-toggler @if(Request::is('/')) text-white @else text-secondary @endif" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                            <a class="nav-link @if(!Request::is('/')) text-secondary @endif" href="@if(Request::is('/')) #dashboard_page @else {{ url('/#dashboard_page') }} @endif">@lang('layout.header.home')<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link @if(!Request::is('/')) text-secondary @endif" href="@if(Request::is('/')) #services_page @else {{ url('/#services_page') }} @endif"> @lang('layout.header.services') </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(!Request::is('/')) text-secondary @endif" href="@if(Request::is('/')) #faq @else {{ url('/#faq') }} @endif"> @lang('layout.header.help') </a>
                        </li>
                            <a class="nav-link @if(!Request::is('/')) text-secondary @endif" href="@if(Request::is('/')) #tentang @else {{ url('/#tentang') }} @endif"> @lang('layout.header.about') </a>
                        </li>
                        @guest
                                <li class="nav-item">
                                    <a class="btn btn-danger m-1 mr-2" href="@if(Request::is('/')) #membership @else {{ url('/#membership') }} @endif"> @lang('layout.header.membership') </a>
                                </li>
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="btn btn-outline-success m-1" href="{{ route('login') }}"> @lang('layout.header.login') </a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-success m-1" href="{{ route('register') }}"> @lang('layout.header.register') </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a class="btn btn-danger m-1 mr-2" href="@if(Request::is('/')) #membership @else {{ url('/#membership') }} @endif"> @lang('layout.header.membership') </a>
                                <a href="{{ url('/cart') }}" class="text-white @if(!Request::is('/')) text-secondary @endif align-middle h5 mx-1">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span class="@if(Request::is('/')) bg-danger @endif cnotif">{{ count(Auth::user()->carts) }}</span>
                                </a>
                                <a href="profile/notifications" class="text-white dropdown-toggle @if(!Request::is('/')) text-secondary @endif align-middle h5 mx-1">
                                    <i class="fas fa-bell"></i>
                                </a>
                                <a id="navbarDropdown" class="navbar-brand dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img class="rounded-circle" src="{{ Auth::user()->avatar->small }}" width="40" height="40" alt="avatar">
                                </a>

                                <div class="dropdown-menu profile-drop dropdown-menu-right p-3" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-center pb-3">
                                        <img class="rounded-circle user-profile-picture" src="{{ Auth::user()->avatar->large }}" width="80" height="80" alt="avatar">
                                        <h5 class="text-uppercase m-2">
                                            {{ Auth::user()->name }}
                                            <i role="button" class="fa fa-power-off text-danger" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"></i>
                                        </h5>
                                        <span>@if(Auth::user()->subscription == 'NewBie') @else <i class="fas fa-crown text-warning"></i> @endif {{ Auth::user()->subscription }} Customer</span>
                                    </a>
                                    <div class="border-top py-2">
                                        <div class="py-1"><a href="#">@lang('layout.header.profile.revenue')<span class="float-right">IDR {{ number_format($balance->revenue, 0) }}</span></a></div>
                                        <div class="py-1"><a href="#">@lang('layout.header.profile.fund')<span class="float-right">IDR {{ number_format($balance->fund, 0) }}</span></a></div>
                                    </div>
                                    <a class="btn btn-primary w-100" href="profile">
                                        @lang('layout.header.profile.button')
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
        <!-- <div class="preloader">
            <span><img width="40px" height="40px" src="{{ ('https://assets.exova.id/img/1.png') }}"></span>
        </div> -->
        <main>
            @yield('content')
        </main>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="col footer-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="footer-header">
                            <img src="{{ ('https://assets.exova.id/img/logo.png') }}">
                        </div>
                        <span>@lang('home.header.description')</span>
                    </div>
                    <div class="col-md-3">
                        <div class="footer-header">
                            @lang('layout.footer.subfooter2.title')
                        </div>
                        <div><a href="#">@lang('layout.footer.subfooter2.blog')</a></div>
                        <div><a href="#">@lang('layout.footer.subfooter2.help')</a></div>
                        <div><a href="#">@lang('layout.footer.subfooter2.about')</a></div>
                        <div><a href="#">@lang('layout.footer.subfooter2.membership')</a></div>
                    </div>
                    <div class="col-md-2">
                        <div class="footer-header">
                            Layanan
                        </div>
                        <div><a href="#">@lang('layout.footer.subfooter3.jasa')</a></div>
                        <div><a href="#">@lang('layout.footer.subfooter3.creations')</a></div>
                    </div>
                    <div class="col-md-3" data-component="follow">
                        <div class="footer-header">
                            @lang('layout.footer.subfooter4.title')
                        </div>
                        <div class="footer__newslatter">
                            <form action="#">
                                <input type="text" placeholder="Email">
                                <button type="submit" class="site-btn">@lang('layout.footer.subfooter4.button')</button>
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
                    <span class="text-muted"><a href="#"> @lang('layout.footer.terms') </a>|<a href="#"> @lang('layout.footer.privacy') </a></span>
                </div>
            </div>
        </div>
    </footer>
    <script>
    $(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
      @if(session('status'))
        Toast.fire({
          icon: 'success',
          title: '{{ session('status') }}',
        })
      @endif
      @if(session('error'))
        Toast.fire({
          icon: 'error',
          title: '{{ session('error') }}',
        })
      @endif
    })
    </script>
</body>
</html>
