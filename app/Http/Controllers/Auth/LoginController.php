<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    // Cantidad de intentos permitidos antes de bloquear al usuario
    public $maxAttempts = 3;
    // Minutos de bloqueo
    public $decayMinutes = 2;

    public function authenticated(Requests $requests, $user)
    {
        $user->update([
            'ultimo_login' => Carbon::now()->toDateTimeString(),
            'ip' => $request->getClientIp()
        ]);
    }

    /** 
     * Where to redirect users after login.
     *
      @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
