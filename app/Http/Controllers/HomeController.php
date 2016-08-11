<?php

namespace iPMS\Http\Controllers;

use Illuminate\Http\Request;

use iPMS\Http\Requests;
use iPMS\Http\Controllers\Controller;

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
}
