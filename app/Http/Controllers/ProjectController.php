<?php

namespace iPMS\Http\Controllers;

use Illuminate\Http\Request;

use iPMS\Http\Requests;
use iPMS\Project;
//use iPMS\GanttTask;
//use iPMS\GanttLink;
//use Dhtmlx\Connector\GanttConnector;

class ProjectController extends Controller
{
	public function index()
	{
		$projects = Project::all();
		return view('projects.index')->withProject($projects);
	}

	public function create()
	{
		return view('projects.new');
	}

	public function store(Request $request)
	{
		//
	}

	public function show($id)
	{
		//$connector = new GanttConnector(null, "PHPLaravel");
		//$connector->render_links(new GanttLink(), "id", "source,target,type");
	   	//$connector->render_table(new GanttTask(),"id","start_date,duration,text,progress,parent");

		return view('projects.task');
	}

	public function update(Request $request, $id)
	{
		//
	}

	public function destroy($id)
	{
		//
	}

	public function summary()
	{
		return view('projects.summary');
	}
}
