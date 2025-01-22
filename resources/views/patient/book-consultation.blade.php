@extends('patient.patient_layout')

@section('content')

    <div class="container mt-4">
        <h1>Book Consultation</h1>
        <h2>Consultation Details</h2>

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
                    <strong>Slots Remaining:</strong> {{ $consultation->max_bookings - $consultation->booked_count }}
                </p>
            </div>
        </div>

        <h2>Confirm Booking</h2>
        <form id="bookingForm" action="{{ route('confirm.consultation', $consultation->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Patient Information -->
            <div class="mb-3">
                <label for="patient_name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="patient_name" name="patient_name" placeholder="Enter your full name" required>
            </div>
            <div class="mb-3">
                <label for="contact_number" class="form-label">Contact Number</label>
                <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Enter your contact number" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" required>
            </div>

            <!-- Optional Details -->
            <div class="mb-3">
                <label for="patient_notes" class="form-label">Patient Notes (Optional)</label>
                <textarea class="form-control" id="patient_notes" name="patient_notes" rows="3" placeholder="Enter any specific details or concerns"></textarea>
            </div>
            <div class="mb-3">
                <label for="report" class="form-label">Upload Report (Optional)</label>
                <input type="file" class="form-control" id="report" name="report" accept=".pdf,.jpg,.png,.doc,.docx">
                <small class="form-text text-muted">Accepted formats: PDF, JPG, PNG, DOC, DOCX</small>
            </div>

            <!-- Trigger Payment Modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#paymentModal">Confirm Booking</button>
            <a href="{{ route('patient.consultation') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <!-- Payment Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Payment Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="card_number" class="form-label">Card Number</label>
                        <input type="text" class="form-control" id="card_number" placeholder="1234 5678 9012 3456" required>
                    </div>
                    <div class="mb-3">
                        <label for="expiry_date" class="form-label">Expiry Date</label>
                        <input type="text" class="form-control" id="expiry_date" placeholder="MM/YY" required>
                    </div>
                    <div class="mb-3">
                        <label for="cvv" class="form-label">CVV</label>
                        <input type="text" class="form-control" id="cvv" placeholder="123" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="payNowBtn">Pay Now</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('payNowBtn').addEventListener('click', function () {
            // Submit the booking form when payment is successful
            document.getElementById('bookingForm').submit();
        });
    </script>

@endsection
