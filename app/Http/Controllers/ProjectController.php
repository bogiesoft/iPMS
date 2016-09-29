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
        ]);

        Project::create([
        	'title' => $request->input('title'),
        	'product' => $request->input('product'),
        	'start_date' => $request->input('plan_start'),
        	'end_date' => $request->input('plan_end'),
        	'plan_start' => $request->input('plan_start'),
        	'plan_end' => $request->input('plan_end'),
        	'version' => 0,
        	'status' => $request->input('status'),
        	'prj_group' => implode(',', $request->input('prj_group')),
        	'notes' => $request->input('notes'),
        ]);

        return redirect()->route('projects.index');
//        	->with('info','Your Project has been created successfully');
	}

	public function show($id)
	{
		$args = explode("-", $id, 2);
		$project = Project::findOrFail($args[1]);

		switch ($args[0]) {
		case "edt":
			//return view('projects.edit')->withProject($project);
			return view('projects.edit', ['pid' => $id, 'project' => $project]);
		case "tsk":
			return view('projects.task')->withProject($project);
		case "cal":
			return view('projects.calendar')->withProject($project);
		case "hst":
		case "res":
		default:
			break;
		}
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
}
