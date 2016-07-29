<!DOCTYPE html>
<html>
<head>
	<title>iPMS</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta name="description" content="IDIS Project Management System">

	<!-- Typekit Fonts -->
<!--
	<script src="//use.typekit.net/udt8boc.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>
-->

	<script src="/js/jquery-3.1.0.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="/css/bootstrap.min.css">
<!--
	<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
-->

	@yield('library')
</head>
<body>
	<div class="container-fluid">
		@include('layouts.alerts')
		@yield('content')
	</div>
</body>
</html>
