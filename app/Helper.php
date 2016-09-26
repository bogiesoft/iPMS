<?php

namespace iPMS;
use Auth;
use iPMS\Project;
use iPMS\GanttTask;

class iPMS {
	public static $PROJECT_GROUP1 = [
		"Camera",
		"Recoder",
		"Solution",
		"Product",
	];
	public static $PROJECT_GROUP2 = [
		"개발1실",
		"개발2실",
	];
	public static $PROJECT_GROUP = null;

	public static $DEVELOP_GROUP = [
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

	public static $USER_GROUP = [
		-1 => "미승인",
		0  => "Administrator",
		1  => "Manager",
		9  => "PMO",
		10 => "PM",
		11 => "PL",
		12 => "PE",
		20 => "Guest",
	];

	public static $PROJECT_LEVEL = [
		1  => "PM1",
		2  => "PM2",
		3  => "PM3",
		4  => "설계변경",
		10 => "상품도입",
		20 => "기타",
	];

	public static $PROJECT_STATUS = [
		-1 => "Template",
		0  => "신규검토",
		1  => "경영계획",
		2  => "상품승인",
		10 => "개발계획",
		11 => "개발중",
		20 => "완료",
		21 => "취소",
		99 => "삭제",
	];

	public static $RESOURCE_TYPE = [
		0 => "작업",
		1 => "재료",
		2 => "투자",
	];

	public static $RESOURCE_UNIT = [
		0 => "",
		1 => "/시간",
		2 => "/일",
		3 => "/주",
		4 => "/월",
		5 => "/년",
	];

	public static function ProjectGroup($idx=null) {
		if (self::$PROJECT_GROUP == null)
			self::$PROJECT_GROUP = array_merge($this->PROJECT_GROUP1,
											   $this->PROJECT_GROUP2);
		return $idx ? self::$PROJECT_GROUP[$idx] : null;
	}
	public static function ProjectLevel($idx=null)
	{ return $idx ? self::$PROJECT_LEVEL[$idx] : null; }
	public static function DevelopGroup($idx=null)
	{ return $idx ? self::$DEVELOP_GROUP[$idx] : null; }
	public static function UserGroup($idx=null)
	{ return $idx ? self::$USER_GROUP[$idx] : null; }

	public static function printForEach($varname, $str)
	{
		eval("\$var = self::\$". $varname .";");
		foreach ($var as $key => $val) {
			eval("\$cmd = \"$str\";");
			echo $cmd .";";
		}
	}

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

	public static function isWorkFlowwUser($state)
	{
		if (! Auth::user()) return false;

		$usr = self::$PROJECT_WORKFLOW[$state][0];
		if (count($usr) == 0) return true;

		for ($i = 0; $i < count($usr); $i++)
			if (Auth::user()->group == $usr[$i]) return true;
		return false;
	}

	public static function countProjectGroup()
	{
		foreach (self::$PROJECT_GROUP1 as $arr) {
			echo "&nbsp; &nbsp; &nbsp; &nbsp;". $arr
			." <span class='label label-primary'>".
			0
			."</span>";
		}
	}

	public static function dataProjectDelay()
	{
		echo "[";
		foreach (self::$PROJECT_GROUP1 as $arr) {
			$d1 = 23;
			$d2 = 30;
			echo '{day1:"'. $d1 .'", day2:"'. $d2 .'", day:"'.
				  ($d1+$d2) .'", group:"'. $arr .'"},';
		}
		echo "]";
	}

	public static function showDelayProjectTask()
	{
		$today = date('Y-m-d H:i:s');
		$delay = GanttTask::where('progress', '<', 1)
					->where('end_date', '<', $today)->get();

		echo "<div>&nbsp; &nbsp; &nbsp; &nbsp;".
			"<a data-toggle='collapse' href='#collapse1'>".
			"Project ABCD</a></div>".
			"<div id='collapse1' class='panel-collapse collapse col-sm-offset-1'>".
			"<table class='table table-striped'>".
			"<thead><tr>".
			"<th>Task</th><th>Progress</th><th>Start Date</th><th>End Date</th>".
			"<th>Delay</th></tr></thead><tbody>";
		foreach ($delay as $task) {
			$t1 = strtotime($today);
			$t2 = strtotime($task->end_date);
			$delay = intval(($t1 - $t2) / (24*3600));

			echo "<tr><td>". $task->text . "</td>".
				"<td>". $task->progress*100 . " %</td>".
				"<td>". $task->start_date . "</td>".
				"<td>". $task->end_date . "</td>".
				"<td>".  $delay ." days</td>";
		}
		echo "</tbody></table></div>";
	}
/////////////////////////////////////////////////////////////////////

	public static function AuthUser($attr)
	{
		$ret = null;
		if (Auth::user()) eval("\$ret = Auth::user()->". $attr .";");
		return $ret;
	}

/////////////////////////////////////////////////////////////////////

	public static function CSSHeightCalc($str)
	{
		return "height:calc($str);height:-webkit-calc($str);height:-moz-calc($str);";
	}
}
