<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('admin.login')->with('error', 'Debe iniciar sesión para acceder al panel.');
        }

        $user = auth()->user();

        if (!$user->is_active) {
            auth()->logout();
            return redirect()->route('admin.login')->with('error', 'Su cuenta ha sido desactivada. Comuníquese con la administración.');
        }

        // Superadmin has full access to everything
        if ($user->role === 'superadmin') {
            return $next($request);
        }

        if (empty($roles)) {
            return $next($request);
        }

        if (!in_array($user->role, $roles)) {
            abort(403, 'Acceso denegado: no cuenta con los permisos necesarios para realizar esta acción.');
        }

        return $next($request);
    }
}
