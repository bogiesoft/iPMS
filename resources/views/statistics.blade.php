@extends('layouts.master')

@section('library')
<script src="/js/dhtmlx.js"></script>
<link rel="stylesheet" href="/css/dhtmlx.css">
@stop
@section('content')
@if ( Auth::check())
	@include('layouts.menubar')
	<h1 class="page-header">Project Statistics</h1>
@endif
@stop
