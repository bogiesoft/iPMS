<?php

namespace iPMS;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	protected $table = 'projects';
	protected $fillable = ['title', 'product', 'start_date', 'due_date', 'version', 'status', 'notes'];
	protected $append = ['ext'];

	public function getExtAttribute()
	{
		return "<hr>". $this->version ."-". $this->status;
	}
}
