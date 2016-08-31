@extends('layouts.master')

@section('library')
{!! Packer::js("/js/dhtmlx.js", "dhtmlx.js") !!}
<link rel="stylesheet" href="/css/dhtmlx.css">
@stop

@section('content')
@include('layouts.menubar')
<h1 class="page-header">Project Status</h1>

@if( $project->isEmpty() )
<h3>There are currently no Projects</h3>
@else

<h3>새로 등록한 Project</h3>
<div id="project_grid" style="width:100%; height:240;"></div>
<div id="project_grid_info"></div></br>
<script>
	var prjGrid = new dhtmlXGridObject('project_grid');
	prjGrid.setImagePath("/images/");
	prjGrid.setHeader("&nbsp;,Title,Product,Plan Start,Plan End,Start,End,Level,Version,Status");
	prjGrid.setColSorting("na,str,str,date,date,date,date,int,int,int");
	prjGrid.setColTypes("sub_row,ed,ed,ed,ed,ed,ed,coro,ed,coro");
	prjGrid.setColAlign("left,left,left,left,left,left,left,left,cener,left");
	prjGrid.setInitWidths("30,200,*,100,100,100,100,80,60,100");
	prjGrid.enableAutoWidth(true);
	prjGrid.enableAutoHeight(true, 250, 250);
	prjGrid.enablePaging(true, 10, 1, "project_grid_info");
	prjGrid.setPagingSkin("toolbar");
//	prjGrid.setEditable(false);
	var combo = prjGrid.getCombo(7);
	for (var idx in PROJECT_LEVEL)
		combo.put(idx, PROJECT_LEVEL[idx]);
	combo = prjGrid.getCombo(9);
	for (var idx in PROJECT_STATUS)
		combo.put(idx, PROJECT_STATUS[idx]);
	prjGrid.init();

	prjGrid.enableAlterCss("grid_odd", "grid_even");
	prjGrid.enableRowsHover(true, "grid_hover");
	prjGrid.load("/grid_/projects");

	var dp = new dataProcessor("/grid_/projects");
	dp.init(prjGrid);
	dp.setTransactionMode("POST", true);
	//dp.setUpdateMode("off");
</script>
@endif

<h3>새로 등록한 사용자</h3>
<div id="user_grid" style="width:100%; height:240;"></div></br>
<script>
	var userGrid = new dhtmlXGridObject('user_grid');
//	userGrid.setColumnIds("uid,fullname,email");
	userGrid.setImagePath("/images/");
//	userGrid.setStyle("background:#ffffff; color:black; font-weight:bold;");
	userGrid.setHeader("User ID,Full Name,E-mail");
	userGrid.setColSorting("str,str,str");
//	userGrid.setInitWidths("200,250,250");
//	userGrid.setColAlign("left,left,left");
//	userGrid.enableAutoWidth(true);
	userGrid.enableAutoHeight(true, 150);
//	userGrid.setEditable(false);
	userGrid.init();

	userGrid.enableAlterCss("grid_odd", "grid_even");
	userGrid.enableRowsHover(true, "grid_hover");
	userGrid.load("/grid_/users");

	var dp = new dataProcessor("/grid_/users");
	dp.init(userGrid);
//	dp.enableDataNames(true);
	dp.setTransactionMode("POST", true); // set mode as send-all-by-post
</script>

{{--
<a class="btn btn-info" href="{{ route('projects.create') }}">New Project</a>
--}}
@stop
