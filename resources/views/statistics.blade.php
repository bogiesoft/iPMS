@extends('layouts.master')

@section('library')
{!! Packer::js("/js/dhtmlx.js", "dhx.js") !!}
<link rel="stylesheet" href="/css/dhtmlx.css">
@stop
@section('content')
@if ( Auth::check())
	@include('layouts.menubar')
	<h1 class="page-header">Project Statistics</h1>
@endif
@stop
