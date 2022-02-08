@extends('layouts.app')

@section('content')

	<form method="POST" action="{{ route('register') }}">
		@csrf

	<div class="container col-md-10">
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
		<label for="user" class="label">Username</label>
		<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" >
		@error('name')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
		@enderror
	</div>

	<div class="form-row col">

	<div class="form-group col-md-6">
		<label for="pass" class="label">Password</label>
		<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" data-type="password">
		@error('password')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
		@enderror
	</div>
	
	<div class="form-group col-md-6">
		<label for="password-confirm" class="label">Repeat Password</label>
		<input id="password-confirm" type="password" class="form-control" data-type="password" name="password_confirmation" required autocomplete="new-password">
	</div>

	</div>





	<div class="form-group col-md-6">
		<input type="submit" class="btn btn-primary" value="Sign Up">
	</div>

	</div>
</form>
	

@endsection


