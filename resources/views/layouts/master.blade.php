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
					"/js/ipms.js"], "master.js") !!}
	{!! Packer::css(["/css/bootstrap.min.css",
					"/css/font-awesome.min.css",
					"/css/ipms.css"], "master.css") !!}
	@yield('library')
</head>
@endminify

<body><div class="container-fluid">
	@include('layouts.alerts')
	@yield('content')
</div></body></html>