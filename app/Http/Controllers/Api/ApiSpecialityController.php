<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Speciality;



class ApiSpecialityController extends Controller
{
	public function index()
	{
		return Speciality::all(['id', 'name']);
	}

    public function doctors(Speciality $speciality)
    {
    	return $speciality->users()->get([
    		'users.id', 'users.name'
    	]);
    }
}
