<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf; // Note: Facade, not PDF class

class Report extends Controller
{
    public function index()
    {
        $medical_records = MedicalRecord::where('user_id', Auth::id())->get();
        return view('patient.report', compact('medical_records'));
    }

    // In app/Http/Controllers/MedicalRecordController.php
    public function downloadPDF($id)
    {
        $record = MedicalRecord::findOrFail($id);

        // Ensure the user can only download their own records
        if ($record->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }

        $pdf = PDF::loadView('patient.pdfs.medical_record', compact('record'));
        return $pdf->download("medical_report_{$record->id}.pdf");
    }
}
