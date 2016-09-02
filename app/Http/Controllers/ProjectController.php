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
            'plan_start' => 'required|date',
            'plan_end' => 'required|date',
			'status' => 'required',
			'prj_group' => 'required',
/**
            'master_id' => 'required',
            'pm_id' => 'required',
**/
        ]);

		$request_prj_group = 0;
		foreach ($request->input('prj_group') as $arr)
			$request_prj_group |= $arr;

        Project::create([
        	'title' => $request->input('title'),
        	'product' => $request->input('product'),
        	'plan_start' => $request->input('plan_start'),
        	'plan_end' => $request->input('plan_end'),
        	'version' => 0,
        	'status' => $request->input('status'),
        	'prj_group' => $request_prj_group,
        	'notes' => $request->input('notes'),
        ]);

        return redirect()->route('projects.index');
//        	->with('info','Your Project has been created successfully');
	}

	public function show($id)
	{
		return view('projects.task');
	}

	public function update(Request $request, $id)
	{
		$project = Project::findOrFail($id);
		$this->validate($request, [
            'title' => 'required|min:3',
            'product' => 'required|min:3',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
			'status' => 'required',
        ]);

        $project->version += 1;
        $values = $request->all();
        $project->fill($values)->save();

        return redirect()->back()
        	->with('info', 'Your Project has been updated successfully');
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
