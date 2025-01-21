<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parkinson Disease Detection</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
</head>
<body>
<div class="container">
    <h1>Register</h1>

    <form method="POST" action="{{ route('submit.register') }}" enctype="multipart/form-data">
        @csrf
        <!-- Common Fields for Both Patient and Doctor -->
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" name="password_confirmation" required><br>

        <!-- Role Selection (Doctor or Patient) -->
        <label for="role">Register as:</label>
        <select name="role" required>
            <option value="patient">Patient</option>
            <option value="doctor">Doctor</option>
        </select><br>

        <!-- Doctor-specific Fields (Only shown if doctor is selected) -->
        <div id="doctor_fields" style="display: none;">
            <label for="license_number">Doctor's ID (License Number):</label>
            <input type="file" name="license_number" accept=".jpg, .jpeg, .png, .pdf"><br>
        </div>

        <button type="submit">Register</button>
    </form>
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
