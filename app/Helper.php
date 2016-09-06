<?php

namespace iPMS;
use Auth;

class iPMS {
	private static $PROJECT_GROUP1 = [
		0x0001 => "Camera",
		0x0002 => "Recoder",
		0x0004 => "Solution",
		0x0008 => "Product",
	];
	private static $PROJECT_GROUP2 = [
		0x1000 => "개발1실",
		0x2000 => "개발2실",
	];
	private static $PROJECT_GROUP = null;

	private static $DEVELOP_GROUP = [
		0x0001 => "연구1팀",
		0x0002 => "연구2팀",
		0x0004 => "연구3팀",
		0x0008 => "연구4팀",
		0x0010 => "연구5팀",
		0x0020 => "연구6팀",
		0x0040 => "연구7팀",
		0x0080 => "연구8팀",
		0x0100 => "기구팀",
		0x0200 => "디자인팀",
		0x0400 => "연구기술팀",
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
		1  => "검토중",
		2  => "경영계획",
		3  => "상품승인",
		10 => "개발계획",
		11 => "개발중",
		20 => "완료",
		21 => "취소",
		99 => "삭제",
	];

	public static function ProjectGroup($idx) {
		if (self::$PROJECT_GROUP == null)
			self::$PROJECT_GROUP = array_merge($this->PROJECT_GROUP1,
											   $this->PROJECT_GROUP2);
		return self::$PROJECT_GROUP[$idx];
	}
	public static function DevelopGroup($idx) { return self::$DEVELOP_GROUP[$idx]; }
	public static function UserGroup($idx) { return self::$USER_GROUP[$idx]; }

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
