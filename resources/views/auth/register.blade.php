@extends('layouts.master')

@section('content')
@minify('html')
<h1 class="page-header">
	<a href={{ route('index') }}>iPMS</a> <span class="small">User Register</span>
</h1><br/>

<div class="row">
	<div class="col-lg-6">
		<form class="form-horizontal" role="form" method="post" action="{{ route('auth.register') }}">
			<div class="form-group{{ $errors->has('uid') ? ' has-error' : '' }}">
				<label for="uid" class="control-label col-sm-3">User ID</label>
				<div class="col-sm-9">
					<input type="text" name="uid" class="form-control" id="uid" value="{{ old('uid') ?: '' }}" placeholder="Enter User ID">
					@if ($errors->has('uid'))
						<span class="help-block">This field is required.</span>
					@endif
				</div>
			</div>
			<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
				<label for="password" class="control-label col-sm-3">Password</label>
				<div class="col-sm-9">
					<input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
					@if ($errors->has('password'))
						<span class="help-block">This field is required.</span>
					@endif
				</div>
			</div>
			<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
				<label for="email" class="control-label col-sm-3">Email Address</label>
				<div class="col-sm-9">
					<input type="text" name="email" class="form-control" id="email" value="{{ old('email') ?: '' }}" placeholder="Enter Your Email Address">
					@if ($errors->has('email'))
						<span class="help-block">This field is required.</span>
					@endif
				</div>
			</div>
			<div class="form-group{{ $errors->has('fullname') ? ' has-error' : '' }}">
				<label for="fullname" class="control-label col-sm-3">Full Name</label>
				<div class="col-sm-9">
					<input type="text" name="fullname" class="form-control" id="fullname"  value="{{ old('fullname') ?: '' }}" placeholder="Enter Your Full Name">
					@if ($errors->has('fullname'))
						<span class="help-block">This field is required.</span>
					@endif
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9">
					<button type="submit" class="btn btn-info">Sign up</button>
				</div>
			</div>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
		</form>
	</div>
</div>
@endminify
@stop
