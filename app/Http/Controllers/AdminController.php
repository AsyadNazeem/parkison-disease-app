<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function indexDoctors()
    {
        // Fetch all doctors
        $doctors = User::where('role', 'doctor')->get();

        return view('admin.doctors', compact('doctors'));
    }

    public function toggleDoctorStatus($id)
    {
        // Find the doctor by ID
        $doctor = User::findOrFail($id);

        // Toggle the status
        $doctor->status = $doctor->status === 'approved' ? 'pending' : 'approved';
        $doctor->save();

        return redirect()->route('index.doctors')->with('success', 'Doctor status updated successfully.');
    }

    public function indexPatients()
    {
        // Fetch all patients
        $patients = User::where('role', 'patient')->get();

        return view('admin.patients', compact('patients'));
    }

    public function viewPatient($id)
    {
        // Find the patient by ID
        $patient = User::findOrFail($id);

        // Fetch additional details (e.g., medical history, consultations, etc.)
        $medicalHistory = $patient->medicalHistory; // Example: Eager load related records if defined

        return view('admin.view_patient', compact('patient', 'medicalHistory'));
    }

    function indexAdmin()
    {
        return view('admin.register');
    }

    public function registerAdmin(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,super_admin',
            'status' => 'required|in:active,inactive',
        ]);

        // Create a new admin record
        Admin::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'status' => $validated['status'] ?? 'inactive',
            'role' => $validated['role'] ?? 'admin', // Ensure role is provided or set a default
        ]);


        // Redirect with a success message
        return redirect()->back()->with('success', 'Admin registered successfully!');
    }

    function adminListIndex()
    {
        $admins = Admin::all(); // Fetch all admins
        return view('admin.admins', compact('admins'));
    }

    public function updateStatus($id)
    {
        $admin = Admin::findOrFail($id);

        // Toggle status between active and inactive
        $admin->status = $admin->status === 'active' ? 'inactive' : 'active';
        $admin->save();

        return redirect()->route('admin.list')->with('success', 'Admin status updated successfully!');
    }
}
