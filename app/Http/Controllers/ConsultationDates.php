<?php

namespace App\Http\Controllers;
use App\Models\ConsultationDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultationDates extends Controller
{
    function index()
    {
        return view('doctor.consultation_dates');
    }

    function submit(Request $request)
    {
        $validated = $request->validate([
            'dates.*' => 'required|date',
            'time_slots.*' => 'required',
            'max_bookings.*' => 'required|numeric|min:1',
            'venue.*' => 'required|string|max:255',
        ]);

        // Loop through each submitted slot and store it in the database
        for ($i = 0; $i < count($request->dates); $i++) {
            ConsultationDate::create([
                'user_id' => Auth::id(), // Assuming you use Auth for logged-in doctor
                'date' => $request->dates[$i],
                'time_slot' => $request->time_slots[$i],
                'max_bookings' => $request->max_bookings[$i],
                'venue' => $request->venue[$i],
            ]);
        }

        return redirect()->back()->with('success', 'Consultation dates added successfully!');
    }
}
