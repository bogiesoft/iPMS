@extends('layouts.master')

@section('library')
	{!! Packer::js("/js/dhtmlx.js", "dhtmlx.js") !!}
	<link rel="stylesheet" href="/css/dhtmlx.css">
@endsection

@section('content')
	@include('layouts.menubar')

	@php($prj = iPMS\Project::where('approved', 0)->count())
	@if ($prj)
		<h1 class="page-header">Project 승인</h1>

		<div style="margin:10px 0">
			<button class="btn-xs btn-danger" style="float:right" onclick="dp.sendData()"><span class="glyphicon glyphicon-save"></span> Update</button><br/>
		</div>
		<div id="project_grid" style="width:100%; height:240;"></div>
		<div id="project_grid_info"></div><br/>
	@endif
@endsection

@section('js')
<script>
	var prjGrid = new dhtmlXGridObject('project_grid');
	prjGrid.setImagePath("/images/");
	prjGrid.setHeader("&nbsp;,Title,Product,Plan Start,Plan End,Start,End,Level,Version,Status");
	prjGrid.setColSorting("na,str,str,date,date,date,date,int,int,int");
	prjGrid.setColTypes("sub_row,ed,ed,ed,ed,ed,ed,coro,ed,coro");
	prjGrid.setColAlign("left,left,left,left,left,left,left,left,cener,left");
	prjGrid.setInitWidths("30,200,*,100,100,100,100,80,60,100");
	prjGrid.enableAutoWidth(true);
	prjGrid.enableAutoHeight(true, 450);
	prjGrid.setEditable(false);
	prjGrid.enablePaging(true, 5, 1, "project_grid_info");
	prjGrid.setPagingSkin("toolbar");

	var combo = prjGrid.getCombo(7);
	{{ iPMS::printForEach("PROJECT_LEVEL", "combo.put('\$key', '\$val')") }}
	combo = prjGrid.getCombo(9);
	{{ iPMS::printForEach("PROJECT_STATUS", "combo.put('\$key', '\$val')") }}
	prjGrid.init();

	prjGrid.enableAlterCss("grid_odd", "grid_even");
	prjGrid.enableRowsHover(true, "grid_hover");
	prjGrid.load("/grid_/projects");

	var dp = new dataProcessor("/grid_/projects");
	dp.init(prjGrid);
	dp.setTransactionMode("POST", true);
	dp.setUpdateMode("off");
</script>
@endsection