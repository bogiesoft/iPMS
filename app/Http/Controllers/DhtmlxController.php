<?php

namespace iPMS\Http\Controllers;

use iPMS\User;
use iPMS\Project;
use iPMS\Schedule;
use iPMS\GanttTask;
use iPMS\GanttLink;

use Dhtmlx\Connector\GridConnector;
use Dhtmlx\Connector\GanttConnector;

class DhtmlxController extends Controller
{
	public function grid($tbl) {
		$connector = new GridConnector(null, "PHPLaravel");

		switch ($tbl) {
		case "users":
			//$model = new User();
			$model = User::where('id', '>', 0)->get();
			$data  = "uid,fullname,email,group";
			break;
		case "projects":
			$model = new Project();
			//$connector->mix("ext2", "111");
			$data  = "ext,title,product,plan_start,plan_end,start_date,end_date,level,version,status";
			break;
		case "schedules":
			$model = new Schedule();
			$data  = "uid,start_date,end_date,text";
			break;
		}

		$connector->configure($model, "id", $data);
		$connector->render();
	}

	public function gantt($id) {
		$conn = new GanttConnector(null, "PHPLaravel");
		$conn->enable_order("sortorder");
		$conn->render_links(new GanttLink(), "id", "source,target,type");
		$conn->render_table(new GanttTask(), "id",
			"start_date,duration,text,progress,sortorder,type,parent");
	}

}
