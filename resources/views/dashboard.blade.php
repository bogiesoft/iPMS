@extends('layouts.master')

@section('content')
@include('layouts.menubar')
	@minify('html')
	<h1 class="page-header">My Dashboard</h1>

<?php
	use iPMS\User;
	use iPMS\Project;
	$usr = User::where('group', -1)->count();
	$prj = Project::where('approved', 0)->count();
?>
	<h3>To Do</h3>
	<div class="well well-sm" style="line-height:1.8em">
		<a href="/approve/project"><b>미승인 Project</b></a>&nbsp
		<span class="label label-danger">{{ $prj }}</span></br>
		<a href="/approve/user"><b>미승인 사용자</b></a>&nbsp
		<span class="label label-danger">{{ $usr }}</span>
	</div></br>
	@endminify
@stop