@extends('layouts.master')

@section('library')
<script src="/js/dhtmlx.js"></script>
<link rel="stylesheet" href="/css/dhtmlx.css">
@stop

@section('content')
@include('layouts.menubar')
<h1 class="page-header">사용자 관리</h1>

<div style="margin:10px 0px">
	<button class="btn-xs " onclick="removeRow()"><span class="glyphicon glyphicon-minus"></span> Remove</button>
	<button class="btn-xs " onclick="resetPasswd()"><span class="glyphicon glyphicon-refresh"></span> Reset Password</button>
	<button class="btn-xs btn-danger" style="float:right" onclick="dp.sendData()"><span class="glyphicon glyphicon-save"></span> Update</button>
</div>
<div id="grid" style="width:100%; height:100%"></div>
<div id="grid_info"></div></br>
<script>
	function removeRow() {
		var row = userGrid.getSelectedRowId();
		if (row > 1) userGrid.deleteSelectedRows();
	}

	function resetPasswd() {
	}

	var userGrid = new dhtmlXGridObject('grid');
	userGrid.setImagePath("/images/");
	userGrid.setHeader("User ID,Full Name,E-mail,Group");
	userGrid.setColSorting("str,str,str,str");
	userGrid.setColTypes("ed,ed,ed,coro");
	userGrid.setInitWidths("150,150,*,150");
	userGrid.enableAutoWidth(true);
	userGrid.enableAutoHeight(true);
	userGrid.enablePaging(true, 10, 1, "grid_info");
	userGrid.setPagingSkin("toolbar");

	userGrid.attachEvent("onBeforeSelect", function onBeforeSelect(new_row, old_row, new_col) {
		if (1 == new_row && (0 == new_col || 3 == new_col)) return false;
		return true;
	});

	var combo = userGrid.getCombo(3);
	for (var idx in USER_GROUP)
		combo.put(idx, USER_GROUP[idx]);
	userGrid.init();

	userGrid.enableAlterCss("grid_odd", "grid_even");
	userGrid.enableRowsHover(true, "grid_hover");
	userGrid.load("/grid_/users");

	var dp = new dataProcessor("/grid_/users");
	dp.init(userGrid);
	dp.setUpdateMode("off");
</script>
@stop
