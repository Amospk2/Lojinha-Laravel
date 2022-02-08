@extends('layouts.app')

@section('content')


<div class="container">
<div class="row">
	<div class="col-lg-3 col-md-2"></div>
	<div class="col-lg-6 col-md-8 login-box">
		<div class="col-lg-12 login-key">
			<i class="fa fa-sign-in" aria-hidden="true"></i>
		</div>
		<div class="col-lg-12 login-title">
			Enter With Your User
		</div>

		<div class="col-lg-12 login-form">
			<div class="col-lg-12 login-form">
				<form method="POST" action="{{ route('login') }}">
        			@csrf
					<div class="form-group col-md-12">
						<label for="pass" class="label">Email Address</label>
						<input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
						@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="form-group col-md-12">
						<label for="pass" class="label">Password</label>
						<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" data-type="password">
						@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="col-lg-12 loginbttm">
						<div class="col-lg-8 login-btm login-button">
							<button type="submit" class="btn btn-outline-primary">LOGIN</button>
							<label for="">or</label>
							<a href="/register" class="btn btn-outline-primary">Register</a>
						</div>	
					</div>
				</form>
			</div>
		</div>
		<div class="col-lg-3 col-md-2"></div>
	</div>
</div>


<link rel="stylesheet" href="{{ asset('css/style.css') }}">



@endsection


