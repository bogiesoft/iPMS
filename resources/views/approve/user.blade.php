<?php
	use iPMS\User;
	$usr = User::where('group', -1)->get();
?>

<h3>미승인 사용자 ({{ count($usr) }})</h3>
@if (count($usr))
<div id="user_grid" style="width:100%; height:100%"></div>
<div id="user_grid_info"></div></br>
<script>
	var userGrid = new dhtmlXGridObject('user_grid');
	userGrid.setImagePath("/images/");
	userGrid.setHeader("User ID,Full Name,E-mail");
	userGrid.setColSorting("str,str,str");
	userGrid.setInitWidths("150,150,*");
	userGrid.enableAutoWidth(true);
	userGrid.enableAutoHeight(true);
	userGrid.setEditable(false);
@if (count($usr) > 5)
	userGrid.enablePaging(true, 5, 1, "user_grid_info");
	userGrid.setPagingSkin("toolbar");
@endif
	userGrid.attachEvent("onDataReady", function onDataReady() {
		userGrid.filterBy(3, "-1");
	});
	userGrid.init();

	userGrid.enableAlterCss("grid_odd", "grid_even");
	userGrid.enableRowsHover(true, "grid_hover");
	userGrid.load("/grid_/users");
</script>
@endif