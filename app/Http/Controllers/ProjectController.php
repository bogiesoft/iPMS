<?php

namespace iPMS\Http\Controllers;

use Illuminate\Http\Request;

use iPMS\Http\Requests;
use iPMS\Project;

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
        $this->validate($request, [
            'title' => 'required|min:3',
            'product' => 'required|min:3',
            'start_date' => 'required|date',
            'due_date' => 'required|date',
            'version' => 'required',
			'status' => 'required',
/**
            'master_id' => 'required',
            'pm_id' => 'required',
            'status' => 'required',
            'group' => 'required',
**/
        ]);

        Project::create([
        	'title' => $request->input('title'),
        	'product' => $request->input('product'),
        	'start_date' => $request->input('start_date'),
        	'due_date' => $request->input('due_date'),
        	'version' => $request->input('version'),
        	'status' => $request->input('status'),
        	'notes' => $request->input('notes'),
        ]);

        return redirect()->route('projects.index');
//        	->with('info','Your Project has been created successfully');
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
