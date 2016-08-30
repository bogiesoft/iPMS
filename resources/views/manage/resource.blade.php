@extends('layouts.master')

@section('library')
<script src="/js/dhtmlx.js"></script>
<link rel="stylesheet" href="/css/dhtmlx.css">
@stop

@section('content')
@include('layouts.menubar')
<h1 class="page-header">자원 관리</h1>

<div style="margin:10px 0px">
	<button class="btn-xs " style="width:78px" onclick="addRow()"><span class="glyphicon glyphicon-plus"></span> Add</button>
	<button class="btn-xs " style="width:78px" onclick="removeRow()"><span class="glyphicon glyphicon-minus"></span> Remove</button>
	<button class="btn-xs btn-danger" style="float:right" onclick="dp.sendData()"><span class="glyphicon glyphicon-save"></span> Update</button>
</div>
<div id="grid" style="width:100%; height:100%"></div>
<div id="grid_info"></div></br>
<script>
	function addRow() {
		resGrid.addRow(resGrid.uid(), ["", "", "0", "0", "0", ""]);
	}

	function removeRow() {
		resGrid.deleteSelectedRows();
	}

	var resGrid = new dhtmlXGridObject('grid');
	resGrid.setImagePath("/images/");
	resGrid.setHeader("Name,Group,Type,Cost,Unit,Notes");
	resGrid.setColSorting("str,str,int,int,int,na");
	resGrid.setColTypes("ed,ed,coro,edn,coro,ed");
	resGrid.setNumberFormat("&#8361;0,000",3);
	resGrid.setInitWidths("150,150,100,150,100,*");
	resGrid.enableAutoWidth(true);
	resGrid.enableAutoHeight(true);
	resGrid.enablePaging(true, 10, 1, "grid_info");
	resGrid.setPagingSkin("toolbar");

	resGrid.attachEvent("onBeforeSelect", function onBeforeSelect(new_row, old_row, new_col) {
		if (1 == new_row && (0 == new_col || 3 == new_col)) return false;
		return true;
	});

	var combo = resGrid.getCombo(2);
	for (var idx in RESOURCE_TYPE)
		combo.put(idx, RESOURCE_TYPE[idx]);
	combo = resGrid.getCombo(4);
	for (var idx in RESOURCE_UNIT)
		combo.put(idx, RESOURCE_UNIT[idx]);

	resGrid.init();

	resGrid.enableAlterCss("grid_odd", "grid_even");
	resGrid.enableRowsHover(true, "grid_hover");
	resGrid.load("/grid_/resources");

	var dp = new dataProcessor("/grid_/resources");
	dp.init(resGrid);
	dp.setUpdateMode("off");
</script>
@stop
