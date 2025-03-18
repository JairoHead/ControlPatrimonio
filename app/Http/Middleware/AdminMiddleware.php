<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Depuración: Verifica el usuario autenticado
        if (Auth::check()) {
            dd(Auth::check() ? json_decode(json_encode(Auth::user()), true) : 'No hay usuario autenticado');
        } else {
            logger('No hay usuario autenticado');
        }

        // Verificar si el usuario es administrador
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        return redirect('/dashboard')->with('error', 'Unauthorized access.');
    }
}
