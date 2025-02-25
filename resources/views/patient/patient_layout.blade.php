<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediCoSys - Patient Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/patient.css') }}">

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
<div class="dashboard-container">
    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand ms-3" href="#">MediCo<span>Sys</span></a>
        <div class="ms-auto me-3 d-flex align-items-center">
            <!-- Dropdown for Account and Logout -->
            <div class="dropdown">
                <a href="#" class="dropdown-toggle text-dark" id="accountDropdown" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    <i class="bi bi-person-circle" style="font-size: 1.5rem;"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
                    <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#settingsModal"><i class="bi bi-gear"></i> Settings</a></li>
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
            <!-- Sidebar Navigation -->
            <div class="col-md-2 bg-dark text-white collapse d-lg-block sidebarCollapse" id="sidebarCollapse">
                <ul class="nav flex-column pt-4">
                    <li class="nav-item mb-3">
                        <a class="nav-link text-white {{ Request::routeIs('patient.dashboard') ? 'active' : '' }}"
                           href="{{route('patient.dashboard')}}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a class="nav-link text-white {{ Request::routeIs('patient.report') ? 'active' : '' }}"
                           href="{{route('patient.report')}}">
                            <i class="bi bi-file-earmark-text"></i> Reports
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a class="nav-link text-white {{ Request::routeIs('parkinson.index') ? 'active' : '' }}"
                           href="{{route('parkinson.index')}}">
                            <i class="bi bi-heart-pulse"></i> Predict
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a class="nav-link text-white {{ Request::routeIs('patient.consultation') ? 'active' : '' }}"
                           href="{{route('patient.consultation')}}">
                            <i class="bi bi-calendar-plus"></i> Book a Doctor
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a class="nav-link text-white {{ Request::routeIs('patient.bookings') ? 'active' : '' }}"
                           href="{{route('patient.bookings')}}">
                            <i class="bi bi-calendar2-check"></i> Booking
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a class="nav-link text-white {{ Request::routeIs('index.medical-history') ? 'active' : '' }}"
                           href="{{route('index.medical-history')}}">
                            <i class="bi bi-file-medical"></i> Medical Records
                        </a>
                    </li>
{{--                    <li class="nav-item mb-3">--}}
{{--                        <a class="nav-link text-white {{ Request::routeIs('welcome') ? 'active' : '' }}"--}}
{{--                           href="/welcome">--}}
{{--                            <i class="bi bi-back"></i> Back--}}
{{--                        </a>--}}
{{--                    </li>--}}

                </ul>
            </div>

            <!-- Main Content Area -->
            <div class="col-md-10 p-4 main-content">
                @yield('content') <!-- Main content goes here -->
            </div>
        </div>
    </div>

    <!-- Bottom Navigation Bar -->
    <div class="bottom-nav d-lg-none">
        <a href="{{ route('patient.dashboard') }}" class="{{ Request::routeIs('patient.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 icon"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('patient.report') }}" class="{{ Request::routeIs('patient.report') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-text icon"></i>
            <span>Reports</span>
        </a>
        <a href="{{route('patient.consultation')}}"
           class="{{ Request::routeIs('patient.consultation') ? 'active' : '' }}">
            <i class="bi bi-calendar-plus icon"></i>
            <span>Appointment</span>
        </a>
        <a href="{{route('patient.bookings')}}" class="{{ Request::routeIs('patient.bookings') ? 'active' : '' }}">
            <i class="bi bi-calendar2-check icon"></i>
            <span>Bookings</span>
        </a>
        <a href="{{route('index.medical-history')}}"
           class="{{ Request::routeIs('index.medical-history') ? 'active' : '' }}">
            <i class="bi bi-file-medical icon"></i>
            <span>Medical History</span>
        </a>
    </div>
</div>


<!-- Settings Modal -->
<div class="modal fade" id="settingsModal" tabindex="-1" aria-labelledby="settingsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="settingsModalLabel">Settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Sidebar -->
                    <div class="col-md-3 border-end">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" id="general-tab" data-bs-toggle="tab" href="#general">
                                    <i class="bi bi-gear"></i> General
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile">
                                    <i class="bi bi-person"></i> Profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="password-tab" data-bs-toggle="tab" href="#password">
                                    <i class="bi bi-lock"></i> Password
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Content -->
                    <div class="col-md-9">
                        <div class="tab-content">
                            <!-- General Tab -->
                            <div class="tab-pane fade show active" id="general" role="tabpanel"
                                 aria-labelledby="general-tab">
                                <h4>General Settings</h4>
                                <p>Settings related to general application preferences.</p>
                            </div>

                            <!-- Profile Tab -->
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <h4>Profile Settings</h4>
                                <form>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name"
                                               value="{{ Auth::user()->name }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email"
                                               value="{{ Auth::user()->email }}">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
                            </div>

                            <!-- Password Tab -->
                            <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
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
</script>
</body>
</html>
