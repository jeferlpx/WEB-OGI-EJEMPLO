<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->query('lang', session('locale', 'es'));

        if (!in_array($locale, ['es', 'en'])) {
            $locale = 'es';
        }

        session(['locale' => $locale]);
        app()->setLocale($locale);

        view()->share('currentLocale', $locale);

        return $next($request);
    }
}
