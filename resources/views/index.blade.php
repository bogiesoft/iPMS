@extends('layouts.master')

@section('content')
@if (! Auth::check())
	<h1>
		<span style='font-size:64px'>iPMS </span>
		<span>IDIS Project Management System </span>
		<span style='font-size:14px; color:gray'>v0.0000001</span>
	</h1>
	<br>

	<div class="row">
		<div class="col-sm-7">
			<img src="{{ asset('images/project-management.jpg') }}" />
		</div>
		<div class="col-sm-5">
			<br><br>
			@include('auth.login')
		</div>
	</div>
@endif

@if ( Auth::check())
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3 col-md-2 sidebar">
				<ul class="nav nav-sidebar">
					<li style="margin-left:20px;">
						<img src="{{ Auth::user()->getAvatarUrl() }}" height="50" width="50" style="border-radius:25px;" />
					</li>
					<li><a href="#"> @ {{ Auth::user()->fullname }}</a></li>
					<li class="active"><a href="#">PREGO<span class="sr-only">(current)</span></a></li>
					<li><a href="#">Edit Account</a></li>
					<li><a href="#">Projects</a></li>
					<li><a href="#">Todos</a></li>
				</ul>
				<ul class="nav nav-sidebar">
					<li><a href="">Account</a></li>
					<li><a href="">Help</a></li>
					<li><a href="{{ route('auth.logout') }}">Sign Out</a></li>
				</ul>
			</div>
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<h1 class="page-header">Dashboard</h1>
			</div>
		</div>
	</div>
@endif
@stop
