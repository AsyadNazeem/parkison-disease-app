<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function index()
    {
        return view('common.login');
    }

    public function submit(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:patient,doctor'
        ]);

        $remember = $request->has('remember'); // Get remember me value

        // Remove 'role' from Auth::attempt() because Laravel only verifies email & password
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']], $remember)) {
            $request->session()->regenerate();

            // Manually check role after authentication
            if (Auth::user()->role === 'doctor') {
                return redirect()->intended('/doctor/dashboard');

            } else {
                return redirect()->intended('/patient/patient-dashboard');
            }
        }

        return back()->with('error', 'Invalid credentials');
    }
}
