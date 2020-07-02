<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use App\Appointment;
use App\User;
use DB;
use Carbon\Carbon;

class ChartController extends Controller
{
    public function appointments()
    {
        

         $array = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
         //$meses = Arr::prepend($meses, 'meses');
         $meses = Arr::wrap($array);


    	$monthlyCounts = Appointment::select(
    		DB::raw('MONTH(created_at) as month'), 
    		DB::raw('COUNT(1) as count')
        	)->groupBy('month')->get()->toArray();
    		// [ ['month'=>11, 'count'=>3] ]  estoes lo que tenemos
    		// [ 0,0,0,0,0,0,0,.,,,,3,0] esto es lo que queremos

		$counts = array_fill(0, 12, 0); //index, qty, value
		foreach ($monthlyCounts as $monthlyCount) {
			$index = $monthlyCount['month']-1;
			$counts[$index] = $monthlyCount['count'];

        }

        //Canceladas
        $status = Appointment::select(
            DB::raw('MONTH(updated_at) as month'), 
            DB::raw('COUNT(1) as count')
            )->groupBy('month')->where('status', 'Cancelada')->get()->toArray();
        
        $cancelled = array_fill(0,12,0);
        foreach ($status as $status){
            $index = $status['month']-1;
            $cancelled[$index] = $status['count'];
        }
        //Atendidas
        $status2 = Appointment::select(
            DB::raw('MONTH(updated_at) as month'), 
            DB::raw('COUNT(1) as count')
            )->groupBy('month')->where('status', 'Atendida')->get()->toArray();
        
        $attended = array_fill(0,12,0);
        foreach ($status2 as $status2){
            $index = $status2['month']-1;
            $attended[$index] = $status2['count'];
        }
        //Confirmadas
        $status3 = Appointment::select(
            DB::raw('MONTH(updated_at) as month'), 
            DB::raw('COUNT(1) as count')
            )->groupBy('month')->where('status', 'Confirmada')->get()->toArray();
        
        $confirmed = array_fill(0,12,0);
        foreach ($status3 as $status3){
            $index = $status3['month']-1;
            $confirmed[$index] = $status3['count'];
        
        }

         $array = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
         //$meses = Arr::prepend($meses, 'meses');
         $meses = Arr::wrap($array);
         
        //dd($cancelled); 
        //dd($specialities->all());    
               	    
    	return view('charts.appointments', compact('counts', 'cancelled', 'attended',
'confirmed', 'meses'));
        
    }

    public function doctors()
    {
    	$now = Carbon::now();
    	$end = $now->addMonth()->format('Y-m-d');  // si queremos la fecha actual quitamos addMonth()->
    	$start = $now->subMonth(2)->format('Y-m-d');    //2 meses antes
        // $start = $now->subYear()->format('Y-m-d');  //Un año antes

    	return view('charts.doctors', compact('start', 'end'));
    }

    public function doctorsJson(Request $request)
    {
    	$start = $request->input('start');
    	$end = $request->input('end');

    	$doctors = User::doctors()
    		->select('name')
    		->withCount([
    			'attendedAppointments' => function ($query) use ($start, $end) {
    				$query->whereBetween('scheduled_date', [$start, $end]);
    			}, 
    			'cancelledAppointments' => function ($query) use ($start, $end) {
    				$query->whereBetween('scheduled_date', [$start, $end]);
    			} 
    		])
    		->orderBy('attended_appointments_count', 'desc')
    		->take(3) // Cantidad de Doctores
    		->get();

    	$data = [];
    	$data['categories'] = $doctors->pluck('name');

    	$series = [];
    	// Atentidas
    	$series1['name'] = 'Citas atendidas';
    	$series1['data'] = $doctors->pluck('attended_appointments_count');
    	// Cenceladas
    	$series2['name'] = 'Citas canceladas';
    	$series2['data'] = $doctors->pluck('cancelled_appointments_count');

    	$series[] = $series1; //Atendidas
    	$series[] = $series2; //Canceladas
    	
    	$data['series'] = $series;

    	return $data; //{categories: ['A', 'B']}
    }

}
