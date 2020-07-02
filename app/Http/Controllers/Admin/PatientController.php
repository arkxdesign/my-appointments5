<?php

// Este controlador lo crea Laravel ejecuntando este comando en la consola
// php artisan make:controller PatientController --resource
// y antes definimos nuestra ruta en web.php > Route::resource('patients', 'PatientController'); 

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;

use App\Http\Controllers\Controller;


class PatientController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = User::patients()->paginate(5);
        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'dni' => 'nullable|min:8',
            'address' => 'required|min:10',
            'phone' => 'required|min:10',
            'phone2' => 'nullable|min:10',
            'password' => 'required|min:4'
        ];
        $messages = [
            'name.required' => 'Es necesario ingresar el nombre del paciente',
            'name.min' => 'Como minimo el nombre debe de tener 3 caracteres',
            'email.required' => 'Es necesario ingresar un e-mail ejemplo: usuario@dominio.com',
            'dni.min' => 'Capturar DNI "Documento Nacional de Identidad o Cedula de Identificación Personal"  debe de tener minimo 8 caracteres',
            'address.required' => 'Captura el domicilio',
            'address.min' => 'Captura minimo 10 caracteres en el domicilio',
            'phone.required' => 'Es necesario ingresar numero del movil',
            'phone.min' => 'Captura minimo 10 digitos en el numero de celular',
            'phone2.min' => 'Captura minimo 10 digitos en el numero de teléfono',
            'password.required' => 'En la contraseña captura los ultimos 4 digitos del numero del movil',
            'password.min' => 'En la contraseña captura los ultimos 4 digitos del numero del movil',
        ];

        $this->validate($request, $rules, $messages);

        // mass assignament debemos agregarlos en user.php en fillable
        User::create(
            $request->only('name', 'email', 'dni', 'address', 'phone', 'phone2')
            + [
                'role' => 'patient',
                'password' => bcrypt($request->input('password'))
            ]
        );

        $notification = 'El paciente se ha registrado correctamente.';
        return redirect('/patients')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'dni' => 'nullable|min:8',
            'address' => 'required|min:10',
            'phone' => 'required|min:10',
            'phone2' => 'nullable|min:10',
            
        ];
        $messages = [
            'name.required' => 'Es necesario ingresar el nombre del pasiente',
            'name.min' => 'Como minimo el nombre debe de tener 3 caracteres',
            'email.required' => 'Es necesario ingresar un e-mail ejemplo: usuario@dominio.com',
            'dni.min' => 'Capturar DNI "Documento Nacional de Identidad o Cedula de Identificación Personal"  debe de tener minimo 8 caracteres',
            'address.required' => 'Captura el domicilio',
            'address.min' => 'Captura minimo 10 caracteres en el domicilio',
            'phone.required' => 'Es necesario ingresar numero del movil',
            'phone.min' => 'Captura minimo 10 digitos en el numero de celular',
            'phone2.min' => 'Captura minimo 10 digitos en el numero de teléfono',
           
        ];

        $this->validate($request, $rules, $messages);

        $user = User::patients()->findOrFail($id);
        // mass assignament debemos agregarlos en user.php en fillable
        $data = $request->only('name', 'email', 'dni', 'address', 'phone', 'phone2');
        $password = $request->input('password');
        if ($password)
            $data['password'] = bcrypt($password);

        $user->fill($data);
        $user->save(); //UPDATE A LA BASE DE DATOS

        $notification = 'La información del pasiente '.  $user->name .' se ha actualizado correctamente.';
        return redirect('/patients')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $patient)
    {
        $patientName = $patient->name;
        $patient->delete();

        $notification = "El paciente $patientName se ha eliminado correctamente.";
        return redirect('/patients')->with(compact('notification'));
    }
}
