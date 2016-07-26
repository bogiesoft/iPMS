@extends('layouts.master')

@section('content')

	<h3><a href={{ route('index') }}> iPMS - IDIS Project Management System </a></h3>
	<h3>Register Here</h3><br>

	<div class="row">
		<div class="col-lg-6">
			<form class="form-vertical" role="form" method="post" action="{{ route('auth.register') }}">
				<div class="form-group{{ $errors->has('uid') ? ' has-error' : '' }}">
					<label for="uid" class="control-label">Choose a User ID</label>
					<input type="text" name="uid" class="form-control" id="uid" value="{{ old('uid') ?: '' }}">
					@if ($errors->has('uid'))
						<span class="help-block">{{ $errors->first('uid') }}</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<label for="email" class="control-label">Your Email Address</label>
					<input type="text" name="email" class="form-control" id="email" value="{{ old('email') ?: '' }}">
					@if ($errors->has('email'))
						<span class="help-block">{{ $errors->first('email') }}</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<label for="password" class="control-label">Choose a Password</label>
					<input type="password" name="password" class="form-control" id="password">
					@if ($errors->has('password'))
						<span class="help-block">{{ $errors->first('password') }}</span>
					@endif
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-default">Sign up</button>
				</div>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</form>
		</div>
	</div>
@stop
