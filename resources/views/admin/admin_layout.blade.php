<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parkinson Disease Detection</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/patient.css') }}">
{{--    <link rel="stylesheet" href="{{ asset('assets/css/common.css') }}">--}}
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
</head>
<body>

@if(Auth::user()->status === 'inactive')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function showInactiveAlert() {
                Swal.fire({
                    title: 'Account Inactive',
                    text: 'Your account is inactive. Please contact a Super Admin to activate your account. You cannot proceed until activation.',
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Logout',
                    cancelButtonColor: '#d33',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false,
                    didClose: () => {
                        // Show the alert again after a brief timeout
                        setTimeout(showInactiveAlert, 100);
                    }
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.cancel) {
                        // Submit the logout form
                        const logoutForm = document.createElement('form');
                        logoutForm.method = 'POST';
                        logoutForm.action = "{{ route('admin.logout') }}";

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

            // Trigger the alert
            showInactiveAlert();
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
        <a class="navbar-brand ms-3" href="#">MediCo<span>Sys</span></a> <!-- Updated Heading -->
        <div class="ms-auto me-3 d-flex align-items-center">
            <!-- Dropdown for Account and Logout -->
            <div class="dropdown">
                <a href="#" class="dropdown-toggle text-dark" id="accountDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle" style="font-size: 1.5rem;"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
                    <li>
                        <a class="dropdown-item" href="#">
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
                        <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <!-- Main Container -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Navigation -->
            <div class="col-md-2 bg-dark text-white collapse d-lg-block sidebarCollapse" id="sidebarCollapse">
                <ul class="nav flex-column pt-4">
                    <li class="nav-item mb-3">
                        <a class="nav-link text-white {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a class="nav-link text-white {{ Request::routeIs('index.doctors') ? 'active' : '' }}" href="{{ route('index.doctors') }}">
                            <i class="bi bi-clipboard2-pulse"></i> Doctors
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a class="nav-link text-white {{ Request::routeIs('index.patients') ? 'active' : '' }}" href="{{ route('index.patients') }}">
                            <i class="bi bi-lungs"></i> Patients
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a class="nav-link text-white {{ Request::routeIs('admin.list') ? 'active' : '' }}" href="{{ route('admin.list') }}">
                            <i class="bi bi-calendar-plus"></i> Admins
                        </a>
                    </li>
                    @if(Auth::user()->role === 'superadmin')
                        <li class="nav-item mb-3">
                            <a class="nav-link text-white {{ Request::routeIs('index.register1') ? 'active' : '' }}" href="{{ route('index.register1') }}">
                                <i class="bi bi-plus-circle"></i> Register New Admin
                            </a>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="col-md-10 p-4 main-content">
                @yield('content')
            </div>

        </div>
    </div>

    <!-- Bottom Navigation Bar -->
    <div class="bottom-nav d-lg-none">
        <a href="{{ route('admin.dashboard') }}" class="{{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 icon"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('index.doctors') }}" class="{{ Request::routeIs('index.doctors') ? 'active' : '' }}">
            <i class="bi bi-clipboard2-pulse icon"></i>
            <span>Doctors</span>
        </a>
        <a href="{{ route('index.patients') }}" class="{{ Request::routeIs('index.patients') ? 'active' : '' }}">
            <i class="bi bi-lungs icon"></i>
            <span>Patients</span>
        </a>
        <a href="{{ route('admin.list') }}" class="{{ Request::routeIs('admin.list') ? 'active' : '' }}">
            <i class="bi bi-calendar-plus icon"></i>
            <span>Admins</span>
        </a>
        @if(Auth::user()->role === 'superadmin')
            <a href="{{ route('index.register1') }}" class="{{ Request::routeIs('index.register1') ? 'active' : '' }}">
                <i class="bi bi-plus-circle icon"></i>
                <span>Register Admin</span>
            </a>
        @endif
    </div>

</div>

<!-- Doctor Settings Modal -->
<div class="modal fade" id="doctorSettingsModal" tabindex="-1" aria-labelledby="doctorSettingsModalLabel" aria-hidden="true">
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
                            <div class="tab-pane fade show active" id="doctor-general" role="tabpanel" aria-labelledby="general-tab">
                                <h4>General Settings</h4>
                                <p>Settings related to general application preferences.</p>
                            </div>

                            <!-- Profile Tab -->
                            <div class="tab-pane fade" id="doctor-profile" role="tabpanel" aria-labelledby="profile-tab">
                                <h4>Profile Settings</h4>
                                <form>
                                    <div class="mb-3">
                                        <label for="doctor-name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="doctor-name" value="{{ Auth::user()->name }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="doctor-email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="doctor-email" value="{{ Auth::user()->email }}">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
                            </div>

                            <!-- Password Tab -->
                            <div class="tab-pane fade" id="doctor-password" role="tabpanel" aria-labelledby="password-tab">
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
                logoutForm.action = "{{route('admin.logout')}}";
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

    document.addEventListener('DOMContentLoaded', function() {
        const statusButtons = document.querySelectorAll('.status-btn');

        statusButtons.forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('.status-form');
                const action = this.textContent.trim(); // Activate or Deactivate

                Swal.fire({
                    title: `Are you sure you want to ${action.toLowerCase()} this admin?`,
                    text: `You are about to ${action.toLowerCase()} this admin. This action can be reversed later.`,
                    icon: action === 'inactive' ? 'warning' : 'info',
                    showCancelButton: true,
                    confirmButtonText: `Yes, ${action}`,
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: action === 'inactive' ? '#d33' : '#3085d6',
                    cancelButtonColor: '#6c757d'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        const toggleButtons = document.querySelectorAll('.toggle-status-btn');

        toggleButtons.forEach(button => {
            button.addEventListener('click', function () {
                const doctorId = this.dataset.id;
                const action = this.dataset.status;
                const form = document.getElementById('toggleStatusForm');
                const url = "{{ route('admin.doctors.toggleStatus', ':id') }}".replace(':id', doctorId);

                Swal.fire({
                    title: 'Are you sure?',
                    text: `Do you really want to ${action} this doctor?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, proceed!',
                    cancelButtonText: 'Cancel',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.action = url;
                        form.submit();
                    }
                });
            });
        });
    });
</script>
</body>
</html>

