@extends('layouts.master')

@section('library')
{!! Packer::js("/js/dhtmlx.js", "dhtmlx.js") !!}
<link rel="stylesheet" href="/css/dhtmlx.css">
@stop

@section('content')
@include('layouts.menubar')
<h1 class="page-header">My Dashboard</h1>
@include('approve.project')
@include('approve.user')
@stop
