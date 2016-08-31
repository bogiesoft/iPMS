<?php
	use iPMS\User;
	$usr = User::where('group', -1)->count();
?>

<h3>미승인 사용자 ({{ $usr }})</h3>
@if ($usr)
<div id="user_grid" style="width:100%; height:100%"></div>
<div id="user_grid_info"></div>
<script>
	var userGrid = new dhtmlXGridObject('user_grid');
	userGrid.setImagePath("/images/");
	userGrid.setHeader("User ID,Full Name,E-mail,Group");
	userGrid.setColSorting("str,str,str,str");
	userGrid.setColTypes("ed,ed,ed,coro,ed");
	userGrid.setInitWidths("150,150,*,150");
	userGrid.enableAutoWidth(true);
	userGrid.enableAutoHeight(true);
@if ($usr > 5)
	userGrid.enablePaging(true, 5, 1, "user_grid_info");
	userGrid.setPagingSkin("toolbar");
@endif

	var dataReady = false;
	userGrid.attachEvent("onDataReady", function onDataReady() {
		userGrid.filterBy(3, "-1");
		dataReady = true;
	});
	userGrid.attachEvent("onBeforeSelect", function onBeforeSelect(new_row, old_row, new_col) {
		if (3 == new_col) return true;
		return false;
	});
	userGrid.attachEvent("onCellChanged", function onCellChanged(rid, cid, val) {
		if (cid == 3 && val == "-1")
			userGrid.setCellTextStyle(rid, cid, "color:red; font-weight:bold");
		if (dataReady != true || val == "-1") return;
		dataReady = false;
		dp.sendData();
		location.reload();
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
@endif