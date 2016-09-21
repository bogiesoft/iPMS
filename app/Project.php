<?php

namespace iPMS;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	protected $table = 'projects';
	protected $fillable = ['title', 'product', 'start_date', 'end_date',
		'plan_start', 'plan_end', 'level', 'version', 'status',
		'prev_id', 'master_id', 'pm_id', 'prj_group', 'dev_group', 'budget', 'notes'];
	protected $append = ['ext'];

	public function getExtAttribute()
	{
		return
			"<br/><font size='2'>".
			$this->attrStr("Project Level", iPMS::ProjectLevel($this->level)).
			$this->attrStr("Project Manager", $this->pm_id).
			$this->attrStr("Project Group", $this->prj_group).
			$this->attrStr("Develop Group", $this->dev_group).
			$this->attrStr("Budget", $this->budget).
			$this->attrStr("Note", $this->notes).
			"</font><br/>";
	}

	private function attrStr($title, $val)
	{
		return "<div class='row'><div class='col-sm-2 text-right'><b>".
			$title ."</b></div>". $val ."</div>";
	}
}
