<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login - Skin care center</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">

   
</head>
<body>

    <div class="navbar shadow-sm">
        <div class="logo">
            <a href="{{ url('/') }}">Skin care center</a>
        </div>
        <div class="nav-links">
            <a href="{{ url('/admin_login') }}">Admin</a>
            <a href="{{ url('/doctor_login') }}">Doctor</a>
             <a href="{{ url('/user_login') }}">Appointment</a>
            <a href="{{ url('/user_login') }}">User</a>
        </div>
    </div>

    <div class="main-content">
        <div class="login-card">
            <h2>User Login</h2>

            @if(session('success'))
                <div class="alert alert-success p-2 text-center mb-3" style="font-size: 14px;">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger p-2 text-center mb-3" style="font-size: 14px;">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ url('/user_login_check') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required autocomplete="email">
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                </div>

                <div class="text-center mb-3">
                    <a href="{{ url('/user_forgot_password') }}" style="color: #137420; text-decoration: none; font-size: 14px;">Forgot Password?</a>
                </div>

                <button type="submit" class="login-btn">Login</button><br><br>

                <div class="card-links mt-3">
                    Don’t have an account? <a href="{{ url('/user_register') }}">Create one</a>
                </div>
            </form>
        </div>
    </div>

    <div class="footer">
        © 2026 skin_care_center.com | All Rights Reserved.
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>