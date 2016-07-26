<?php

namespace iPMS\Http\Controllers;

use Illuminate\Http\Request;

use iPMS\Http\Requests;
use iPMS\Http\Controllers\Controller;

class HomeController extends Controller
{
	// Displays the index page of the app
	public function index()
	{
		return view('index');
	}
}
