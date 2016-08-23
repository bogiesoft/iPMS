@extends('layouts.master')

@section('library')
<script src="/js/dhtmlxgantt.js"></script>
<script src="/js/dhtmlxgantt_fullscreen.js"></script>
<script src="/js/dhtmlxgantt_auto_scheduling.js"></script>
<script src="/js/dhtmlxgantt_marker.js"></script>
<script src="/js/dhtmlxgantt_undo.js"></script>
<link rel="stylesheet" href="/css/dhtmlxgantt.css">
<link rel="stylesheet" href="/css/font-awesome.min.css">
@stop

@section('content')
@include('layouts.menubar')
<h1 class="page-header">Schedule</h1>

@stop
