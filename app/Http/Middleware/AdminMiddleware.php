<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica: 1. Logueado | 2. Es Admin | 3. Cuenta Activa
        if (Auth::check() && Auth::user()->role === 'admin' && Auth::user()->is_active) {
            return $next($request);
        }

        // Si falla, error 403 (Prohibido)
        abort(403, 'ACCESO DENEGADO: Permisos insuficientes o cuenta suspendida.');
    }
}
