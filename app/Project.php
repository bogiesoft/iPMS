<?php

namespace iPMS;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	protected $table = 'projects';

	protected $fillable = ['title', 'product', 'notes', 'version', 'status', 'group', 'master_id', 'pm_id', 'start_date', 'due_date'];

}
