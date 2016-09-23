<?php

namespace iPMS;

use Illuminate\Database\Eloquent\Model;

class GanttLink extends Model
{
	protected $table = null;
	public $primaryKey = "id";
	protected $fillable = ['id', 'source', 'target', 'type'];
	public $timestamps = false;
	private static $prev_arg = null;

	public function __construct($pid=null)
	{
		if ($pid == null) $pid = self::$prev_arg;
		self::$prev_arg = $pid;	// workaround: 2nd call with null

		$this->table = sprintf("gantt_links%08d", $pid);
		parent::__construct();
	}
}
