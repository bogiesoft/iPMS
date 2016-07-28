<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width">
	<title>iPMS - IDIS</title>
	<meta name="description" content="IDIS Project Management System">

	<!-- Typekit Fonts -->
<!--
	<script src="//use.typekit.net/udt8boc.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>
-->

	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
	<div class="container">
		@include('layouts.alerts')
		@yield('content')
	</div>
</body>
</html>
