@extends('patient.patient_layout')

@section('content')

    <h1>Book Doctor</h1>
    <h2>Welcome, {{ Auth::user()->name }}!</h2>
    <p>This is your dashboard. Use the sidebar to navigate through different sections of your account.</p>

@endsection
