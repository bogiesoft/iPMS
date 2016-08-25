<?php

namespace iPMS\Http\Controllers;

use iPMS\User;
use iPMS\Project;
use iPMS\Schedule;
use Dhtmlx\Connector\GridConnector;

class GridController extends Controller
{
	public function data($tbl) {
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
}
