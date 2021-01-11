
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Exvite - Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 border-0 justify-content-center">
				<form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
				<img class="mx-auto d-block" src="images/icons/icon.png" alt="icon" width="80" height="80">
					<span class="login100-form-title p-b-34">
						Login To Exvite
                    </span>
                    @csrf

                        <label for="email" class="col-form-label text-md-left">{{ __('E-Mail Address') }}</label>
                             <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                         @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                            <label for="password" class="col-form-label text-md-left">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                         		
					<div class="container-login100-form-btn">
						<button type="submit" class="btn btn-success w-100">
                            {{ __('Login') }}
						</button>
					</div>

					<div class="w-full text-center p-t-20 p-b-25">
						<p>
						@if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                            	{{ __('Forgot Your Password?') }}
                            </a>
						@endif
						</p>
						<span class="txt1">
							OR
						</span>
					</div>
                        <button type="button" class="btn btn-primary facebook w-100 m-2"> <a href="{{ url('/auth/facebook') }}" class="text-white text-decoration-none"> <span>Login with Facebook</span> <i class="fa fa-facebook"></i> </a> </button>
                        <button type="button" class="btn btn-danger google w-100 m-2"> <a href="{{ url('/auth/google') }}" class="text-white text-decoration-none"> Login with Google <i class="fa fa-google"></i> </a> </button>
					<div class="w-full text-center"> Belum punya akun ? 
						<a href="{{ route('register') }}">
                            {{ __('Register') }}
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
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>