@minify('html')
<!DOCTYPE html>
<html>
<head>
	<title>iPMS</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta name="description" content="IDIS Project Management System">

	{!! Packer::js(["/js/jquery-3.1.0.min.js",
					"/js/bootstrap.min.js",
					"/js/bootstrap-select.min.js",
					"/js/ipms.js"], "master.js") !!}
	{!! Packer::css(["/css/bootstrap.min.css",
					"/css/bootstrap-select.min.css",
					"/css/font-awesome.min.css",
					"/css/ipms.css"], "master.css") !!}
</head>

@if (! Auth::check())
<body>
	<div class="container-fluid">
		@include('layouts.alerts')
		<div class="container">
			<div>
				<span style='font-size:64px'>iPMS </span>
				<span style='font-size:14px; color:gray'>v0.0000001</span><br/>
				<span style='font-size:18px'>IDIS Project Management System</span>
			</div><br/>

			<div class="row" style="height:460px; background-image:url('images/project-management.jpg'); background-repeat:no-repeat">
				<div class="pull-right" style="width:320px; opacity:0.95">
					@include('auth.login')
				</div>
			</div>
		</div>
	</div>
</body>

@else
	{{ Auth::logout() }}
	<script>location.reload();</script>script>
@endif
</html>
@endminify