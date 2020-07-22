<?php

    Route::post('/login', 'AuthController@login');

// Public Data
	Route::get('/specialties', 'ApiSpecialityController@index');
	Route::get('/specialties/{speciality}/doctors', 'ApiSpecialityController@doctors');
	Route::get('/schedule/hours', 'ScheduleController@hours');

Route::middleware('auth:api')->group(function () {

		Route::get('/user', 'UserController@show');
		Route::post('/logout', 'AuthController@logout');


	
});
