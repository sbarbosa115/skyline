<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsSuperadmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Verificar si el usuario autenticado es superadmin
        if (auth()->check() && auth()->user()->role === 'superadmin') {
            return $next($request); // Permitir acceso
        }

        // Si no es superadmin, devolver un error 403 (Acceso prohibido)
        return response()->json(['message' => 'Acceso denegado. Se requiere rol de superadmin.'], 403);
    }
}
