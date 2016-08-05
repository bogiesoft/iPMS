@extends('layouts.master')

@section('library')
<script src="/js/dhtmlxgrid.js"></script>
<link rel="stylesheet" href="/css/dhtmlxgrid.css">
@stop

@section('content')
@include('layouts.menubar')
<h1 class="page-header">Project Status</h1>

@if( $project )
@endif

@if( $project->isEmpty() )
<h3>There are currently no Projects</h3>
<div id="gridbox" style="width:100%; height:240;"></div>
</br>

<style>
	.odd   {background:#fffff8;}
	.even  {background:#ffffff;}
	.hover {background:#fff8f8;}
</style>
<script>
var data = {
	rows:[
		{id:1, data:[
			"-1500",
			"A Time to Kill",
			"John Grisham",
			"12.99",
			"1",
			"24",
			"0",
			"05/01/1998",
		]},
		{id:2, data:[
			"1000",
			"Blood and Smoke",
			"Stephen King",
			"0",
			"1",
			"24",
			"0",
			"01/01/2000",
		]},
		{id:3, data:[
			"-200",
			"The Rainmaker",
			"John Grisham",
			"7.99",
			"0",
			"48",
			"0",
			"12/01/2001",
		]},
		{id:4, data:[
			"350",
			"The Green Mile",
			"Stephen King",
			"11.10",
			"1",
			"24",
			"0",
			"01/01/1992",
		]},
		{id:5, data:[
			"700",
			"Misery",
			"Stephen King",
			"7.70",
			"0",
			"na",
			"0",
			"01/01/2003",
		]},
		{id:6, data:[
			"-1200",
			"The Dark Half",
			"Stephen King",
			"0",
			"0",
			"48",
			"0",
			"10/30/1999",
		]},
		{id:7, data:[
			"1500",
			"The Partner",
			"John Grisham",
			"12.99",
			"1",
			"48",
			"1",
			"01/01/2005",
		]},
	]
};

	var myGrid = new dhtmlXGridObject('gridbox');
	myGrid.setImagePath("/images/");
	myGrid.setHeader("Sales,<h5>Book Title</h5>,Author,Price,In Store,Shipping,Bestseller,Date of Publication");
	myGrid.setInitWidths("80,*,100,80,80,80,80,100");
	myGrid.setColAlign("right,left,left,right,center,left,center,center");
	myGrid.setColTypes("dyn,ed,txt,price,ch,coro,ra,ro");
	myGrid.setColSorting("int,str,str,int,str,str,str,date");
	//set values for select box in 5th column
	var combobox = myGrid.getCombo(5);
	combobox.put("1","1 Hour");
	combobox.put("12","12 Hours");
	combobox.put("24","24 Hours");
	combobox.put("48","2 days");
	combobox.put("168","1 week");
	combobox.put("pick","pick up");
	combobox.put("na","na");
//	myGrid.enablePaging(true, 10, 3, "pagingArea");
//	myGrid.setPagingSkin("toolbar");
	myGrid.enableAutoWidth(true);
	myGrid.enableAutoHeight(true, 150);
	myGrid.setEditable(false);
	myGrid.init();

	myGrid.enableAlterCss("odd","even");
	myGrid.enableRowsHover(true, "hover");

	//myGrid.load("../common/grid.xml");
	myGrid.parse(data, "json");
</script>
@endif

<a class="btn btn-info" href="{{ route('projects.create') }}">New Project</a>
@stop
