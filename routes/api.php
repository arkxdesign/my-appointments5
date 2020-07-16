<?php

// use Illuminate\Http\Request;

Route::post('/login', 'AuthController@login');

	//JSON
	// Public resources
	Route::get('/specialties', 'ApiSpecialityController@index');
	Route::get('/specialties/{speciality}/doctors', 'ApiSpecialityController@doctors');
	Route::get('/schedule/hours', 'ScheduleController@hours');

Route::middleware('auth:api')->group(function () {

		Route::get('/user', 'UserController@show');
		Route::post('/logout', 'AuthController@logout');

	// Post appointment	
	
});
