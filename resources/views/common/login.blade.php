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
    <h2 class="mt-5">Login</h2>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ url('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password"
                   required>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" name="remember" id="remember">
            <label class="form-check-label" for="remember">Remember me</label>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    {{--        <div class="mt-3">--}}
    {{--            <a href="{{ route('password.request') }}">Forgot Password?</a>--}}
    {{--        </div>--}}
    <div>
        <p>Don't have an account? <a href="{{ route('index.register') }}">Register here</a></p>
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
