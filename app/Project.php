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
		return "<br/>".
			$this->version ." - ". $this->status ."<br/>".
			$this->notes ."<br/>";
	}
}
