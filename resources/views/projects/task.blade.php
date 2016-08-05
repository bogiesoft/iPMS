@extends('layouts.master')

@section('library')
<script src="/js/dhtmlxgantt.js"></script>
<link rel="stylesheet" href="/css/dhtmlxgantt.css">
@stop

@section('content')
@include('layouts.menubar')
<h1 class="page-header">Project Task</h1>

<label class="radio-inline"><input type="radio" name="scale" onclick="setScale('1')" checked>Day</label>
<label class="radio-inline"><input type="radio" name="scale" onclick="setScale('2')">Month</label>
<label class="radio-inline"><input type="radio" name="scale" onclick="setScale('3')">Year</label>

<div id="gantt" style='width:100%; height:450px'></div>

<style>
	.weekend {background:#f4f7f4 !important; color:#ffa0a0 !important;}
</style>
<script>
	function setScale(val) {
		setConfigScale(val);
		gantt.render();
	}

	function setConfigScale(val) {
		switch (val) {
		case "1":
			gantt.config.scale_unit = "day";
			gantt.config.date_scale = "%m.%d";
			gantt.config.subscales = [
				{ unit:"week", step:1, date:"%Y. %W주" }
			];
			gantt.config.min_column_width = 48;
			gantt.templates.scale_cell_class = function(date) {
				if (date.getDay()==0 || date.getDay()==6) { return "weekend"; }
			};
			gantt.templates.task_cell_class = function(item, date) {
				if (date.getDay()==0 || date.getDay()==6) { return "weekend"; }
			};
			break;
		case "2":
			gantt.config.scale_unit = "month";
			gantt.config.date_scale = "%Y. %m월";
			gantt.config.subscales = [
				{ unit:"week", step:1, date:"%W주" }
			];
			gantt.config.min_column_width = 60;
			gantt.templates.scale_cell_class = function(date) { return null; }
			break;
		case "3":
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

	// chart configuration and initialization
	gantt.config.xml_date = "%Y-%m-%d %H:%i:%s";
	gantt.config.step = 1;
	gantt.config.order_branch = true;
	setConfigScale("1");	// day scale

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
	data:[
	{id:1, text:"Project #1",start_date:"2016-01-04", duration:11,
	progress: 0.6, open: true, type:gantt.config.types.project},
	{id:2, text:"Task #1",   start_date:"2016-03-04", duration:5, 
	progress: 1,   open: true, parent:1},
	{id:3, text:"Task #2",   start_date:"2016-02-04", duration:7, 
	progress: 0.5, open: true, parent:1},
	{id:4, text:"Task #2.1", start_date:"2016-03-04", duration:2, 
	progress: 1,   open: true, parent:3},
	{id:5, text:"Task #2.2", start_date:"2016-04-04", duration:3, 
	progress: 0.8, open: true, parent:3},
	{id:6, text:"Task #2.3", start_date:"2016-05-04", duration:4, 
	progress: 0.2, open: true, parent:3}
	],
	links:[
	{id:1, source:1, target:2, type:"1"},
	{id:2, source:1, target:3, type:"1"},
	{id:3, source:3, target:4, type:"1"},
	{id:4, source:4, target:5, type:"0"},
	{id:5, source:5, target:6, type:"0"}
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
