<?php

namespace iPMS\Http\Controllers;

use Illuminate\Http\Request;

use iPMS\Http\Requests;
use iPMS\Schedule;

class ScheduleController extends Controller
{
	public function show($id)
	{
		return view('schedules.show');
	}
}
