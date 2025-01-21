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
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->route('welcome'); // Change this line to redirect to welcome page
        }

        return redirect()->route('index.login')->with('error', 'Invalid credentials');
    }
}
