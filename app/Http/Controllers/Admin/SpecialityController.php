<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Speciality;

use App\Http\Controllers\Controller;

class SpecialityController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {
    	$specialities = Speciality::all();
    	//var_dump($specialities);
    	//dd($specialities->all());
		return view('specialties.index', compact('specialities'));  // compact('variable1', 'variable2') <---nombre de las variables que queramos mostrar en la vista  	
    }

	public function create()
    {
		return view('specialties.create');    	
    }

    public function store(Request $request)
    {
    	// Reglas de validación, deben de ir antes de grabar en la base de datos
    	$rules = [
    		'name' => 'required|min:2',
    		'description' => 'required|min:2',
    		'price' => 'required|numeric',
    	];
    	$messages = [
    		'name.required' => 'Es necesario ingresar un nombre en la especialidad',
    		'name.min' => 'Como minimo el nombre debe de tener 2 caracteres',
    		'description.required' => 'Es necesario ingresar una descripción',
    		'description.min' => 'Como minimo la descripción debe de tener 2 caracteres',
    		'price.required' => 'Es necesario ingresar un precio',
    		'price.numeric' => 'Como minimo el precio debe de tener 1 numero',
    	];
    	$this->validate($request, $rules, $messages);
    	// Estas 2 lineas son var_dump, la segunda es el equivalente en Laravel
    	// var_dump($request);
    	// dd($request->all());
    	$speciality = new Speciality();
    	$speciality->name = $request->input('name');
    	$speciality->description = $request->input('description');
    	$speciality->price = $request->input('price');
    	$speciality->save(); //Insert en la base de datos

        $notification = 'La especialidad se ha registrado correctamente.'; 

    	// return back();  //Regresar a la ventana anterior
        return redirect('/specialties')->with(compact('notification'));
    }

    public function edit(Speciality $speciality)
    {
    	return view('specialties.edit', compact('speciality'));
    }

    public function update(Request $request, Speciality $speciality)
    {
    	// Reglas de validación, deben de ir antes de grabar en la base de datos
    	$rules = [
    		'name' => 'required|min:2',
    		'description' => 'required|min:2',
    		'price' => 'required|numeric',
    	];
    	$messages = [
    		'name.required' => 'Es necesario ingresar un nombre en la especialidad',
    		'name.min' => 'Como minimo el nombre debe de tener 2 caracteres',
    		'description.required' => 'Es necesario ingresar una descripción',
    		'description.min' => 'Como minimo la descripción debe de tener 2 caracteres',
    		'price.required' => 'Es necesario ingresar un precio',
    		'price.numeric' => 'Como minimo el precio debe de tener 1 numero',
    	];
    	$this->validate($request, $rules, $messages);
     	//Sacar datos
    	$speciality->name = $request->input('name');
    	$speciality->description = $request->input('description');
    	$speciality->price = $request->input('price');
    	$speciality->save(); //Actualizar en la base de datos

        $notification = 'La especialidad se ha actualizado correctamente.';
    	return redirect('/specialties')->with(compact('notification'));  //Regresar a la ventana anterior
    }

    public function destroy(Speciality $speciality)
    {
        $deletedSpeciality = $speciality->name; // creamos una variable para guardar el nombre del fichero eliminado
        $speciality->delete();
        $notification = 'La especialidad '.  $deletedSpeciality .' se ha eliminado correctamente.';
        return redirect('/specialties')->with(compact('notification'));
    }

}
