<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
	// $speciality->users
	public function users()
	{
		return $this->belongsToMany(User::class)->withTimestamps();
	}
    
}
