<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <style>
        body { font-family: sans-serif; background: #f4f7f6; margin: 0; }
        .navbar { background: #137420; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; color: white; }
        .nav-links a { color: white; text-decoration: none; margin-left: 20px; }
        .doctor-dropdown { color: white !important; background: transparent; border: none; font-size: 16px; }
        .dropdown-menu a { color: black !important; text-decoration: none; }
        
        .main-container { padding: 40px; display: flex; justify-content: center; }
        .profile-container { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); width: 100%; max-width: 700px; }
        .profile-title { text-align: center; margin-bottom: 25px; font-size: 28px; color: #333; font-weight: bold; }
        .table th { background-color: #f8f9fa; width: 35%; text-align: left; font-weight: 600; color: #555; }
        .table td { color: #333; }
    </style>
</head>
<body>

    <div class="navbar">
        <div class="logo">Skin care center</div>
        <div class="nav-links d-flex align-items-center">
            <a href="{{ url('/doctor_dashboard') }}">Home</a>
            <a href="{{ url('/doctor_view_patients') }}">Patient Details</a>
            
            <div class="dropdown ms-3">
                <button class="btn doctor-dropdown dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    {{ session('doctor_name', 'Doctor') }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ url('/doctor_view_profile') }}">View Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ url('/doctor_logout') }}">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="main-container">
        <div class="profile-container">
            <div class="profile-title">My Profile Details</div>

            @if(session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered align-middle mt-3">
                <tr>
                    <th>Full Name</th>
                    <td>{{ $doctor->full_name }}</td>
                </tr>
                <tr>
                    <th>Date of Birth</th>
                    <td>{{ $doctor->dob }}</td>
                </tr>
                <tr>
                    <th>Qualification</th>
                    <td>{{ $doctor->qualification }}</td>
                </tr>
                <tr>
                    <th>Specialization</th>
                    <td>{{ $doctor->specialist }}</td>
                </tr>
                <tr>
                    <th>Email Address</th>
                    <td>{{ $doctor->email }}</td>
                </tr>
                <tr>
                    <th>Mobile Number</th>
                    <td>{{ $doctor->mobNo }}</td>
                </tr>
                <tr>
                    <th>Password</th>
                    <td><code>{{ $doctor->password }}</code></td>
                </tr>
            </table>

            <div class="text-center mt-4">
                <a href="{{ url('/doctor_edit_profile') }}" class="btn btn-warning px-4 fw-bold text-dark">
                    Edit Profile Information
                </a>
            </div>
        </div>
    </div>
   
    <footer style="text-align: center; padding: 20px; background-color: #137420; color: white;">
        &copy; {{ date('Y') }} skin_care_center.com | All Rights Reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>