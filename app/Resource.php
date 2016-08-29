<?php

namespace iPMS;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
	protected $table = 'resources';
	protected $fillable = ['name', 'group', 'type', 'cost', 'unit', 'notes'];
}
