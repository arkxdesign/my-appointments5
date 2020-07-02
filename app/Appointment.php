<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Appointment extends Model
{
    protected $fillable = [

    	'description',
    	'speciality_id',
    	'doctor_id',
    	'patient_id',
    	'scheduled_date',
    	'scheduled_time',
    	'type'
    ];

    // N $appointment->speciality 1
    public function speciality()
    {
    	return $this->belongsTo(Speciality::class);
    }

    // N $appointment->doctor 1
    public function doctor()
    {
    	return $this->belongsTo(User::class);
    }

    // N $appointment->patient 1
    public function patient()
    {
    	return $this->belongsTo(User::class);
    }

    // Relacion 1 a 1 o 1 a 0
    // $appointmernt->cancellation->justification
    public function cancellation()
    {
        return $this->hasOne(CancelledAppointment::class);

    }
    // accesor
    // $appointment->scheduled_time_12
    public function getScheduledtime12Attribute() {
    	return (new Carbon($this->scheduled_time))
    	->format('g:i A');

    }
}
