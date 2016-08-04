@extends('layouts.master')

@section('library')
<script src="/js/dhtmlx.js"></script>
<link rel="stylesheet" href="/css/dhtmlx.css">
@stop

@section('content')
@include('layouts.menubar')
<h1 class="page-header">Project Status</h1>

@if( $project )
@endif

@if( $project->isEmpty() )
	<h3>There are currently no Projects</h3>

	<div id="gridbox" style="width:585px;height:275px;background-color:white;"></div>
	<script>
		var myGrid;
		function doOnLoad() {
			myGrid = new dhtmlXGridObject('gridbox');
			myGrid.setImagePath("../../../codebase/imgs/");
			myGrid.setHeader("&nbsp;,Book Title,Author,Price,In Store,Shipping,Bestseller,Date of Publication");
			myGrid.setInitWidths("40,150,120,80,80,80,80,200");
			myGrid.setColAlign("right,left,left,right,center,left,center,center");
			myGrid.setColTypes("cntr,ed,ed,price,ch,co,ra,ro");
			myGrid.setColSorting("na,str,str,int,str,str,str,date");
			myGrid.setColumnColor("#CCE2FE");
			myGrid.enableAutoHeight(true);
			myGrid.init();
			myGrid.splitAt(1);
			myGrid.load("../common/grid.xml");
		}
	</script>
@endif

<a class="btn btn-info" href="{{ route('projects.create') }}">New Project</a>
@stop
