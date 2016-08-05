<?php

namespace iPMS;

use Illuminate\Database\Eloquent\Model;

class UserGrid extends Model
{
	protected $table = "users";
	public $primaryKey = "id";
	public $timestamps = false;
}
