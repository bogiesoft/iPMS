<?php

namespace iPMS;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid', 'password', 'fullname', 'email', 'level',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	public function getAvatarUrl()
	{
		return "http://www.gravatar.com/avatar/" . md5(strtolower(trim($this->email))) . "?d=mm&s=40";
	}
}
