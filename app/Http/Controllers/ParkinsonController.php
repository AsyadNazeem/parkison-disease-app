<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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



            $features = json_encode($validated);

            // Debug: Print full path to Python script
            $pythonScriptPath = base_path('python_scripts/model.py');
            \Log::info('Python script path:', ['path' => $pythonScriptPath]);

            // Debug: Check if file exists
            if (!file_exists($pythonScriptPath)) {
                return back()->with('error', 'Python script not found at: ' . $pythonScriptPath);
            }

            // Debug: Print full command
            $command = "python3 " . escapeshellcmd($pythonScriptPath) . " '" . $features . "'";
            \Log::info('Full command:', ['command' => $command]);

            // Execute with error output
            $output = shell_exec($command . " 2>&1");
            \Log::info('Command output:', ['output' => $output]);

            if (empty($output)) {
                return back()->with('error', 'No prediction result received');
            }

            return back()->with('result', trim($output));
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
