@extends('layouts.master')

@section('content')
	@if (! Auth::check())
		{{ Auth::logout() }} <script>location.assign("/");</script>

	@else
		@include('layouts.menubar')

		<h1 class="page-header">My Dashboard</h1>
		<h3>To Do</h3>
		<div class="well well-sm" style="line-height:1.8em">
		@php($usr = iPMS\User::where('group', -1)->count())
		@php($prj = iPMS\Project::where('approved', 0)->count())
		@if ($usr && (Auth::user()->group == 0))
			<a href="/approve/user"><b>미승인 사용자</b></a> &nbsp
			<span class="label label-warning" style="font-size:.9em">{{ $usr }}</h4></span></br>
		@endif
		@if ($prj)
			<a href="/approve/project"><b>미승인 Project</b></a> &nbsp
			<span class="label label-warning" style="font-size:.9em">{{ $prj }}</span>
		@endif
		</div></br>
	@endif
@endsection