@extends('patient.patient_layout')

@section('content')
    <h2>Welcome, {{ Auth::user()->name }}!</h2>
    <p>This is your dashboard. Use the sidebar to navigate through different sections of your account.</p>
    <p>Debug: Content section is being rendered.</p>
@endsection
