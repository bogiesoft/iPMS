<?php

namespace iPMS;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	protected $table = 'projects';

	protected $fillable = ['project_name', 'project_notes', 'project_status', 'user_id', 'due_date'];

}
