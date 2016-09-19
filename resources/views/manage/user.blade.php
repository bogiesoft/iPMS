@extends('layouts.master')

@section('library')
	{!! Packer::js("/js/dhtmlx.js", "dhtmlx.js") !!}
	<link rel="stylesheet" href="/css/dhtmlx.css">
@endsection

@section('content')
	@include('layouts.menubar')
	<h1 class="page-header">사용자 관리</h1>

	<div style="margin:10px 0">
		<button class="btn-xs" onclick="removeRow()"><span class="glyphicon glyphicon-minus"></span> Remove</button>
		<button class="btn-xs" onclick="resetPasswd()"><span class="glyphicon glyphicon-refresh"></span> Reset Password</button>
		<button class="btn-xs btn-danger" style="float:right" onclick="dp.sendData()"><span class="glyphicon glyphicon-save"></span> Update</button>
	</div>
	<div id="grid" style="width:100%; height:100%"></div>
	<div id="grid_info"></div>
@endsection

@section('js')
<script>
	function removeRow() {
		var row = usrGrid.getSelectedRowId();
		if (row > 1) usrGrid.deleteSelectedRows();
	}

	function resetPasswd() {
	}

	var usrGrid = new dhtmlXGridObject('grid');
	usrGrid.setImagePath("/images/");
	usrGrid.setHeader("User ID,Full Name,E-mail,Group");
	usrGrid.setColSorting("str,str,str,str");
	usrGrid.setColTypes("ed,ed,ed,coro");
	usrGrid.setInitWidths("150,150,*,150");
	usrGrid.enableAutoWidth(true);
	usrGrid.enableAutoHeight(true);
	usrGrid.enablePaging(true, 10, 1, "grid_info");
	usrGrid.setPagingSkin("toolbar");

	usrGrid.attachEvent("onBeforeSelect", function onBeforeSelect(new_row, old_row, new_col) {
		if (1 == new_row && (0 == new_col || 3 == new_col)) return false;
		return true;
	});

	var combo = usrGrid.getCombo(3);
	{{ iPMS::printForEach("USER_GROUP", "combo.put('\$key', '\$val')") }}
	usrGrid.init();

	usrGrid.enableAlterCss("grid_odd", "grid_even");
	usrGrid.enableRowsHover(true, "grid_hover");
	usrGrid.load("/grid_/users");

	var dp = new dataProcessor("/grid_/users");
	dp.init(usrGrid);
	dp.setUpdateMode("off");
</script>
@endsection
