<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Appointment;
use DB;
use Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    private function daysToMinutes($days)
    {
        $hours = $days * 24;
        return $hours * 60;
    }

    public function index()
    {
        
        $role = auth()->user()->role;

        //Admin ->all
        if ($role == 'admin') {
        $minutes = $this->daysToMinutes(1);
        
        $appointmentsByDay =  Cache::remember('appointments_by_day', $minutes, function () {
        $results =  Appointment::select([
                DB::raw('DAYOFWEEK(scheduled_date) as day'),
                DB::raw('COUNT(*) as count')
            ])
            ->groupBy(DB::raw('DAYOFWEEK(scheduled_date)'))
            ->where('status', 'Confirmada', 'Atendida')
            ->get(['day', 'count'])
            ->mapWithKeys(function ($item) {
                return [$item['day'] => $item['count']];
            })->toArray();
                    
       $counts = [];
       for ($i=1; $i<=7; ++$i) {
            if (array_key_exists($i, $results))
                $counts[] = $results[$i];
            else
                $counts[] = 0;
            }
            return $counts;
        });

     

        //Doctor
        }elseif ($role == 'doctor') {
        //$minutes = $this->daysToMinutes(1);
        $minutes = 0;
        
        $appointmentsByDay =  Cache::remember('appointments_by_day', $minutes, function () {
        $results =  Appointment::select([
                DB::raw('DAYOFWEEK(scheduled_date) as day'),
                DB::raw('COUNT(*) as count')
            ])
            ->where('doctor_id', auth()->id())
            ->groupBy(DB::raw('DAYOFWEEK(scheduled_date)'))
            ->where('status', 'Confirmada', 'Atendida')
            ->get(['day', 'count'])
            ->mapWithKeys(function ($item) {
                return [$item['day'] => $item['count']];
            })->toArray();
                    
       $counts = [];
       for ($i=1; $i<=7; ++$i) {
            if (array_key_exists($i, $results))
                $counts[] = $results[$i];
            else
                $counts[] = 0;
            }
            return $counts;
        });

        

        //Patient
        }elseif ($role == 'patient') {
//      $minutes = $this->daysToMinutes(1);
        $minutes = 0;
        
        $appointmentsByDay =  Cache::remember('appointments_by_day', $minutes, function () {
        $results =  Appointment::select([
                DB::raw('DAYOFWEEK(scheduled_date) as day'),
                DB::raw('COUNT(*) as count')
            ])
            ->where('patient_id', auth()->id())
            ->groupBy(DB::raw('DAYOFWEEK(scheduled_date)'))
            ->where('status', 'Confirmada', 'Atendida')
            ->get(['day', 'count'])
            ->mapWithKeys(function ($item) {
                return [$item['day'] => $item['count']];
            })->toArray();
                    
       $counts = [];
       for ($i=1; $i<=7; ++$i) {
            if (array_key_exists($i, $results))
                $counts[] = $results[$i];
            else
                $counts[] = 0;
            }
            return $counts;
        });

        
        }

            return view('home', compact('appointmentsByDay', 'role'));
        }
    }