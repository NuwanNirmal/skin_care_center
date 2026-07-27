<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Skin Care Center</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

    <div class="navbar">
        <div class="logo"><a href="{{ url('/') }}">Skin care center</a></div>
        <div class="nav-links">
             <a href="{{ url('/admin_login') }}">Admin</a>
            <a href="{{ url('/doctor_login') }}">Doctor</a>
             <a href="{{ url('/user_login') }}">Appointment</a>
            <a href="{{ url('/user_login') }}">User</a>

        </div>
    </div>

    <div class="main-container">
        <div class="form-container">
            <div class="form-title">
                Reset Password
            </div>

            @if(session('error'))
                <div class="alert alert-danger text-center mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success text-center mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ url('/update-password-direct') }}">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Registered Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">New Password</label>
                    <input type="password" name="new_password" class="form-control" placeholder="Enter new password" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm your password" required>
                </div>

                <button type="submit" class="btn btn-submit">
                    Update Password
                </button>
            </form>
            
            <div class="back-link">
                <a href="{{ url('/user_login') }}">
                    Back to Login
                </a>
            </div>
        </div>
    </div>
    <div class="footer">
        © 2026 skin_care_center.com | All Rights Reserved.
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>