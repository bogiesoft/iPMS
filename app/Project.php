<?php

namespace iPMS;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	protected $table = 'projects';
	protected $fillable = [
		'title', 'product', 'start_date', 'end_date', 'plan_start', 'plan_end',
		'version', 'status', 'master_id', 'pm_id', 'level', 'group', 'notes'];
	protected $append = ['ext'];

	public function getExtAttribute()
	{
		return "<br/>".
			$this->version ." - ". $this->status ."<br/>".
			$this->notes ."<br/>";
	}
}
