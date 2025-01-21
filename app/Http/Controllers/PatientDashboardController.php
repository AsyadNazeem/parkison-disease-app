<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class PatientDashboardController extends Controller
{
    public function index()
    {
        // auth middleware handles authentication checks
        return view('patient.patient-dashboard');
    }
}

