@extends('layouts.master')

@section('library')
	{!! Packer::js("/js/dhtmlx.js", "dhtmlx.js") !!}
	<link rel="stylesheet" href="/css/dhtmlx.css">
@endsection

@section('content')
	@include('layouts.menubar')

<?php
	$usr = iPMS\User::where('group', -1)->count();
?>
	@if ($usr)
		<h1 class="page-header">사용자 승인</h1>

		<div style="margin:10px 0">
			<button class="btn-xs btn-danger" style="float:right" onclick="dp.sendData()"><span class="glyphicon glyphicon-save"></span> Update</button><br/>
		</div>
		<div id="grid" style="width:100%; height:100%"></div>
		<div id="grid_info"></div>
	@endif
@endsection

@section('js')
<script>
	var usrGrid = new dhtmlXGridObject('grid');
	usrGrid.setImagePath("/images/");
	usrGrid.setHeader("User ID,Full Name,E-mail,Group");
	usrGrid.setColSorting("str,str,str,str");
	usrGrid.setColTypes("ed,ed,ed,coro,ed");
	usrGrid.setInitWidths("150,150,*,150");
	usrGrid.enableAutoWidth(true);
	usrGrid.enableAutoHeight(true);
	usrGrid.enablePaging(true, 10, 1, "grid_info");
	usrGrid.setPagingSkin("toolbar");

	usrGrid.attachEvent("onDataReady", function onDataReady() {
		usrGrid.filterBy(3, "-1");
	});
	usrGrid.attachEvent("onBeforeSelect", function onBeforeSelect(new_row, old_row, new_col) {
		if (3 == new_col) return true;
		return false;
	});
	usrGrid.attachEvent("onCellChanged", function onCellChanged(rid, cid, val) {
		if (cid == 3 && val == "-1")
			usrGrid.setCellTextStyle(rid, cid, "color:red; font-weight:bold");
	});

	var combo = usrGrid.getCombo(3);
	for (var idx in USER_GROUP)
		combo.put(idx, USER_GROUP[idx]);
	usrGrid.init();

	usrGrid.enableAlterCss("grid_odd", "grid_even");
	usrGrid.enableRowsHover(true, "grid_hover");
	usrGrid.load("/grid_/users");

	var dp = new dataProcessor("/grid_/users");
	dp.init(usrGrid);
	dp.setUpdateMode("off");
</script>
@endsection