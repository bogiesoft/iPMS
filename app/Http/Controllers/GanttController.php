<?php

namespace iPMS\Http\Controllers;

use Illuminate\Http\Request;
use iPMS\Http\Requests;

use iPMS\GanttTask;
use iPMS\GanttLink;
use Dhtmlx\Connector\GanttConnector;

class GanttController extends Controller
{
	public function data($id) {
		$conn = new GanttConnector(null, "PHPLaravel");
		$conn->enable_order("sortorder");
		$conn->render_links(new GanttLink(), "id", "source,target,type");
		$conn->render_table(new GanttTask(), "id",
			"start_date,duration,text,progress,sortorder,type,parent,open");
			//, false, "parent");
	}

	public function save(Request $request, $id) {
		switch ($request->input('!nativeeditor_status')) {
		case 'inserted':
			if ($request->input('gantt_mode') == "tasks")
				GanttTask::create([
				    'id' => $request->input('id'),
				    'text' => $request->input('text'),
					'start_date' => $request->input('start_date'),
					'duration' => $request->input('duration'),
					'progress' => $request->input('progress'),
					'type' => $request->input('type'),
					'parent' => $request->input('parent'),
				]);
			else	// links
				GanttLink::create([
					'id' => $request->input('id'),
					'source' => $request->input('source'),
					'target' => $request->input('target'),
					'type' => $request->input('type'),
				]);
			break;

		case 'deleted':
			if ($request->input('gantt_mode') == "tasks")
				$model = GanttTask::findOrFail($request->input('id'));
			else	// links
				$model = GanttLink::findOrFail($request->input('id'));
			$model->delete();
			break;

		case 'updated':
			if ($request->input('gantt_mode') == "tasks") {
				$model = GanttTask::findOrFail($request->input('id'));
				$model->fill([
				    'text' => $request->input('text'),
					'start_date' => $request->input('start_date'),
					'duration' => $request->input('duration'),
					'progress' => $request->input('progress'),
					'type' => $request->input('type'),
					'parent' => $request->input('parent'),
				]);
			}
			else {	// links
				$model = GanttLink::findOrFail($request->input('id'));
				$model->fill([
					'source' => $request->input('source'),
					'target' => $request->input('target'),
					'type' => $request->input('type'),
				]);
			}
			$model->save();
			break;
		}
	}
}
