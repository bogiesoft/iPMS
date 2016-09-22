<?php

namespace iPMS;

use Illuminate\Database\Eloquent\Model;

class GanttTask extends Model
{
	protected $table = "gantt_tasks";
	public $primaryKey = "id";
	protected $fillable = [
		'id', 'text', 'start_date', 'duration', 'progress', 'type', 'parent'];
	public $timestamps = false;
}
