@extends('doctor.doctor_layout')

@section('content')

    <div class="container mt-4">
        @if($consultant)
            <!-- Show Registered Consultant Details -->
            <h2>Registered Neurologist Consultant</h2>
            <div class="table-responsive"> <!-- Added for responsiveness -->
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Specialization</th>
                        <th>Qualification</th>
                        <th>Experience (Years)</th>
                        <th>Consultation Fee ($)</th>
                        <th>Availability</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $consultant->name }}</td>
                        <td>{{ $consultant->email }}</td>
                        <td>{{ $consultant->phone }}</td>
                        <td>{{ $consultant->specialization }}</td>
                        <td>{{ $consultant->qualification }}</td>
                        <td>{{ $consultant->experience_years }}</td>
                        <td>{{ $consultant->consultation_fee }}</td>
                        <td>{{ $consultant->availability }}</td>
                        <td>
                            <a href="#" class="btn btn-warning">Edit</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        @else
            <!-- Show Registration Form -->
            <h2>Register Neurologist Consultant</h2>
            <form action="{{route('submit.consultant-form')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Basic Information -->
                <h4>Basic Information</h4>
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter full name"
                           required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number"
                           required>
                </div>

                <!-- Professional Details -->
                <h4>Professional Details</h4>
                <div class="mb-3">
                    <label for="specialization" class="form-label">Specialization</label>
                    <input type="text" class="form-control" id="specialization" name="specialization"
                           placeholder="e.g., Parkinson's, Epilepsy" required>
                </div>
                <div class="mb-3">
                    <label for="qualification" class="form-label">Qualification</label>
                    <input type="text" class="form-control" id="qualification" name="qualification"
                           placeholder="e.g., MD, DM in Neurology" required>
                </div>
                <div class="mb-3">
                    <label for="experience_years" class="form-label">Years of Experience</label>
                    <input type="number" class="form-control" id="experience_years" name="experience_years"
                           placeholder="Enter years of experience" required>
                </div>

                <!-- Optional Fields -->
                <h4>Optional Information</h4>
                <div class="mb-3">
                    <label for="hospital_affiliation" class="form-label">Hospital Affiliation</label>
                    <input type="text" class="form-control" id="hospital_affiliation" name="hospital_affiliation"
                           placeholder="Enter hospital/clinic name">
                </div>
                <div class="mb-3">
                    <label for="consultation_fee" class="form-label">Consultation Fee (in $)</label>
                    <input type="number" class="form-control" id="consultation_fee" name="consultation_fee"
                           placeholder="Enter consultation fee">
                </div>
                <div class="mb-3">
                    <label for="availability" class="form-label">Availability</label>
                    <input type="text" class="form-control" id="availability" name="availability"
                           placeholder="e.g., Mon-Fri, 9 AM - 5 PM">
                </div>
                <div class="mb-3">
                    <label for="profile_picture" class="form-label">Profile Picture</label>
                    <input type="file" class="form-control" id="profile_picture" name="profile_picture"
                           accept="image/*">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Register Consultant</button>
            </form>
        @endif
    </div>

@endsection
