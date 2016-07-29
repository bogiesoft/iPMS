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
		//
	}

	public function show($id)
	{
		//
	}

	public function update(Request $request, $id)
	{
		//
	}

	public function destroy($id)
	{
		//
	}
}
