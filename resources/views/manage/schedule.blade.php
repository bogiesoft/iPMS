@extends('layouts.master')

@section('library')
{!! Packer::js("/js/dhtmlx.js", "dhx.js") !!}
<link rel="stylesheet" href="/css/dhtmlx.css">
@stop

@section('content')
@include('layouts.menubar')
<h1 class="page-header">스케쥴 관리</h1>

<div style="margin:10px 0px">
	<button class="btn-xs " style="width:78px" onclick="addRow()"><span class="glyphicon glyphicon-plus"></span> Add</button>
	<button class="btn-xs " style="width:78px" onclick="removeRow()"><span class="glyphicon glyphicon-minus"></span> Remove</button>
	<button class="btn-xs btn-danger" style="float:right" onclick="dp.sendData()"><span class="glyphicon glyphicon-save"></span> Update</button>
</div>
<div id="grid" style="width:100%; height:100%"></div>
<div id="grid_info"></div></br>
<script>
	function addRow() {
		schdGrid.addRow(schdGrid.uid(), []);
	}

	function removeRow() {
		schdGrid.deleteSelectedRows();
	}

	var schdGrid = new dhtmlXGridObject('grid');
	schdGrid.setImagePath("/images/");
	schdGrid.setHeader("User,Start Date,End Date,Description");
	schdGrid.setColSorting("int,str,str,str");
	schdGrid.setColTypes("coro,dhxCalendarA,dhxCalendarA,ed");
	schdGrid.setInitWidths("150,200,200,*");
	schdGrid.enableAutoWidth(true);
	schdGrid.enableAutoHeight(true);
	schdGrid.enablePaging(true, 10, 1, "grid_info");
	schdGrid.setPagingSkin("toolbar");
	schdGrid.setDateFormat("%Y-%m-%d %H:%i");

	//schdGrid.attachEvent("onBeforeSelect", function onBeforeSelect(new_row, old_row, new_col) {
	//});
	var combo = schdGrid.getCombo(0);
	combo.put("0", "전사휴일");
<?php
	use iPMS\User;
	foreach (User::all() as $usr)
		echo "combo.put('". $usr->id ."','". $usr->fullname ."');\n";
?>
	schdGrid.init();

	schdGrid.enableAlterCss("grid_odd", "grid_even");
	schdGrid.enableRowsHover(true, "grid_hover");
	schdGrid.load("/grid_/schedules");

	var dp = new dataProcessor("/grid_/schedules");
	dp.init(schdGrid);
	dp.setUpdateMode("off");
</script>
@stop
