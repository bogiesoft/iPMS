<?php

namespace iPMS;
use Auth;

class iPMS {
	private static $PROJECT_GROUP1 = [
		"Camera",
		"Recoder",
		"Solution",
		"Product",
	];
	private static $PROJECT_GROUP2 = [
		"개발1실",
		"개발2실",
	];
	private static $PROJECT_GROUP = null;

	private static $DEVELOP_GROUP = [
		"연구1팀",
		"연구2팀",
		"연구3팀",
		"연구4팀",
		"연구5팀",
		"연구6팀",
		"연구7팀",
		"연구8팀",
		"기구팀",
		"디자인팀",
		"연구기술팀",
	];

	private static $USER_GROUP = [
		-1 => "미승인",
		0  => "Administrator",
		1  => "Manager",
		9  => "PMO",
		10 => "PM",
		11 => "PL",
		12 => "PE",
		20 => "Guest",
	];

	private static $PROJECT_LEVEL = [
		1  => "PM1",
		2  => "PM2",
		3  => "PM3",
		4  => "설계변경",
		10 => "상품도입",
		20 => "기타",
	];

	private static $PROJECT_STATUS = [
		-1 => "Template",
		1  => "신규검토",
		2  => "경영계획",
		3  => "상품승인",
		10 => "개발계획",
		11 => "개발중",
		20 => "완료",
		21 => "취소",
		99 => "삭제",
	];

	public static function ProjectGroup($idx=null) {
		if (self::$PROJECT_GROUP == null)
			self::$PROJECT_GROUP = array_merge($this->PROJECT_GROUP1,
											   $this->PROJECT_GROUP2);
		return ($idx == null) ? self::$PROJECT_GROUP : self::$PROJECT_GROUP[$idx];
	}
	public static function DevelopGroup($idx=null)
	{ return ($idx == null) ? self::$DEVELOP_GROUP : self::$DEVELOP_GROUP[$idx]; }
	public static function UserGroup($idx=null)
	{ return ($idx == null) ? self::$USER_GROUP : self::$USER_GROUP[$idx]; }

/**
	public static function checkboxProjectGroup($old=false)
	{
		$old_val = 0;
		if ($old)
			foreach ($old as $arr) $old_val |= $arr;

		foreach (self::$PROJECT_GROUP1 as $key => $val) {
			echo '<label class="checkbox-inline">'.
				'<input type="checkbox" name="prj_group[]" ';
			if ($key & $old_val) echo 'checked ';
			echo 'value="'. $key .'">'. $val .'</label>';
		}
		echo '</br>';
		foreach (self::$PROJECT_GROUP2 as $key => $val) {
			echo '<label class="checkbox-inline">'.
				'<input type="checkbox" name="prj_group[]" ';
			if ($key & $old_val) echo 'checked ';
			echo 'value="'. $key .'">'. $val .'</label>';
		}
	}
**/

	public static function selectProjectGroup($old=[])
	{
		echo "<select class='selectpicker' multiple data-width='100%' name='prj_group[]'>";
		echo "<optgroup label='Product Type'>";
		foreach (self::$PROJECT_GROUP1 as $val) {
			echo "<option ";
			if ($old && in_array($val, $old)) echo "selected ";
			echo ">". $val ."</option>";
		}
		echo "</optgroup>";
		echo "<optgroup label='Development Group'>";
		foreach (self::$PROJECT_GROUP2 as $val) {
			echo "<option ";
			if ($old && in_array($val, $old)) echo "selected ";
			echo ">". $val ."</option>";
		}
		echo "</optgroup>";
		echo "</select>";
	}

/////////////////////////////////////////////////////////////////////

	private static $PROJECT_WORKFLOW = [
		// from => user, approver, to
		0  => [[1, 9, 10], [],      [1]],
		1  => [[9, 10],    [1],     [2, 3, 21]],
		2  => [[10],       [1],     [3, 21]],
		3  => [[10],       [1],     [10, 21]],
		10 => [[10],       [1],     [11, 21]],
		11 => [[10],       [1],     [11, 20, 21]],
	];

	public static function isProjectUser($state)
	{
		$usr = self::$PROJECT_WORKFLOW[$state][0];
		if (count($usr) == 0) return true;

		for ($i = 0; $i < count($usr); $i++)
			if (Auth::user()->group == $usr[$i]) return true;
		return false;
	}
}
