@extends('doctor.doctor_layout')

@section('content')

    <div class="container mt-4">
        <h1>Add Consultation Dates</h1>
        <form action="{{route('submit.consultation-dates')}}" method="POST">
            @csrf

            <div id="consultation-dates-container">
                <div class="consultation-date-item mb-4">
                    <h4>Consultation Slot</h4>
                    <div class="mb-3">
                        <label for="dates[]" class="form-label">Select Date(s)</label>
                        <input type="date" class="form-control" name="dates[]" required>
                    </div>
                    <div class="mb-3">
                        <label for="time_slots[]" class="form-label">Available Time Slot</label>
                        <input type="time" class="form-control" name="time_slots[]" required>
                    </div>
                    <div class="mb-3">
                        <label for="max_bookings[]" class="form-label">Maximum Bookings for the Day</label>
                        <input type="number" class="form-control" name="max_bookings[]" min="1" placeholder="Enter maximum bookings" required>
                    </div>
                    <div class="mb-3">
                        <label for="venue[]" class="form-label">Venue</label>
                        <input type="text" class="form-control" name="venue[]" placeholder="Enter venue" required>
                    </div>
                    <hr>
                </div>
            </div>

            <button type="button" id="add-slot-btn" class="btn btn-success mb-3">Add Another Slot</button>
            <button type="submit" class="btn btn-primary">Save Consultation Dates</button>
        </form>
    </div>

    <script>
        document.getElementById('add-slot-btn').addEventListener('click', function() {
            const container = document.getElementById('consultation-dates-container');
            const newSlot = document.querySelector('.consultation-date-item').cloneNode(true);
            container.appendChild(newSlot);
        });
    </script>

@endsection
