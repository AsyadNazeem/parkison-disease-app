<?php

namespace App\Http\Controllers;

use App\Models\ConsultantRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Consultant extends Controller
{
    public function index()
    {
        $consultant = ConsultantRegister::where('user_id', Auth::id())->first();
        return view('doctor.consultant-form', compact('consultant'));
    }

    public function submit(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'specialization' => 'required|string',
            'qualification' => 'required|string',
            'experience_years' => 'required|numeric',
            'consultation_fee' => 'nullable|numeric',
            'availability' => 'nullable|string',
            'profile_picture' => 'nullable|image|max:2048',
        ]);

        // Create a new instance of ConsultantRegister
        $neurologist = new ConsultantRegister($validated);

        // Add the logged-in user's ID to the `user_id` column
        $neurologist->user_id = Auth::id(); // Get the currently authenticated user's ID

        // Handle the profile picture upload if provided
        if ($request->hasFile('profile_picture')) {
            // Define the destination path in the main public folder
            $destinationPath = public_path('assets/profile_pictures');

            // Ensure the directory exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // Generate a unique file name
            $fileName = uniqid() . '_' . $request->file('profile_picture')->getClientOriginalName();

            // Move the file to the destination path
            $request->file('profile_picture')->move($destinationPath, $fileName);

            // Save the relative path for database storage
            $neurologist->profile_picture = 'profile_pictures/' . $fileName;
        }

        // Save the data to the database
        $neurologist->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Neurologist registered successfully!');
    }

}

