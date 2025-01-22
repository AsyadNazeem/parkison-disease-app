<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    function index()
    {
        return view('common.login');
    }

    public function submit(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->remember)) {
            $user = Auth::user();

            // Redirect based on role
            if ($user->role === 'patient') {
                return redirect()->route('welcome');
            } elseif ($user->role === 'doctor') {
                return redirect()->route('doctor.dashboard');
            }
        }

        return back()->with('error', 'Invalid credentials.');
    }
}
