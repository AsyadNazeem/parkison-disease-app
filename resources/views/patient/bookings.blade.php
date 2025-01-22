@extends('patient.patient_layout')

@section('content')

    <div class="container mt-4">
        <h1>My Bookings</h1>

        <!-- Future Bookings Section -->
        <h2>Future Bookings</h2>
        @if($futureBookings->isEmpty())
            <p>You don't have any future bookings.</p>
        @else
            <div class="row">
                @foreach($futureBookings as $booking)
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">{{ $booking->consultation->consultant->name }}</h5>
                                <p class="card-text">
                                    <strong>Specialization:</strong> {{ $booking->consultation->consultant->specialization }}<br>
                                    <strong>Date:</strong> {{ $booking->consultation->date }}<br>
                                    <strong>Time:</strong> {{ $booking->consultation->time_slot }}<br>
                                    <strong>Venue:</strong> {{ $booking->consultation->venue }}<br>
                                    <strong>Fee:</strong> ${{ $booking->consultation->consultant->consultation_fee }}<br>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Past Bookings Section -->
        <h2>Past Bookings</h2>
        @if($pastBookings->isEmpty())
            <p>You don't have any past bookings.</p>
        @else
            <div class="row">
                @foreach($pastBookings as $booking)
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">{{ $booking->consultation->consultant->name }}</h5>
                                <p class="card-text">
                                    <strong>Specialization:</strong> {{ $booking->consultation->consultant->specialization }}<br>
                                    <strong>Date:</strong> {{ $booking->consultation->date }}<br>
                                    <strong>Time:</strong> {{ $booking->consultation->time_slot }}<br>
                                    <strong>Venue:</strong> {{ $booking->consultation->venue }}<br>
                                    <strong>Fee:</strong> ${{ $booking->consultation->consultant->consultation_fee }}<br>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

@endsection
