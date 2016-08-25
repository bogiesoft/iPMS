<?php

namespace iPMS\Http\Controllers;

use Illuminate\Http\Request;

use iPMS\Http\Requests;

class HomeController extends Controller
{
	public function index()
	{
		return view('index');
	}

	public function statistics()
	{
		return view('statistics');
	}

	public function manage($item)
	{
		return view('manage.'. $item);
	}
}
