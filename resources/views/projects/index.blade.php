@extends('layouts.master')

@section('library')
	{!! Packer::js("/js/dhtmlx.js", "dhtmlx.js") !!}
	<link rel="stylesheet" href="/css/dhtmlx.css">
@endsection

@section('content')
	@include('layouts.menubar')

	<h1 class="page-header">List
		<font size="5" color="gray"> | Project</font>
		<div style="width:15%; float:right"><b>
			<select class="form-control" name="show-group">
				<option value=-1>All</option>
				<option value=0>Template</option>
				<option value=2016>2016</option>
			</select></b>
		</div>
	</h1>

	@if ($project->isEmpty())
		<h3>There are currently no Projects</h3>

	@else
		<div style="margin:10px 0">
			<button class="btn" onclick="viewTask()"><span class="glyphicon glyphicon-th-list"></span> Task</button>&nbsp;
			<button class="btn" onclick="viewCalendar()"><span class="glyphicon glyphicon-calendar"></span> Calendar</button>&nbsp;
			<button class="btn" onclick="viewResource()"><span class="glyphicon glyphicon-user"></span> Resource</button>&nbsp;
			<button class="btn" onclick="viewHistory()"><span class="glyphicon glyphicon-time"></span> History</button>&nbsp;
		@if (true || iPMS::isAuthGroup("PM"))
			<button class="btn btn-danger" style="float:right" onclick="editProject()"><span class="glyphicon glyphicon-pencil"></span>&nbsp; Edit</button>
		@endif
		</div>
		<div id="project_grid" style="width:100%"></div>
		<div id="project_grid_info"></div><br/>
	@endif
@endsection

@section('js')
<script>
	function viewTask() {
		var id = prjGrid.getSelectedRowId();
		if (id) location.href = "/projects/tsk-" + id;
	}

	function viewCalendar() {
		var id = prjGrid.getSelectedRowId();
		if (id) location.href = "/projects/cal-" + id;
	}

	function viewResource() {
		var id = prjGrid.getSelectedRowId();
		if (id) location.href = "/projects/res-" + id;
	}

	function viewHistroy() {
		var id = prjGrid.getSelectedRowId();
		if (id) location.href = "/projects/hst-" + id;
	}

	function editProject() {
		var id = prjGrid.getSelectedRowId();
		if (id) location.href = "/projects/edt-" + id;
	}

	var prjGrid = new dhtmlXGridObject('project_grid');
	prjGrid.setImagePath("/images/");
	prjGrid.setHeader("&nbsp;,Title,Product,Group,Plan Start,Plan End,Start,End,Version,Status");
	prjGrid.setColSorting("na,str,str,str,date,date,date,date,int,int");
	prjGrid.setColTypes("sub_row,ed,ed,ed,ed,ed,ed,ed,ed,coro");
	prjGrid.setColAlign("left,left,left,left,left,left,left,left,center,left");
	prjGrid.setInitWidths("30,200,*,150,100,100,100,100,60,100");
	prjGrid.enableAutoWidth(true);
	prjGrid.enableAutoHeight(true, window.innerHeight-280);
	prjGrid.enablePaging(true, 10, 1, "project_grid_info");
	prjGrid.setPagingSkin("toolbar");
	prjGrid.setEditable(false);

	prjGrid.attachEvent("onDataReady", function onDataReady() {
		//prjGrid.filterBy(3, "-1");
	});

	//var combo = prjGrid.getCombo(7);
	{{-- iPMS::printForEach("PROJECT_LEVEL", "combo.put('\$key', '\$val')") --}}
	combo = prjGrid.getCombo(9);
	{{ iPMS::printForEach("PROJECT_STATUS", "combo.put('\$key', '\$val')") }}
	prjGrid.init();

	prjGrid.enableAlterCss("grid_odd", "grid_even");
	prjGrid.enableRowsHover(true, "grid_hover");
	prjGrid.load("/grid_/projects");
</script>
@endsection
