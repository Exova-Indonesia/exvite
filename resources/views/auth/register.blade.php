
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Exova - @lang('authuser.register.title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="Exova Indonesia adalah platform tempat menyalurkan hobby menjadi uang secara online, cepat, mudah, dan aman">
    <meta name="keywords" content="Freelancer, Exova Indonesia, Exova, E-Commerce, Freelancer Platform, 
    Lowongan Pekerjaan, Marketplace, Studio Online, Desainer, Photographer, Videographer, Web Developers,
    Apps Developers, Undangan Online, Online Invitations, Company Profile, Portfolio">
    <meta name="author" content="Exova Indonesia">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="https://assets.exova.id/img/1.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 border-0 justify-content-center">
				<form class="login100-form shadow validate-form" method="POST" action="{{ route('register') }}">
				<!-- <img class="mx-auto d-block" src="https://assets.exova.id/img/1.png" alt="icon" width="80" height="80"> -->
					<span class="login100-form-title p-b-34">
						@lang('authuser.register.title')
                    </span>
                    @csrf

                        <label for="name" class="col-form-label text-md-left">@lang('authuser.register.name')</label>
                             <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="off" autofocus>
                         @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label for="email" class="col-form-label text-md-left">@lang('authuser.login.email')</label>
                             <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off">
                         @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                            <label for="password" class="col-form-label text-md-left">@lang('authuser.login.password')</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                            <label for="password-confirm" class="col-form-label text-md-right">@lang('authuser.register.confirm')</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                         		
					<div class="container-login100-form-btn">
						<button type="submit" class="btn btn-success w-100">
							@lang('authuser.login.register')
						</button>
					</div>

					<div class="w-full text-center p-t-27 p-b-30">
						<span class="txt1">
							@lang('authuser.login.or')
						</span>
					</div>
                        <a href="{{ url('/auth/facebook') }}" class="btn btn-primary facebook w-100 m-2 text-white text-decoration-none"> @lang('authuser.login.facebook') <i class="fas fa-facebook"></i> </a>
                        <a href="{{ url('/auth/google') }}" class="btn btn-danger google w-100 m-2 text-white text-decoration-none"> @lang('authuser.login.google') <i class="fas fa-google"></i> </a>
						<a href="{{ url('/auth/twitter') }}" class="btn btn-info twitter w-100 m-2 text-white text-decoration-none"> @lang('authuser.login.twitter') <i class="fas fa-twitter"></i> </a>
					<div class="w-full text-center"> @lang('authuser.register.haveaccount')
						<a href="{{ route('login') }}">
							@lang('authuser.login.login')
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<footer class="page-footer">
		<div class="footer-copyright text-center py-3"> &copy; {{ date('Y') }} Copyright 
			<a href="#">{{ config('app.induk') }}</a>
		</div>
	</footer>

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>