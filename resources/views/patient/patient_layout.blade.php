<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parkinson Disease Detection</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/patient.css') }}">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
</head>
<body>

<div class="dashboard-container">
    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand ms-3" href="#">Patient Dashboard</a>
        <div class="ms-auto me-3">
            <!-- Dropdown for Account and Logout -->
            <div class="dropdown">
                <a href="#" class="dropdown-toggle text-dark" id="accountDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle" style="font-size: 1.5rem;"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
                    <li>
                        <a class="dropdown-item" href="{{route('patient.profile')}}">
                            <i class="bi bi-person"></i> Profile
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item" href="#" id="logout-button">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Main Container -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Navigation -->
            <div class="col-md-2 bg-dark text-white vh-100 pt-4">
                <ul class="nav flex-column">
                    <li class="nav-item mb-3">
                        <a class="nav-link text-white" href="{{route('patient.dashboard')}}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a class="nav-link text-white" href="{{route('patient.report')}}">
                            <i class="bi bi-file-earmark-text"></i> Reports
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a class="nav-link text-white" href="{{route('patient.book-doctor')}}">
                            <i class="bi bi-calendar-plus"></i> Book a Doctor
                        </a>
                    </li>
{{--                    <li class="nav-item mb-3">--}}
{{--                        <a class="nav-link text-white" href="#">--}}
{{--                            <i class="bi bi-person-badge"></i> Profile--}}
{{--                        </a>--}}
{{--                    </li>--}}
                    <li class="nav-item mb-3">
                        <a class="nav-link text-white" href="/welcome">
                            <i class="bi bi-back"></i> Back
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-10 p-4">
                @yield('content')
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    // Logout confirmation popup
    document.getElementById('logout-button').addEventListener('click', function (e) {
        e.preventDefault(); // Prevent default action of the link
        Swal.fire({
            title: 'Are you sure?',
            text: "You will be logged out of the system!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, logout!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the logout form via JavaScript
                const logoutForm = document.createElement('form');
                logoutForm.method = 'POST';
                logoutForm.action = "{{ route('logout') }}";
                logoutForm.style.display = 'none';
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = "{{ csrf_token() }}";
                logoutForm.appendChild(csrfInput);
                document.body.appendChild(logoutForm);
                logoutForm.submit();
            }
        });
    });

    window.onpageshow = function (event) {
        if (event.persisted) {
            window.location.reload();
        }
    };

    if (window.performance && window.performance.navigation.type === window.performance.navigation.TYPE_BACK_FORWARD) {
        window.location.reload(true);
    }
</script>
</body>
</html>

