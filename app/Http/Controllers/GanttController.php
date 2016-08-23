<?php

namespace iPMS\Http\Controllers;

use Illuminate\Http\Request;
use iPMS\Http\Requests;

use iPMS\GanttTask;
use iPMS\GanttLink;
use Dhtmlx\Connector\GanttConnector;

class GanttController extends Controller
{
	public function data($id) {
		$conn = new GanttConnector(null, "PHPLaravel");
		$conn->enable_order("sortorder");
		$conn->render_links(new GanttLink(), "id", "source,target,type");
		$conn->render_table(new GanttTask(), "id",
			"start_date,duration,text,progress,sortorder,type,parent");
	}
}
