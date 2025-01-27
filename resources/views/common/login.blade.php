<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediCoSys - Login</title>
    <!-- In both login.html and register.html -->
    <link rel="stylesheet" href="{{ asset('assets/css/common.css') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">

</head>
<body>
<div class="container-common">
    <!-- Website Name -->
    <div class="website-name">
        MediCo<span>Sys</span>
    </div>

    <!-- Login Form -->
    <h2>Login</h2>

    <!-- Error Message -->
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('submit.login') }}" method="POST">
        @csrf
        <!-- Role Selection -->
        <div class="form-group mb-3">
            <label for="role" class="form-label">Role:</label>
            <select class="form-control" name="role" id="role" required>
                <option value="patient">Patient</option>
                <option value="doctor">Doctor</option>
            </select>
        </div>

        <!-- Email Input -->
        <div class="form-group mb-3">
            <label for="email" class="form-label">Email address:</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
        </div>

        <!-- Password Input -->
        <div class="form-group mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
        </div>

        <!-- Remember Me Checkbox -->
        <div class="form-group form-check mb-3">
            <input type="checkbox" class="form-check-input" name="remember" id="remember">
            <label class="form-check-label" for="remember">Remember me</label>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>

    <!-- Register Link -->
    <div class="mt-3 text-center">
        <p>Don't have an account? <a href="{{ route('index.register') }}">Register here</a></p>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
