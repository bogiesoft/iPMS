@extends('layouts.master')

@section('library')
	{!! Packer::js("/js/dhtmlx.js", "dhtmlx.js") !!}
	<link rel="stylesheet" href="/css/dhtmlx.css">
@endsection

@section('content')
	@include('layouts.menubar')

	<h1 class="page-header">My Dashboard</h1>
	<h3>To Do</h3>
	<div class="well well-sm" style="line-height:1.8em">
	@php($usr = iPMS\User::where('group', -1)->count())
	@php($prj = iPMS\Project::where('approved', 0)->count())
	@if ($usr && iPMS::isAuthGroup("Administrator"))
		<a href="/approve/user"><b>미승인 사용자 </b></a>
		<span class="label label-warning" style="font-size:.9em">{{ $usr }}</span><br/>
	@endif
	@if ($prj)
		<a href="/approve/project"><b>미승인 Project </b></a>
		<span class="label label-warning" style="font-size:.9em">{{ $prj }}</span>
	@endif
	</div>

	<h3>Key Indicator</h3>
	<div class="well well-sm" style="line-height:1.8em">
		<b>진행중 Project</b><br/>
		{{ iPMS::countProjectGroup() }}
	</div>
	<div id="delayChart" style="width:100%;height:300px;border:1px solid #c0c0c0"></div>

	<h3>Warning</h3>
	<div class="well well-sm" style="line-height:1.8em">
		<b>지연 Project</b><br/>
		{{ iPMS::showDelayProjectTask() }}
	</div>
@endsection

@section('css')
<style>
	.dhx_tooltip {
	    background:red;
	    color:white;
	}
</style>
@endsection

@section('js')
<script>
	var delayChart = new dhtmlXChart({
		view:"stackedBarH",
		container:"delayChart",
		value:"#day1#",
		color: "#58dccd",
		label:"#day1#",

		barWidth:50,
		alpha:0.8,
		tooltip:"완료지연일: #day#일",
		xAxis:{
		},
		yAxis:{
			lines:true,
			template:"#group#",
			title:"Project Group",
			align:"right",
		},
		legend:{
			values:[{text:"시작지연일",color:"#58dccd"},
					{text:"개발지연일",color:"#eed236"}],
			valign:"top",
			align:"center",
			//width:20,
			layout:"x"
		},
		padding:{
			left:100
		}
	});
	delayChart.addSeries({
		value:"#day2#",
		color:"#eed236",
		label:"#day2#"
	});
	delayChart.parse({{ iPMS::dataProjectDelay() }}, "json");
</script>
@endsection