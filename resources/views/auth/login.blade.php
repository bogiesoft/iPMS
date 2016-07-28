<div class="panel panel-primary">
	<div class="panel-heading lead"><b>LOGIN</b></div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" method="post" action="{{ route('auth.login') }}">
			<div class="form-group{{ $errors->has('uid') ? ' has-error' : '' }}">
				<label for="uid" class="control-label col-sm-3">User ID</label>
				<div class="col-sm-9">
					<input type="text" name="uid" class="form-control" id="uid" placeholder="Enter User ID">
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
			<div class="form-group"> 
				<div class="col-sm-offset-3 col-sm-9">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="remember"> Remember me
						</label>
					</div>
				</div>
			</div>
			<div class="form-group"> 
				<div class="col-sm-offset-9 col-sm-3">
					<div class="form-group">
						<button type="submit" class="btn btn-info">Sign in</button>
					</div>
				</div>
			</div>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
		</form>
	</div>
</div>
<p class="text-right">Don't have an account? &nbsp <a class="btn btn-md btn-info" href="/auth/register">Register</a></p>
