<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MedicalHistory extends Controller
{
    function index()
    {
        return view('patient/medical_record');
    }
}
