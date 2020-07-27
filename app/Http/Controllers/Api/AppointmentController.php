<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AppointmentController extends Controller
{

/*
"id": 1,
"description": "Test",
"speciality_id": 3,
"doctor_id": 3,
"patient_id": 2,
"scheduled_date": "2020-07-30",
"scheduled_time": "17:30:00",
"type": "Consulta",
"created_at": "2020-07-27 13:09:58",
"updated_at": "2020-07-27 13:09:58",
"status": "Reservada"
*/
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
