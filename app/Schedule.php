<?php

namespace iPMS;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';
	protected $fillable = ['user_id', 'start_date', 'end_date', 'text'];
}
