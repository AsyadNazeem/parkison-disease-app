@extends('doctor.doctor_layout')

@section('content')

    <h2>Welcome, Dr. {{ Auth::user()->name }}!</h2>
    <p>This is your dashboard. Use the sidebar to navigate through different sections of your account.</p>

@endsection
