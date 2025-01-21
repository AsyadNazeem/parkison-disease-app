<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    function index()
    {
        return view('common.register');
    }

    function submit(RegisterRequest $request)
    {


        $user = new User();

        if($request -> hasFile('license_number')){
            $image = $request -> file('license_number');
            $fileName = $image -> store('','public');
            $filePath = '/assets/' . $fileName;
            $user -> license_number = $filePath;
        }

        $user -> name = $request -> name;
        $user -> email = $request -> email;
        $user -> password = $request -> password;
        $user -> role = $request -> role;
        $user -> status = ($request -> role == 'doctor') ? 'pending' : 'approved';
        $user -> save();


//        // Create the user with the appropriate role
//        $user = User::create([
//            'name' => $request->name,
//            'email' => $request->email,
//            'password' => Hash::make($request->password),
//            'role' => $request->role,
//            'license_number' => $licensePath, // Store the file path
//            'status' => ($request->role == 'doctor') ? 'pending' : 'approved', // Pending approval for doctors
//        ]);

        // Redirect to login page with success message
        return redirect()->route('index.login')->with('success', 'Registration successful!');
    }
}
