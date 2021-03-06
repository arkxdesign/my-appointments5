<?php

Route::get('/', function () {
    //return view('welcome');
    return redirect('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth', 'admin'])->namespace('Admin')->group(function () {
//Specialty
Route::get('/specialties', 'SpecialityController@index');
Route::get('/specialties/create', 'SpecialityController@create'); // form registro
Route::get('/specialties/{speciality}/edit', 'SpecialityController@edit'); // Editar
Route::post('/specialties', 'SpecialityController@store'); // envío del form
Route::put('/specialties/{speciality}', 'SpecialityController@update'); // Actualizar la información requiriendo el metodo Editar
Route::delete('/specialties/{speciality}', 'SpecialityController@destroy');
// Doctors   php artisan make:controller DoctorController --resource
Route::resource('doctors', 'DoctorController');
// Patients   php artisan make:controller PatientController --resource
Route::resource('patients', 'PatientController');
//Charts
Route::get('/charts/appointments/line', 'ChartController@appointments');
Route::get('/charts/doctors/column', 'ChartController@doctors');
Route::get('/charts/doctors/column/data', 'ChartController@doctorsJson');

//FCM
Route::post('/fcm/send', 'FirebaseController@sendAll');


});

Route::middleware(['auth', 'doctor'])->namespace('Doctor')->group(function () {
// Doctors function
Route::get('/schedule', 'ScheduleController@edit');
Route::post('/schedule', 'ScheduleController@store');	

});

Route::middleware('auth')->group(function() {
// Patient
Route::get('/profile', 'UserController@Edit');
Route::post('/profile', 'UserController@update');

Route::middleware('phone')->group(function () {
	Route::get('/appointments/create', 'AppointmentController@create');
	Route::post('/appointments', 'AppointmentController@store');
});



Route::get('/appointments', 'AppointmentController@index');
// RUTA PARA EL BUSCADOR
Route::get('/appointments/page', 'AppointmentController@buscador');

Route::get('/appointments/{appointment}', 'AppointmentController@show');


Route::get('/appointments/{appointment}/cancel', 'AppointmentController@showCancelForm');
Route::post('/appointments/{appointment}/cancel', 'AppointmentController@postCancel');

Route::post('/appointments/{appointment}/confirm', 'AppointmentController@postConfirm');
Route::post('/appointments/{appointment}/attended', 'AppointmentController@postAttended');
	
	
});
