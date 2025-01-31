<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parkinson Disease Detection</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/doctor.css') }}">
    {{--    <link rel="stylesheet" href="{{ asset('assets/css/common.css') }}">--}}
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css"
          rel="stylesheet">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css"
          rel="stylesheet">

    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
</head>
<body>

@if(Auth::user()->status === 'pending')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let pendingAlert;

            function showPendingAlert() {
                Swal.fire({
                    title: 'Account Pending Approval',
                    text: 'Your account is currently pending administrator approval. Some features may be limited until your account is approved.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Logout',
                    cancelButtonColor: '#d33',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false,
                    didClose: () => {
                        // Show the alert again after a brief timeout
                        setTimeout(showPendingAlert, 100);
                    }
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.cancel) {
                        // Submit the logout form
                        const logoutForm = document.createElement('form');
                        logoutForm.method = 'POST';
                        logoutForm.action = "{{ route('logout') }}";

                        // Add CSRF token
                        const csrfToken = document.createElement('input');
                        csrfToken.type = 'hidden';
                        csrfToken.name = '_token';
                        csrfToken.value = "{{ csrf_token() }}";
                        logoutForm.appendChild(csrfToken);

                        document.body.appendChild(logoutForm);
                        logoutForm.submit();
                    }
                });
            }

            showPendingAlert();
        });
    </script>

    <style>
        /* Prevent interaction with the dashboard while popup is shown */
        .swal2-shown > body {
            overflow: hidden;
        }

        .swal2-shown .dashboard-container {
            filter: blur(3px);
            pointer-events: none;
        }
    </style>
@endif


<div class="dashboard-container">
    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand ms-3" href="">Doctor Dashboard</a>
        <div class="ms-auto me-3">
            <!-- Dropdown for Account and Logout -->
            <div class="dropdown">
                <a href="#" class="dropdown-toggle text-dark" id="accountDropdown" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    <i class="bi bi-person-circle" style="font-size: 1.5rem;"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
                    <li>
                        <a class="dropdown-item" href="{{route('doctor.profile')}}">
                            <i class="bi bi-person"></i> Profile
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item" href="#" id="settings-trigger">
                            <i class="bi bi-gear"></i> Settings
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
    <div class="container-fluid h-100">
        <div class="row h-100">
            <!-- Side Navigation Bar -->
            <div class="col-md-2 bg-dark text-white collapse d-lg-block sidebarCollapse" id="sidebarCollapse">
                <ul class="nav flex-column pt-4">
                    <li class="nav-item mb-3">
                        <a class="nav-link text-white {{ Request::routeIs('doctor.dashboard') ? 'active' : '' }}"
                           href="{{route('doctor.dashboard')}}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a class="nav-link text-white {{ Request::routeIs('index.patient') ? 'active' : '' }}"
                           href="{{route('index.patient')}}">
                            <i class="bi bi-bag-plus"></i> Patients
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a class="nav-link text-white {{ Request::routeIs('index.consultation-date') ? 'active' : '' }}"
                           href="{{route('index.consultation-date')}}">
                            <i class="bi bi-calendar-plus"></i> Add Consultation Date
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a class="nav-link text-white {{ Request::routeIs('index.consultant-form') ? 'active' : '' }}"
                           href="{{route('index.consultant-form')}}">
                            <i class="bi bi-plus-circle"></i> Register as a Consultant
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-10 p-4 main-content">
                @yield('content')
            </div>

        </div>
    </div>

    <!-- Bottom Navigation Bar -->
    <div class="bottom-nav">
        <a href="{{route('doctor.dashboard')}}" class="{{ Request::routeIs('doctor.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 icon"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{route('index.patient')}}" class="{{ Request::routeIs('index.patient') ? 'active' : '' }}">
            <i class="bi bi-bag-plus icon"></i>
            <span>Patients</span>
        </a>
        <a href="{{route('index.consultation-date')}}"
           class="{{ Request::routeIs('index.consultation-date') ? 'active' : '' }}">
            <i class="bi bi-calendar-plus icon"></i>
            <span>Add Dates</span>
        </a>
        <a href="{{route('index.consultant-form')}}"
           class="{{ Request::routeIs('index.consultant-form') ? 'active' : '' }}">
            <i class="bi bi-plus-circle icon"></i>
            <span>Register</span>
        </a>
    </div>

</div>

<!-- Doctor Settings Modal -->
<div class="modal fade" id="doctorSettingsModal" tabindex="-1" aria-labelledby="doctorSettingsModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="doctorSettingsModalLabel">Settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Sidebar -->
                    <div class="col-md-3 border-end">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" id="general-tab" data-bs-toggle="tab" href="#doctor-general">
                                    <i class="bi bi-gear"></i> General
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#doctor-profile">
                                    <i class="bi bi-person"></i> Profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="password-tab" data-bs-toggle="tab" href="#doctor-password">
                                    <i class="bi bi-lock"></i> Password
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Content -->
                    <div class="col-md-9">
                        <div class="tab-content">
                            <!-- General Tab -->
                            <div class="tab-pane fade show active" id="doctor-general" role="tabpanel"
                                 aria-labelledby="general-tab">
                                <h4>General Settings</h4>
                                <p>Settings related to general application preferences.</p>
                            </div>

                            <!-- Profile Tab -->
                            <div class="tab-pane fade" id="doctor-profile" role="tabpanel"
                                 aria-labelledby="profile-tab">
                                <h4>Profile Settings</h4>
                                <form>
                                    <div class="mb-3">
                                        <label for="doctor-name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="doctor-name"
                                               value="{{ Auth::user()->name }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="doctor-email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="doctor-email"
                                               value="{{ Auth::user()->email }}">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
                            </div>

                            <!-- Password Tab -->
                            <div class="tab-pane fade" id="doctor-password" role="tabpanel"
                                 aria-labelledby="password-tab">
                                <h4>Password Settings</h4>
                                <form>
                                    <div class="mb-3">
                                        <label for="current-password" class="form-label">Current Password</label>
                                        <input type="password" class="form-control" id="current-password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="new-password" class="form-label">New Password</label>
                                        <input type="password" class="form-control" id="new-password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm-password" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirm-password">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Trigger Modal Script -->
<script>
    document.getElementById('settings-trigger').addEventListener('click', function (e) {
        e.preventDefault();
        var settingsModal = new bootstrap.Modal(document.getElementById('doctorSettingsModal'));
        settingsModal.show();
    });
</script>


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

