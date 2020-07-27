<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AppointmentController extends Controller
{

    public function index()
    {
    	$user = Auth::guard('api')->user();
    	$appointments = $user->asPatientAppointments()
    	->with([
    		'speciality' => function ($query){
    			$query->select('id','name');
    		}, 
    		'doctor' => function ($query){
    			$query->select('id', 'name');
    		}
    	])
    	->get([
				"id",		
				"description",
				"speciality_id",
				"doctor_id",
				"scheduled_date",
				"scheduled_time",
				"type",
				"created_at",
				"status"
	    	]);
    	return $appointments;
    }

    public function store()
    {

    }
}
