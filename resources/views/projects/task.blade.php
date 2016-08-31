@extends('layouts.master')

@section('library')
{!! Packer::js(["/js/dhtmlxgantt.js",
				"/js/dhtmlxgantt_fullscreen.js",
				"/js/dhtmlxgantt_auto_scheduling.js",
				"/js/dhtmlxgantt_marker.js",
				"/js/dhtmlxgantt_undo.js",
				"/js/dhtmlxgantt_critical_path.js"], "dhtmlxgantt.js") !!}
<link rel="stylesheet" href="/css/dhtmlxgantt.css">
@stop

@section('content')
@include('layouts.menubar')
<h1 class="page-header">Project Task</h1>

<div style="margin:10px 0px">
	<label class="radio-inline"><input type="radio" name="scale" onclick="setScale('day')" checked>Day</label>
	<label class="radio-inline"><input type="radio" name="scale" onclick="setScale('month')">Month</label>
	<label class="radio-inline"><input type="radio" name="scale" onclick="setScale('year')">Year</label>
	<label class="checkbox-inline" style="margin-left:80px"><input type="checkbox" onchange="criticalPath(this)">Critical Path</label>
	<button class="btn-xs fa fa-undo" style="margin-left:40px" onclick="gantt.undo()"> Undo</button>
	<button class="btn-xs fa fa-repeat" onclick="gantt.redo()"> Redo</button>
	<button class="btn-xs btn-danger" style="float:right" onclick="dp.sendData()"><span class="glyphicon glyphicon-save"></span> Update</button>
</div>
<div id="gantt" style="width:100%; height:450px"></div>

<style>
	.gantt-fullscreen{
		position: absolute;
		bottom: 20px;
		right: 20px;
		width: 24px;
		height: 24px;
		padding: 2px;
		font-size: 24px;
		background: transparent;
		cursor: pointer;
		opacity: 0.5;
		text-align: center;
		-webkit-transition:background-color 0.5s, opacity 0.5s;
		transition:background-color 0.5s, opacity 0.5s;
	}
	.gantt-fullscreen:hover{
		background: rgba(150, 150, 150, 0.5);
		opacity: 1;
	}
	.gantt_task_line.gantt_dependent_task {
		background-color: #65c16f;
		border: 1px solid #3c9445;
	}
	.gantt_task_line.gantt_dependent_task .gantt_task_progress {
		background-color: #46ad51;
	}

	.custom-project {
		position: absolute;
		height: 6px;
		color: #ffffff;
		background-color: #444444;
	}
	.custom-project div {position: absolute;}
	.project-left, .project-right {
		top: 6px;
		background-color: transparent;
		border-style: solid;
		width: 0px;
		height: 0px;
	}
	.project-left {
		left:0px;
		border-width: 0px 0px  8px 7px;
		border-top-color: transparent;
		border-right-color: transparent !important;
		border-bottom-color: transparent !important;
		border-left-color: #444444 !important;
	}
	.project-right {
		right:0px;
		border-width: 0px 7px 8px 0px;
		border-top-color: transparent;
		border-right-color: #444444;
		border-bottom-color: transparent !important;
		border-left-color: transparent;
	}
	.project-line {font-weight: bold;}
	.gantt_task_line, .gantt_line_wrapper div {
		background-color: blue;
		border-color: blue;
		border-radius: 1;
	}
	.gantt_link_arrow {border-color: blue;}
	.gantt_task_link:hover .gantt_line_wrapper div {
		box-shadow: 0 0 5px 0px #9fa6ff;
	}
	.gantt_task_line .gantt_task_progress {
		opacity: 0.5;
		background-color: red;
	}
	.gantt_grid_data .gantt_cell {border-right: 1px solid #ececec;}
	.gantt_grid_data .gantt_cell.gantt_last_cell {border-right: none;}
	.gantt_tree_icon.gantt_folder_open,
	.gantt_tree_icon.gantt_file,
	.gantt_tree_icon.gantt_folder_closed {display: none;}
	.gantt_task .gantt_task_scale .gantt_scale_cell,
	.gantt_grid_scale .gantt_grid_head_cell {color:#5c5c5c;}
	.gantt_row, .gantt_cell {border-color:#cecece;}
	.gantt_grid_scale .gantt_grid_head_cell {
		border-right: 1px solid #cecece !important;
	}
	.gantt_grid_scale .gantt_grid_head_cell.gantt_last_cell  {
		border-right: none !important;
	}
	.critical_task {background:red; border-color: red}

	.weekend {background: #f4f7f4 !important;}
	.holyday {background: #fff0f0 !important;}
	.gantt_selected .weekend {background:#FFF3A1 !important;}
</style>
<script>
	function update() {
		dp.sendData();
var dates = gantt.getSubtaskDates(),
dateToStr = function(date){return gantt.date.date_to_str("%Y-%m-%d")(date);};
console.log(dateToStr(dates.start_date) + " - " + dateToStr(dates.end_date));
	}

	function setScale(val) {
		setConfigScale(val);
		gantt.render();
	}

	function criticalPath(cb) {
		gantt.config.highlight_critical_path = cb.checked;
		gantt.render();
	}

	function setConfigScale(val) {
		switch (val) {
		case "day":
			gantt.config.scale_unit = "day";
			gantt.config.date_scale = "%d";
			gantt.config.subscales = [
				{ unit:"month", step:1, date:"%Y. %m월" }
			];
			gantt.config.min_column_width = 22;
			gantt.templates.scale_cell_class = function(date) {
				if (!gantt.isWorkTime(date)) return "holyday";
				if (date.getDay()==0 || date.getDay()==6) return "weekend";
			};
			gantt.templates.task_cell_class = function(item, date) {
				if (!gantt.isWorkTime(date)) return "holyday";
				if (date.getDay()==0 || date.getDay()==6) return "weekend";
			};
			break;
		case "month":
			gantt.config.scale_unit = "month";
			gantt.config.date_scale = "%Y. %m월";
			gantt.config.subscales = [
				{ unit:"week", step:1, date:"%W주" }
			];
			gantt.config.min_column_width = 50;
			gantt.templates.scale_cell_class = function(date) { return null; }
			break;
		case "year":
			gantt.config.scale_unit = "year";
			gantt.config.date_scale = "%Y";
			gantt.config.subscales = [
				{ unit:"month", step:1, date:"%m월" }
			];
			gantt.config.min_column_width = 60;
			gantt.templates.task_cell_class = function(item, date) { return null; }
			break;
		}
	}

	gantt.config.xml_date = "%Y-%m-%d %H:%i:%s";
	gantt.config.step = 1;
	gantt.config.order_branch = true;
	gantt.config.auto_scheduling = true;
	gantt.config.auto_scheduling_strict = true;
	gantt.config.drag_progress = false;
	gantt.config.open_tree_initially = true;
	setConfigScale("day");	// default day scale

	gantt.config.columns = [
		{name:"text",       label:"Task",  width:"*", tree:true },
		{name:"start_date", label:"Start", width:80,  align:"center" },
		{name:"end_date",   label:"End",   width:80,  align:"center" },
		{name:"duration",   label:"Day",   width:42,  align:"center" },
		{name:"add",        label:"",      width:38 }
	];
	gantt.config.keep_grid_width = false;
	gantt.config.grid_resize = true;
	gantt.config.grid_width = 400;
	gantt.config.grid_resize = true;
	//gantt.config.min_grid_column_width = 70;
	gantt.config.row_height = 28;
	gantt.config.task_height = 16;

	gantt.config.task_date = "%Y.%m.%d";
	gantt.locale.labels["section_progress"] = "Progress";
	gantt.config.lightbox.sections = [
		{name: "description", type: "textarea", map_to: "text", height: 28, focus: true},
		{name: "type", type: "typeselect", map_to: "type"},
		{name: "progress", type: "select", map_to: "progress", options: [
			{key:"0.0", label: "Not Started"},
			{key:"0.1", label: "10%"},
			{key:"0.2", label: "20%"},
			{key:"0.3", label: "30%"},
			{key:"0.4", label: "40%"},
			{key:"0.5", label: "50%"},
			{key:"0.6", label: "60%"},
			{key:"0.7", label: "70%"},
			{key:"0.8", label: "80%"},
			{key:"0.9", label: "90%"},
			{key:"1.0", label: "Complete"} ]},
		{name: "time", type: "duration", map_to: "auto", time_format:["%Y", "%m", "%d"]}
	];

	// Working day (월화수목금금금 or not)
	gantt.config.work_time = true;
	gantt.setWorkTime({day: 0});	// 일요일
	gantt.setWorkTime({day: 6});	// 토요일
	var holiday = [
<?php
		use iPMS\Schedule;
		foreach (Schedule::all() as $schd)
			if ($schd->uid == '0') {
				$start = new DateTime($schd->start_date);
				$end = new DateTime($schd->end_date);
				$interval = new DateInterval('P1D');
				$range = new DatePeriod($start, $interval, $end);
				foreach ($range as $date)
					echo "new Date('". $date->format("Y-m-d") ."'),\n";
			}
?>
	];
	for (var i = 0; i < holiday.length; i++)
		gantt.setWorkTime({date: holiday[i], hours: false});

	// Today mark
	var today = new Date();
	gantt.addMarker({start_date: today, css: "today", text: "Today"});

	// Critical path
	gantt.config.highlight_critical_path = false; // default
	gantt.templates.task_class = function(start, end, task) {
		if (gantt.config.highlight_critical_path &&
			gantt.isCriticalTask(task)) return "critical_task";
	}

	// Classic look
	gantt.config.type_renderers[gantt.config.types.project] = function(task) {
		var main_el = document.createElement("div");
		main_el.setAttribute(gantt.config.task_attribute, task.id);
		var size = gantt.getTaskPosition(task);
		main_el.innerHTML = [
			"<div class='project-left'></div>",
			"<div class='project-right'></div>"
		].join('');
		main_el.className = "custom-project";
		main_el.style.left = size.left + "px";
		main_el.style.top = size.top + 7 + "px";
		main_el.style.width = size.width + "px";
		return main_el;
	};
	gantt.templates.grid_row_class = function(start, end, task) {
		if (task.type == gantt.config.types.project) return "project-line";
	};
	gantt.templates.rightside_text = function(start, end, task) {
		return (task.type == gantt.config.types.milestone) ? task.text : "";
	};

	(function () {	// Fullscreen Expand / Collapse
		gantt.attachEvent("onTemplatesReady", function() {
			var toggle = document.createElement("i");
			toggle.className = "fa fa-expand gantt-fullscreen";
			gantt.toggleIcon = toggle;
			gantt.$container.appendChild(toggle);
			toggle.onclick = function() {
				var mbar = document.getElementById("menubar");
				if (!gantt.getState().fullscreen) {
					mbar.style.visibility = "hidden";
					gantt.expand();
				}
				else {
					mbar.style.visibility = "visible";
					gantt.collapse();
				}
			};
		});
		gantt.attachEvent("onExpand", function() {
			var icon = gantt.toggleIcon;
			if (icon) icon.className = icon.className.replace("fa-expand", "fa-compress");
		});
		gantt.attachEvent("onCollapse", function() {
			var icon = gantt.toggleIcon;
			if (icon) icon.className = icon.className.replace("fa-compress", "fa-expand");
		});
	})();

	(function () {	// Tasks with Subtasks automatically become Projects
		var delTaskParent;
		function checkParents(id) {
			setTaskType(id);
			var parent = gantt.getParent(id);
			if (parent != gantt.config.root_id) checkParents(parent);
		}
		function setTaskType(id) {
			id = id.id ? id.id : id;
			var task = gantt.getTask(id);
			var type = gantt.hasChild(task.id) ? gantt.config.types.project : task.type;
			if (type != task.type) {
				task.type = type;
				gantt.updateTask(id);
			}
		}
		gantt.attachEvent("onParse", function() {
			gantt.eachTask(function(task) { setTaskType(task); });
		});
		gantt.attachEvent("onAfterTaskAdd", function onAfterTaskAdd(id) {
			gantt.batchUpdate(checkParents(id));
		});
		gantt.attachEvent("onBeforeTaskDelete", function onBeforeTaskDelete(id, task) {
			delTaskParent = gantt.getParent(id);
			return true;
		});
		gantt.attachEvent("onAfterTaskDelete", function onAfterTaskDelete(id, task) {
			if (delTaskParent != gantt.config.root_id)
				gantt.batchUpdate(checkParents(delTaskParent));
		});
	})();

	gantt.init("gantt");
	gantt.load("/gantt_/1", "xml");
	var dp = new gantt.dataProcessor("/gantt_/1");
	dp.init(gantt);
	dp.setUpdateMode("off");
</script>
@stop
