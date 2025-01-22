<?php

namespace App\Http\Controllers;

use App\Models\ConsultantBooking;
use App\Models\ConsultationDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookDoctorContoller extends Controller
{
    // Show available consultations
    function index()
    {
        $consultations = ConsultationDate::with('consultant')
            ->whereRaw('max_bookings > booked_count')
            ->get();

        return view('patient.book-doctor', compact('consultations'));
    }

    // Show consultation booking details
    function book($id)
    {
        $consultation = ConsultationDate::with('consultant')->findOrFail($id);

        // Check if slots are available
        if ($consultation->max_bookings <= $consultation->booked_count) {
            return redirect()->route('book.doctor')->with('error', 'This consultation is fully booked.');
        }

        return view('patient.book-consultation', compact('consultation'));
    }

    // Confirm the booking and process payment
    public function confirm(Request $request, $id)
    {
        $consultation = ConsultationDate::findOrFail($id);

        // Validate booking data
        $validated = $request->validate([
            'patient_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'patient_notes' => 'nullable|string|max:1000',
            'report' => 'nullable|file|mimes:pdf,jpg,png,doc,docx|max:2048',
        ]);

        // Check availability
        if ($consultation->max_bookings <= $consultation->booked_count) {
            return redirect()->route('book.doctor')->with('error', 'This consultation is no longer available.');
        }

        // Handle report upload
        $reportPath = null;
        if ($request->hasFile('report')) {
            $reportPath = $request->file('report')->store('reports', 'public');
        }

        // Create the booking entry
        ConsultantBooking::create([
            'user_id' => Auth::id(),
            'doctor_id' => $consultation->consultant->user_id,
            'consultation_id' => $consultation->id,
            'patient_name' => $validated['patient_name'],
            'contact_number' => $validated['contact_number'],
            'email' => $validated['email'],
            'notes' => $validated['patient_notes'] ?? null,
            'report_path' => $reportPath,
        ]);

        // Update the booked count for the consultation
        $consultation->booked_count += 1;
        $consultation->save();

        return redirect()->route('patient.consultation')->with('success', 'Booking confirmed and payment processed successfully!');
    }

    public function viewBookings()
    {
        // Get the logged-in user
        $user = Auth::user();

        // Get future bookings (future bookings will have dates in the future)
        $futureBookings = ConsultantBooking::where('user_id', $user->id)
            ->whereHas('consultation', function($query) {
                $query->where('date', '>', now()); // Future dates
            })
            ->with('consultation.consultant')
            ->get();

        // Get past bookings (past bookings will have dates in the past)
        $pastBookings = ConsultantBooking::where('user_id', $user->id)
            ->whereHas('consultation', function($query) {
                $query->where('date', '<', now()); // Past dates
            })
            ->with('consultation.consultant')
            ->get();

        // Pass future and past bookings to the view
        return view('patient.bookings', compact('futureBookings', 'pastBookings'));
    }

}
