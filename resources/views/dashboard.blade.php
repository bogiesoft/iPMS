@extends('layouts.master')

@section('library')
<script src="/js/dhtmlx.js"></script>
<link rel="stylesheet" href="/css/dhtmlx.css">
@stop

@section('content')
@include('layouts.menubar')
<h1 class="page-header">My Dashboard</h1>

<h3>미승인 Project</h3>
<div id="project_grid" style="width:100%; height:240;"></div>
<div id="project_grid_info"></div></br>
<script>
	var prjGrid = new dhtmlXGridObject('project_grid');
	prjGrid.setImagePath("/images/");
	prjGrid.setHeader("&nbsp;,Title,Product,Plan Start,Plan End,Start,End,Level,Version,Status");
	prjGrid.setColSorting("na,str,str,date,date,date,date,int,int,str");
	prjGrid.setColTypes("sub_row,ed,ed,ed,ed,ed,ed,coro,ed,ed");
	prjGrid.setColAlign("left,left,left,left,left,left,left,left,cener,left");
	prjGrid.setInitWidths("30,200,*,100,100,100,100,80,60,100");
	prjGrid.enableAutoWidth(true);
	prjGrid.enableAutoHeight(true, 250, 250);
	prjGrid.enablePaging(true, 10, 1, "project_grid_info");
	prjGrid.setPagingSkin("toolbar");
//	prjGrid.setEditable(false);
	var level = prjGrid.getCombo(7);
	for (var idx in PROJECT_LEVEL)
		level.put(idx, PROJECT_LEVEL[idx]);
	prjGrid.init();

	prjGrid.enableAlterCss("grid_odd", "grid_even");
	prjGrid.enableRowsHover(true, "grid_hover");
	prjGrid.load("/grid_/projects");

	var dp = new dataProcessor("/grid_/projects");
	dp.init(prjGrid);
	dp.setTransactionMode("POST", true);
	//dp.setUpdateMode("off");
</script>

<?php
	use iPMS\User;
	$usr = User::where('group', -1)->get();
?>
@if (count($usr))
<h3>미승인 사용자 ({{ count($usr) }})</h3>
<div id="user_grid" style="width:100%; height:100%"></div>
<div id="user_grid_info"></div></br>
<script>
	var userGrid = new dhtmlXGridObject('user_grid');
	userGrid.setImagePath("/images/");
	userGrid.setHeader("User ID,Full Name,E-mail");
	userGrid.setColSorting("str,str,str");
	userGrid.setInitWidths("150,150,*");
	userGrid.enableAutoWidth(true);
	userGrid.enableAutoHeight(true);
	userGrid.setEditable(false);
@if (count($usr) > 5)
	userGrid.enablePaging(true, 5, 1, "user_grid_info");
	userGrid.setPagingSkin("toolbar");
@endif
	userGrid.attachEvent("onDataReady", function onDataReady() {
		userGrid.filterBy(3, "-1");
	});
	userGrid.init();

	userGrid.enableAlterCss("grid_odd", "grid_even");
	userGrid.enableRowsHover(true, "grid_hover");
	userGrid.load("/grid_/users");
</script>
@endif
@stop
