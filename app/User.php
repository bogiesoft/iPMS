<?php

namespace iPMS;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['uid', 'password', 'email', 'fullname', 'group'];
    protected $hidden = ['password', 'remember_token'];

	public function getAvatarUrl()
	{
        return "/images/avatar.jpg";
		//return "http://www.gravatar.com/avatar/" . md5(strtolower(trim($this->email))) . "?d=mm&s=40";
	}
}
