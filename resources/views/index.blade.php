@extends('layouts.master')

@section('content')
@minify('html')
@if (! Auth::check())
	<div class="container">
		<div>
			<span style='font-size:64px'>iPMS </span>
			<span style='font-size:14px; color:gray'>v0.0000001</span></br>
			<span style='font-size:18px'>IDIS Project Management System</span>
		</div><br/>

		<div class="row" style="height:460px; background-image:url('images/project-management.jpg'); background-repeat:no-repeat">
			<div class="pull-right" style="width:320px; opacity:0.95">
				@include('auth.login')
			</div>
		</div>
	</div>
@endif

@if (Auth::check())
	{{ Auth::logout() }}
	location.reload();
@endif
@endminify
@stop
