@extends('layouts.master')

@section('library')
<script src="/js/dhtmlxgantt.js"></script>
<script src="/js/dhtmlxgantt_fullscreen.js"></script>
<script src="/js/dhtmlxgantt_auto_scheduling.js"></script>
<script src="/js/dhtmlxgantt_marker.js"></script>
<link rel="stylesheet" href="/css/dhtmlxgantt.css">
<link rel="stylesheet" href="/css/font-awesome.min.css">
@stop

@section('content')
@include('layouts.menubar')
<h1 class="page-header">Project Task</h1>

<label class="radio-inline"><input type="radio" name="scale" onclick="setScale('day')" checked>Day</label>
<label class="radio-inline"><input type="radio" name="scale" onclick="setScale('month')">Month</label>
<label class="radio-inline"><input type="radio" name="scale" onclick="setScale('year')">Year</label>

<div id="gantt" style='width:100%; height:450px'></div>

<style>
	.weekend {background:#f4f7f4 !important; color:#ffa0a0 !important;}
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
</style>
<script>
	function setScale(val) {
		setConfigScale(val);
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
				if (date.getDay()==0 || date.getDay()==6) { return "weekend"; }
			};
			gantt.templates.task_cell_class = function(item, date) {
				if (date.getDay()==0 || date.getDay()==6) { return "weekend"; }
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

	gantt.config.row_height = 30;
	gantt.config.keep_grid_width = false;
	gantt.config.grid_resize = true;

	gantt.config.xml_date = "%Y-%m-%d %H:%i:%s";
	gantt.config.step = 1;
	//gantt.config.work_time = true;
	gantt.config.order_branch = true;
	gantt.config.auto_scheduling = true;
	gantt.config.auto_scheduling_strict = true;
	setConfigScale("day");	// default day scale

	gantt.config.lightbox.sections = [
		{name: "description", height: 50, map_to: "text", type: "textarea", focus: true},
		{name: "type", type: "typeselect", map_to: "type"},
		{name: "time", type: "duration", map_to: "auto"}
	];

	gantt.templates.rightside_text = function(start, end, task) {
		if(task.type == gantt.config.types.milestone)
			return task.text;
		return "";
	};
	gantt.attachEvent("onTemplatesReady", function(){
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

	var today = new Date();
	gantt.addMarker({start_date: today, css: "today", text: "Today"});

/**
	gantt.config.columns = [
		{name:"text",       label:"Task",     width:"*", tree:true },
		{name:"start_date", label:"Start",    align:"center" },
		{name:"end_date",   label:"End",      align:"center" },
		{name:"duration",   label:"Duration", align:"center" },
		{name:"add",        label:"",         width:40 }
	];
	gantt.config.grid_resize = true;
	gantt.config.min_grid_column_width = 100;
**/
	gantt.init("gantt");

var tasks = {
	"data":[
		{"id":11, "text":"Project #1", "start_date":"", "duration":"", "progress": 0.6, "open": true, type:gantt.config.types.project},
		{"id":12, "text":"Task #1", "start_date":"2016-08-03", "duration":"5", "parent":"11", "progress": 1, "open": true},
		{"id":13, "text":"Task #2", "start_date":"", "duration":"", "parent":"11", "progress": 0.5, "open": true},
		{"id":14, "text":"Task #3", "start_date":"2016-08-02", "duration":"6", "parent":"11", "progress": 0.8, "open": true},
		{"id":15, "text":"Task #4", "start_date":"", "duration":"", "parent":"11", "progress": 0.2, "open": true},
		{"id":16, "text":"Task #5", "start_date":"2016-08-12", "duration":"17", "parent":"11", "progress": 0, "open": true},

		{"id":17, "text":"Task #2.1", "start_date":"2016-08-03", "duration":"8", "parent":"13", "progress": 1, "open": true},
		{"id":18, "text":"Task #2.2", "start_date":"2016-08-06", "duration":"20", "parent":"13", "progress": 0.8, "open": true},
		{"id":19, "text":"Task #2.3", "start_date":"2016-08-10", "duration":"14", "parent":"13", "progress": 0.2, "open": true},
		{"id":20, "text":"Task #2.4", "start_date":"2016-08-10", "duration":"18", "parent":"13", "progress": 0, "open": true},
		{"id":21, "text":"Task #4.1", "start_date":"2016-10-03", "duration":"14", "parent":"15", "progress": 0.5, "open": true},
		{"id":22, "text":"Task #4.2", "start_date":"2016-10-03", "duration":"16", "parent":"15", "progress": 0.1, "open": true},
		{"id":23, "text":"Task #4.3", "start_date":"2016-10-03", "duration":"18", "parent":"15", "progress": 0, "open": true}
	],
	"links":[
		{"id":"10","source":"11","target":"12","type":"1"},
		{"id":"11","source":"11","target":"13","type":"1"},
		{"id":"12","source":"11","target":"14","type":"1"},
		{"id":"13","source":"11","target":"15","type":"1"},
		{"id":"14","source":"11","target":"16","type":"1"},
		{"id":"15","source":"13","target":"17","type":"1"},
		{"id":"16","source":"17","target":"18","type":"0"},
		{"id":"17","source":"18","target":"19","type":"0"},
		{"id":"18","source":"19","target":"20","type":"0"},
		{"id":"19","source":"15","target":"21","type":"2"},
		{"id":"20","source":"15","target":"22","type":"2"},
		{"id":"21","source":"15","target":"23","type":"2"}
	]
};
	gantt.parse(tasks);

	// refers to the 'data' action that we will create in the next substep
	//gantt.load("data.xml", "xml");
	//gantt.load("data.json", "json");

	// refers to the 'data' action as well
	//var dp = new gantt.dataProcessor("./gantt_data");
	//dp.init(gantt);
</script>
@stop
