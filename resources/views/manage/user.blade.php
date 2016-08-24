@extends('layouts.master')

@section('library')
<script src="/js/dhtmlx.js"></script>
<link rel="stylesheet" href="/css/dhtmlx.css">
@stop

@section('content')
@include('layouts.menubar')
<h1 class="page-header">사용자 관리</h1>

<div style="height:30px">
	<button class="btn-xs " onclick="deleteRow()">Delete User</button>
	<button class="btn-xs " onclick="resetPasswd()">Reset Password</button>
	<button class="btn-xs btn-danger" style="float:right" onclick="dp.sendData()">Update</button>
</div>
<div id="user_grid" style="width:100%; height:100%"></div>
<div id="user_grid_info"></div></br>
<script>
	function deleteRow() {
		var row = userGrid.getSelectedRowId();
		if (row > 1) userGrid.deleteSelectedRows();
	}

	function resetPasswd() {
	}

	var userGrid = new dhtmlXGridObject('user_grid');
	userGrid.setImagePath("/images/");
	userGrid.setHeader("User ID,Full Name,E-mail,Group");
	userGrid.setColSorting("str,str,str,str");
	userGrid.setColTypes("ed,ed,ed,coro,ed");
	userGrid.setInitWidths("150,150,*,150");
	userGrid.enableAutoWidth(true);
	userGrid.enableAutoHeight(true, 150);
	userGrid.enablePaging(true, 10, 1, "user_grid_info");
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
	userGrid.load("/grid_data/users");

	var dp = new dataProcessor("/grid_data/users");
	dp.init(userGrid);
	dp.setUpdateMode("off");
</script>
@stop
