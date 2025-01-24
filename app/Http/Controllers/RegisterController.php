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

        if ($request->hasFile('license_number')) {
            $image = $request->file('license_number');

            // Define the destination path inside the main public folder
            $destinationPath = public_path('assets/doctors_id');

            // Generate a unique file name
            $fileName = uniqid() . '_' . $image->getClientOriginalName();

            // Move the file to the main public folder
            $image->move($destinationPath, $fileName);

            // Save the file path relative to the public folder
            $user->license_number = 'assets/doctors_id/' . $fileName;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Encrypt the password before saving
        $user->role = $request->role;
        $user->status = ($request->role == 'doctor') ? 'pending' : 'approved';
        $user->save();

        // Redirect to login page with success message
        return redirect()->route('index.login')->with('success', 'Registration successful!');
    }


}
