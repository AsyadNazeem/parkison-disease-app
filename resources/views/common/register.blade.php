<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediCoSys - Register</title>
    <link rel="stylesheet" href="{{ asset('assets/css/common.css') }}">
    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Custom CSS -->

</head>
<body>
<div class="container-common">
    <!-- Website Name -->
    <div class="website-name">
        MediCo<span>Sys</span>
    </div>

    <!-- Register Form -->
    <h1>Register</h1>

    <form method="POST" action="{{ route('submit.register') }}" enctype="multipart/form-data">
        @csrf
        <!-- Name Field -->
        <div class="form-group mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>

        <!-- Email Field -->
        <div class="form-group mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>

        <!-- Password Field -->
        <div class="form-group mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>

        <!-- Confirm Password Field -->
        <div class="form-group mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password:</label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
        </div>

        <!-- Role Selection -->
        <div class="form-group mb-3">
            <label for="role" class="form-label">Register as:</label>
            <select class="form-control" name="role" id="role" required>
                <option value="patient">Patient</option>
                <option value="doctor">Doctor</option>
            </select>
        </div>

        <!-- Doctor-specific Fields (Hidden by Default) -->
        <div id="doctor_fields" class="form-group mb-3" style="display: none;">
            <label for="license_number" class="form-label">Doctor's ID (License Number):</label>
            <input type="file" class="form-control" name="license_number" id="license_number" accept=".jpg, .jpeg, .png, .pdf">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>

    <!-- Login Link -->
    <div class="mt-3 text-center">
        <p>Already have an account? <a href="{{ route('index.login') }}">Login here</a></p>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Show or hide the doctor's ID field based on the selected role
    document.querySelector('[name="role"]').addEventListener('change', function () {
        if (this.value == 'doctor') {
            document.getElementById('doctor_fields').style.display = 'block';
        } else {
            document.getElementById('doctor_fields').style.display = 'none';
        }
    });
</script>
</body>
</html>
