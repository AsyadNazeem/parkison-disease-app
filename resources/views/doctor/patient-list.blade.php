@extends('doctor.doctor_layout')

@section('content')

    <div class="container mt-4">
        <h1>Doctor Profile</h1>
        <h2>Welcome, {{ Auth::user()->name }}!</h2>
        <p>This is your dashboard. Below is the list of your patients organized by consultation dates and times.</p>

        @foreach($consultations as $consultation)
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h5>{{ $consultation->date }} - {{ $consultation->time_slot }}</h5>
                </div>
                <div class="card-body">
                    @if ($consultation->bookings->isEmpty())
                        <p>No patients have booked for this slot yet.</p>
                    @else
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Patient Name</th>
                                <th>Contact Number</th>
                                <th>Email</th>
                                <th>Notes</th>
                                <th>Report</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($consultation->bookings as $index => $booking)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $booking->patient_name }}</td>
                                    <td>{{ $booking->contact_number }}</td>
                                    <td>{{ $booking->email }}</td>
                                    <td>{{ $booking->patient_notes ?? 'N/A' }}</td>
                                    <td>
                                        @if ($booking->report_path)
                                            <a href="{{ asset('assets/' . $booking->report_path) }}" target="_blank">View Report</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

@endsection
