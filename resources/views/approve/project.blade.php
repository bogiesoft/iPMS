@extends('layouts.master')

@section('library')
{!! Packer::js("/js/dhtmlx.js", "dhtmlx.js") !!}
<link rel="stylesheet" href="/css/dhtmlx.css">
@stop

@section('content')
@include('layouts.menubar')
	@minify('html')
	<?php
		use iPMS\Project;
		$prj = Project::where('approved', 0)->count();
	?>

	<h1 class="page-header">미승인 Project</h1>

	@if ($prj)
	<div id="project_grid" style="width:100%; height:240;"></div>
	<div id="project_grid_info"></div></br>
	@endminify

	@minify('js')<script>
		var prjGrid = new dhtmlXGridObject('project_grid');
		prjGrid.setImagePath("/images/");
		prjGrid.setHeader("&nbsp;,Title,Product,Plan Start,Plan End,Start,End,Level,Version,Status");
		prjGrid.setColSorting("na,str,str,date,date,date,date,int,int,int");
		prjGrid.setColTypes("sub_row,ed,ed,ed,ed,ed,ed,coro,ed,coro");
		prjGrid.setColAlign("left,left,left,left,left,left,left,left,cener,left");
		prjGrid.setInitWidths("30,200,*,100,100,100,100,80,60,100");
		prjGrid.enableAutoWidth(true);
		prjGrid.enableAutoHeight(true, 250, 250);
		prjGrid.setEditable(false);
	@if ($prj > 5)
		prjGrid.enablePaging(true, 5, 1, "project_grid_info");
		prjGrid.setPagingSkin("toolbar");
	@endif
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
	@endminify</script>
	@endif
@stop