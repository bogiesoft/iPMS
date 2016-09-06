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
	@yield('library')
</head>
@endminify

@if (Auth::check())
	@minify('html')
		<body>
			<div class="container-fluid"> @yield('content') </div>
		</body></html>
	@endminify

	@minify('css')
		@yield('css')
	@endminify

	@minify('js')
		@yield('js')
	@endminify

@else
	{{ Auth::logout() }} <script>location.assign("/");</script>
@endif
