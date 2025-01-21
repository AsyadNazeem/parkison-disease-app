<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('index.login');
        }
    }

    public function handle($request, Closure $next, ...$guards)
    {
        if ($this->authenticate($request, $guards) === 'authentication_failed') {
            return redirect()->route('index.login');
        }

        // Role-based access control
        if ($request->route()->named('doctor.dashboard') && Auth::user()->role !== 'doctor') {
            return redirect()->route('welcome')->with('error', 'Unauthorized access');
        }

        if ($request->route()->named('welcome') && Auth::user()->role !== 'patient') {
            return redirect()->route('index.login')->with('error', 'Unauthorized access');
        }

        $response = $next($request);

        if (method_exists($response, 'header')) {
            $response->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
        }

        return $response;
    }
}
