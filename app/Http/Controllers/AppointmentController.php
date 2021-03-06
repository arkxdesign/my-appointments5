<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Speciality;
use App\Appointment;
use App\CancelledAppointment;
use App\User;

use App\Interfaces\ScheduleServiceInterface;
use App\Http\Requests\StoreAppointment;

use Carbon\carbon;
use Validator;

class AppointmentController extends Controller
{
	
	public function index()
	{

		$role = auth()->user()->role;

		//Admin ->all
		if ($role == 'admin') {
		$pendingAppointments = Appointment::where('status', 'Reservada')
			->paginate(10);
		$confirmedAppointments = Appointment::where('status', 'Confirmada')
			->paginate(10);
		$oldAppointments = Appointment::whereIn('status', ['Atendida','Confirmada', 'Cancelada'])
			->orderBy('id', 'desc')
			->paginate(50);


		//Doctor
		}elseif ($role == 'doctor') {
		$pendingAppointments = Appointment::where('status', 'Reservada')
			->where('doctor_id', auth()->id())
			->paginate(10);
		$confirmedAppointments = Appointment::where('status', 'Confirmada')
			->where('doctor_id', auth()->id())
			->paginate(10);
		$oldAppointments = Appointment::whereIn('status', ['Atendida','Confirmada', 'Cancelada'])
			->where('doctor_id', auth()->id())
			->orderBy('updated_at', 'desc')
			->paginate(50);		

		}elseif ($role == 'patient') {
		//Patient
		$pendingAppointments = Appointment::where('status', 'Reservada')
			->where('patient_id', auth()->id())
			->paginate(10);
		$confirmedAppointments = Appointment::where('status', 'Confirmada')
			->where('patient_id', auth()->id())
			->orderBy('id','desc')
			->paginate(10);
		$oldAppointments = Appointment::whereIn('status', ['Atendida','Confirmada', 'Cancelada'])
			->where('patient_id', auth()->id())
			->orderBy('id', 'desc')
			->paginate(10);
	
		}

		return view('appointments.index',
			compact('pendingAppointments', 'confirmedAppointments', 'oldAppointments', 'role'));
	}

		public function show(Appointment $appointment)
	{
		$role = auth()->user()->role;
		return view('appointments.show', compact('appointment', 'role'));
	}

	public function create(ScheduleServiceInterface $scheduleService)
	{
		$specialities = Speciality::all();

		$specialityId = old('speciality_id');
		if ($specialityId) {
			$speciality = Speciality::find($specialityId);
			$doctors = $speciality->users;
		} else {
				$doctors = collect();
		}
	
			$date = old('scheduled_date');
			$doctorId = old('doctor_id');
			if ($date && $doctorId) {
				$intervals = $scheduleService->getAvailableIntervals($date, $doctorId);	
			} else {
				$intervals = null;
			
			}
		
	    	return view('appointments.create', compact('specialities', 'doctors', 'intervals')
	    		);
	}

	public function store(StoreAppointment $request)
	{
		$created = Appointment::createForPatient($request, auth()->id());
		if ($created)
			$notification = 'La cita se ha registrado correctamente!';
		else
			$notification = 'Ocurrió un problema al registrar la cita médica.';

		return back()->with(compact('notification'));
		// return redirect('/appointments');
	}

	public function showCancelForm(Appointment $appointment)
	{
		if ($appointment->status == 'Confirmada') {
			$role = auth()->user()->role;
			return view('appointments.cancel', compact('appointment','role'));
		}
		return redirect('/appointments');
	}

	public function postCancel(Appointment $appointment, Request $request)
	{
		if ($request->has('justification')) {
			$cancellation = new CancelledAppointment();
			$cancellation->justification = $request->input('justification');
			$cancellation->cancelled_by_id = auth()->id();
			//dd($cancellation);
			$appointment->cancellation()->save($cancellation);
		}		
		
		$appointment->status = 'Cancelada';
		$saved = $appointment->save(); // update

		if ($saved)
			$appointment->patient->sendFCM('Su cita se ha sido cancelada.');

		$notification = 'La cita de ha cancelado correctamente.';
		return redirect('/appointments')->with(compact('notification'));
	}

		public function postConfirm(Appointment $appointment)
	{
		
		$appointment->status = 'Confirmada';
		$saved = $appointment->save(); // update

		if ($saved)
			$appointment->patient->sendFCM('Su cita se ha confirmado!');

		$notification = 'La cita se ha confirmada correctamente.';
		return redirect('/appointments')->with(compact('notification'));
	}

		public function postAttended(Appointment $appointment)
	{
		
		$appointment->status = 'Atendida';
		$saved = $appointment->save(); // update

		if ($saved)
			$appointment->patient->sendFCM('Gracias por su visita!');

		$notification = 'La cita se ha marcado como atendida correctamente.';
		return redirect('/appointments')->with(compact('notification'));
	}

	public function buscador(Request $request){

	$role = auth()->user()->role;

		//Admin ->all
		if ($role == 'admin') {
		$search  = $request->get('searchId');
        $searchId = Appointment::where('id', 'like', "%$search%")
        ->take(20)
        ->get();		

		//Doctor
		}elseif ($role == 'doctor') {
		$search  = $request->get('searchId');
        $searchId = Appointment::where('id', 'like', "%$search%")
        ->where('doctor_id', auth()->id())
        ->take(20)
        ->get();

		}elseif ($role == 'patient') {
		
		$search  = $request->get('searchId');
        $searchId = Appointment::where('id', 'like', "%$search%")
        ->where('patient_id', auth()->id())
        ->take(20)
        ->get();

		}	

			//$searchId = Appointment::where("id", "like", $request->searchId."%")
			//->where('patient_id', auth()->id())
			//->orderBy('id','desc')
			//->get();
			//->paginate(10);
			
		//dd($searchId);

        return view('appointments.page', compact('role', 'searchId'));
    
	}

}



