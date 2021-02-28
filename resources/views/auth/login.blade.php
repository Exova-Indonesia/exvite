
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Exova - @lang('authuser.login.title')</title>
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
				<form class="login100-form shadow validate-form" method="POST" action="{{ route('login') }}">
				<img class="mx-auto d-block" src="https://assets.exova.id/img/1.png" alt="icon" width="80" height="80">
					<span class="login100-form-title p-b-34">
						@lang('authuser.login.title')
                    </span>
                    @csrf

                        <label for="email" class="col-form-label text-md-left"> @lang('authuser.login.email') </label>
                             <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                         @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                            <label for="password" class="col-form-label text-md-left"> @lang('authuser.login.password') </label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label for="remember">
                                         @lang('authuser.login.rememberme')
                                    </label>
                                </div>
                         		
					<div class="container-login100-form-btn">
						<button type="submit" class="btn btn-success w-100">
							@lang('authuser.login.login')
						</button>
					</div>

					<div class="w-full text-center p-t-20 p-b-25">
						<p>
						@if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
							@lang('authuser.login.forget')
                            </a>
						@endif
						</p>
						<span class="txt1">
							@lang('authuser.login.or')
						</span>
					</div>
                        <a href="{{ url('/auth/facebook') }}" class="btn btn-primary facebook w-100 m-2 text-white text-decoration-none"> @lang('authuser.login.facebook') <i class="fas fa-facebook"></i> </a>
                        <a href="{{ url('/auth/google') }}" class="btn btn-danger google w-100 m-2 text-white text-decoration-none"> @lang('authuser.login.google') <i class="fas fa-google"></i> </a>
                        <a href="{{ url('/auth/twitter') }}" class="btn btn-info twitter w-100 m-2 text-white text-decoration-none"> @lang('authuser.login.twitter') <i class="fas fa-twitter"></i> </a>
					<div class="w-full text-center"> @lang('authuser.login.havenoaccount') 
						<a href="{{ route('register') }}">
							@lang('authuser.login.register')
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
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="js/main.js"></script>

</body>
</html>