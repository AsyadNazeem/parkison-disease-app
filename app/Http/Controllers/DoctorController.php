<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\ConsultationDate;

class DoctorController extends Controller
{
    public function index()
    {
        $consultations = ConsultationDate::with(['bookings' => function ($query) {
            $query->orderBy('created_at', 'asc');
        }])
            ->where('user_id', Auth::id()) // Only show consultations of the logged-in doctor
            ->orderBy('date', 'asc')
            ->orderBy('time_slot', 'asc')
            ->get();

        return view('doctor/patient-list', compact('consultations'));

    }
}

