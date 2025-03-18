<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('unauthorized');
        }

        // Verificar si el usuario tiene al menos uno de los roles especificados
        if (!Auth::user()->hasAnyRole($roles)) {
            return redirect()->route('unauthorized');
        }

        return $next($request);
    }
}
