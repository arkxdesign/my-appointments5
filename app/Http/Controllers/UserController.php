<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
	public function edit()
	{
		$user = auth()->user();
		return view('profile', compact('user'));

	}
    
    public function update(Request $request)
    {
		$rules = [
    		'phone' => 'required|min:10|numeric'
	  	];

	  	$messages = [
	  		'phone.required' => 'Captura un numero de celular',
            'phone.min' => 'Captura minimo 10 digitos en el numero de celular',
	    	'phone.numeric' => 'Captura 10 digitos numericos, sin espacios o caracteres'
        ];

        $this->validate($request, $rules, $messages);

    	$user = auth()->user();
    	$user->name = $request->name;
    	$user->phone = $request->phone;
    	$user->address = $request->address;
    	$user->save();

    	$notification = 'Los datos se han actualizado.';
    	return back()->with(compact('notification'));
    }
}
