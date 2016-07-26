@extends('layouts.master')

@section('content')
	<h3><a href={{ route('index') }}> iPMS - IDIS Project Management System </a></h3>
	<h3>Login</h3><br>

	<div class="row">
		<div class="col-lg-6">
			<form class="form-vertical" role="form" method="post" action="{{ route('auth.login') }}">
				<div class="form-group{{ $errors->has('uid') ? ' has-error' : '' }}">
					<label for="uid" class="control-label">User ID</label>
					<input type="text" name="uid" class="form-control" id="uid">
					@if ($errors->has('uid'))
						<span class="help-block">{{ $errors->first('uid') }}</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<label for="password" class="control-label">Password</label>
					<input type="password" name="password" class="form-control" id="password">
					@if ($errors->has('password'))
						<span class="help-block">{{ $errors->first('password') }}</span>
					@endif
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="remember"> Remember me
					</label>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-default">Sign in</button>
				</div>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</form>
		</div>
	</div>
@stop
