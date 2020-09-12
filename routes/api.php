<?php

    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');

// Public Data
	Route::get('/specialties', 'ApiSpecialityController@index');
	Route::get('/specialties/{speciality}/doctors', 'ApiSpecialityController@doctors');
	Route::get('/schedule/hours', 'ScheduleController@hours');

Route::middleware('auth:api')->group(function () {

		Route::get('/user', 'UserController@show');
		Route::post('/user', 'UserController@update');
		Route::post('/logout', 'AuthController@logout');


// appointments
		Route::get('/appointments', 'AppointmentController@index');
		Route::post('/appointments', 'AppointmentController@store');

// FCM
		Route::post('/fcm/token', 'FireBaseController@postToken');
});
