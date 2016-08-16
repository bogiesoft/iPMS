<?php

namespace iPMS;

use Illuminate\Database\Eloquent\Model;

class GanttLink extends Model
{
	protected $table = "gantt_links";
	public $primaryKey = "id";
	protected $fillable = ['id', 'source', 'target', 'type'];
	public $timestamps = false;
}
