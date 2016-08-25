@extends('layouts.master')

@section('library')
<script src="/js/dhtmlxscheduler.js"></script>
<script src="/js/dhtmlxscheduler_year_view.js"></script>
<script src="/js/dhtmlxscheduler_container_autoresize.js"></script>
<script src="/js/dhtmlxscheduler_minical.js"></script>
<link rel="stylesheet" href="/css/dhtmlxscheduler.css">
@stop

@section('content')
@include('layouts.menubar')
<h1 class="page-header">Schedule</h1>

<div id="scheduler" class="dhx_cal_container" style="width:100%; height:100%">
	<div class="dhx_cal_navline">
		<div class="dhx_cal_prev_button">&nbsp;</div>
		<div class="dhx_cal_next_button">&nbsp;</div>
		<div class="dhx_cal_today_button"></div>
		<div class="dhx_cal_date"></div>
		<div class="dhx_cal_tab" name="day_tab"></div>
		<div class="dhx_cal_tab" name="week_tab"></div>
		<div class="dhx_cal_tab" name="month_tab""></div>
		<div class="dhx_cal_tab" name="year_tab""></div>
	</div>
	<div class="dhx_cal_header"></div>
	<div class="dhx_cal_data"></div>
</div>
<div style="margin-top:10px">
	<button class="btn-xs btn-danger" style="float:right" onclick="dp.sendData()">Update</button>
</div>

<style>
.weekend .dhx_month_body {background: #f4f7f4 !important;}
.weekend .dhx_month_head {color:red; background: #f4f7f4 !important;}
</style>
<script>
	scheduler.config.xml_date = "%Y-%m-%d %H:%i";
	scheduler.config.default_date = "%Y.%m.%d";
	scheduler.config.month_date = "%Y. %m월";
	scheduler.config.day_date = "%D (%m.%d)";
	scheduler.config.start_on_monday = false;
	scheduler.config.first_hour = 8;
	scheduler.config.last_hour = 20;
	scheduler.config.time_step = 30;
	scheduler.config.full_day = true;

	scheduler.xy.menu_width = 0;
	scheduler.config.details_on_dblclick = true;
	scheduler.config.details_on_create = true;
	scheduler.attachEvent("onClick", function(){return false;});

	scheduler.config.lightbox.sections = [
		{ name:"description", height:30, map_to:"text", type:"textarea", focus:true },
		{ name:"time", height:72, type:"calendar_time", map_to:"auto" }
	];

	scheduler.templates.month_date_class = function(date, today) {
		if (date.getDay()==0 || date.getDay()==6) return "weekend";
	}

	// read-only mode
/**
	scheduler.config.readonly_form = true;
	scheduler.attachEvent("onBeforeDrag", function(){return false;})
	scheduler.attachEvent("onClick", function(){return false;})
	scheduler.config.details_on_dblclick = true;
	scheduler.config.dblclick_create = false;
**/

	scheduler.init('scheduler', false, "month");
	//scheduler.load("./data/events.xml");
</script>
@stop
