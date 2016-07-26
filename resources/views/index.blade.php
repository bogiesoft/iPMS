@extends('layouts.master')

@section('content')
	<h1>
		<span style='font-size:64px'>iPMS </span>
		<span>IDIS Project Management System </span>
		<span style='font-size:14px; color:gray'>Ver 0.0000001</span>
	</h1>

	<p> </p>

	<p><img src="{{ asset('images/project-management.jpg') }}" /></p>

	<a class="btn btn-large btn-info" href="/auth/register">Sign Up</a>

	<p class="login">Already signed up? <a class="btn btn-large btn-info" href="/auth/signin">Login</a></p>
@stop
