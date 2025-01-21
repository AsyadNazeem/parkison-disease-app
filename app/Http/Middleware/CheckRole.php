<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('index.login');
        }

        $user = Auth::user();

        if (!in_array($user->role, $roles)) {
            if ($user->role === 'doctor') {
                return redirect()->route('doctor.dashboard')
                    ->with('error', 'Unauthorized access. Redirected to doctor dashboard.');
            }

            if ($user->role === 'patient') {
                return redirect()->route('patient.dashboard')
                    ->with('error', 'Unauthorized access. Redirected to patient dashboard.');
            }

            return redirect()->route('index.login')
                ->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}
