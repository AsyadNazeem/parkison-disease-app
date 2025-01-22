@extends('patient.patient_layout')

@section('content')

    <div class="container mt-4">
        <h1>Book Doctor</h1>
        <h2>Welcome, {{ Auth::user()->name }}!</h2>

        <div class="row">
            @forelse($consultations as $consultation)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $consultation->consultant->name }}</h5>
                            <p class="card-text">
                                <strong>Specialization:</strong> {{ $consultation->consultant->specialization }}<br>
                                <strong>Qualification:</strong> {{ $consultation->consultant->qualification }}<br>
                                <strong>Experience:</strong> {{ $consultation->consultant->experience_years }} years<br>
                                <strong>Date:</strong> {{ $consultation->date }}<br>
                                <strong>Time:</strong> {{ $consultation->time_slot }}<br>
                                <strong>Venue:</strong> {{ $consultation->venue }}<br>
                                <strong>Fee:</strong> ${{ $consultation->consultant->consultation_fee }}<br>
                                <strong>Slots Available:</strong> {{ $consultation->max_bookings - $consultation->booked_count }}
                            </p>
                            <a href="{{route('book.consultation', $consultation->id)}}" class="btn btn-primary">Book Now</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">No consultations available at the moment.</p>
            @endforelse
        </div>
    </div>

@endsection
