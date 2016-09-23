<?php

namespace iPMS;

use Illuminate\Database\Eloquent\Model;

class GanttTask extends Model
{
	protected $table = null;
	public $primaryKey = "id";
	protected $fillable = [
		'id', 'text', 'start_date', 'duration', 'progress', 'type', 'parent'];
	public $timestamps = false;
	private static $prev_arg = null;

	public function __construct($pid=null)
	{
		if ($pid == null) $pid = self::$prev_arg;
		self::$prev_arg = $pid;	// workaround: 2nd call with null

		$this->table = sprintf("gantt_tasks%08d", $pid);
		parent::__construct();
	}
}
