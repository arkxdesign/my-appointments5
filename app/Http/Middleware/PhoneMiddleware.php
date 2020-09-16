<?php

namespace App\Http\Middleware;

use Closure;

class PhoneMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->phone)
            return $next($request);

        $error = 'Es necesario asociar un numero de teléfono en su perfil, antes de registrar una cita';
        return redirect('/profile')->with(compact('error'));
    }
}
