<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalRecord; // Import your MedicalRecord model


class ParkinsonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('patient.predict');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate all input fields
            $validated = $request->validate([
                'MDVP_Fo_Hz' => 'required|numeric',
                'MDVP_Fhi_Hz' => 'required|numeric',
                'MDVP_Flo_Hz' => 'required|numeric',
                'MDVP_Jitter' => 'required|numeric',
                'MDVP_Jitter_Abs' => 'required|numeric',
                'MDVP_RAP' => 'required|numeric',
                'MDVP_PPQ' => 'required|numeric',
                'Jitter_DDP' => 'required|numeric',
                'MDVP_Shimmer' => 'required|numeric',
                'MDVP_Shimmer_dB' => 'required|numeric',
                'Shimmer_APQ3' => 'required|numeric',
                'Shimmer_APQ5' => 'required|numeric',
                'MDVP_APQ' => 'required|numeric',
                'Shimmer_DDA' => 'required|numeric',
                'NHR' => 'required|numeric',
                'HNR' => 'required|numeric',
                'RPDE' => 'required|numeric',
                'DFA' => 'required|numeric',
                'spread1' => 'required|numeric',
                'spread2' => 'required|numeric',
                'D2' => 'required|numeric',
                'PPE' => 'required|numeric',
            ]);

            // Convert validated input into JSON to pass to Python script
            $features = json_encode($validated);

            // Execute Python script and get prediction result
            $pythonScriptPath = base_path('python_scripts/model.py');
            $command = "python3 " . escapeshellcmd($pythonScriptPath) . " '" . $features . "'";
            $output = shell_exec($command . " 2>&1");

            // Trim output to get the final result
            $result = trim($output);

            if (empty($result)) {
                return back()->with('error', 'No prediction result received');
            }

            // Save the result and inputs to the database
            MedicalRecord::create([
                'user_id' => auth()->id(),
                'MDVP_Fo_Hz' => $validated['MDVP_Fo_Hz'],
                'MDVP_Fhi_Hz' => $validated['MDVP_Fhi_Hz'],
                'MDVP_Flo_Hz' => $validated['MDVP_Flo_Hz'],
                'MDVP_Jitter' => $validated['MDVP_Jitter'],
                'MDVP_Jitter_Abs' => $validated['MDVP_Jitter_Abs'],
                'MDVP_RAP' => $validated['MDVP_RAP'],
                'MDVP_PPQ' => $validated['MDVP_PPQ'],
                'Jitter_DDP' => $validated['Jitter_DDP'],
                'MDVP_Shimmer' => $validated['MDVP_Shimmer'],
                'MDVP_Shimmer_dB' => $validated['MDVP_Shimmer_dB'],
                'Shimmer_APQ3' => $validated['Shimmer_APQ3'],
                'Shimmer_APQ5' => $validated['Shimmer_APQ5'],
                'MDVP_APQ' => $validated['MDVP_APQ'],
                'Shimmer_DDA' => $validated['Shimmer_DDA'],
                'NHR' => $validated['NHR'],
                'HNR' => $validated['HNR'],
                'RPDE' => $validated['RPDE'],
                'DFA' => $validated['DFA'],
                'spread1' => $validated['spread1'],
                'spread2' => $validated['spread2'],
                'D2' => $validated['D2'],
                'PPE' => $validated['PPE'],
                'result' => $result, // Save the prediction result
            ]);

            return back()->with('result', $result);
        } catch (\Exception $e) {
            \Log::error('Error:', ['message' => $e->getMessage()]);
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
