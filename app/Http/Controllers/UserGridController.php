<?php

namespace iPMS\Http\Controllers;

use iPMS\UserGrid;
use Dhtmlx\Connector\GridConnector;

class UserGridController extends Controller
{
	public function data() {
		$connector = new GridConnector(null, "PHPLaravel");
		$connector->configure(
			//UserGrid()::where('id', '=', 1)->get(),
			new UserGrid(),
			"id",
			"uid, fullname, email");
		$connector->render();
	}
}
