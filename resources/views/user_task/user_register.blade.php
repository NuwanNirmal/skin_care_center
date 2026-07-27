<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration - Skin Care Center</title>
    
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
                User Registration
            </div>

            @if(session('error'))
                <div class="alert alert-danger text-center mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger text-center mb-4">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ url('/user_register_save') }}">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Full Name</label>
                    <input type="text" name="full_name" value="{{ old('name') }}" class="form-control" placeholder="Enter your full name" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Email address</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter your email" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                </div>

                <button type="submit" class="btn btn-submit">
                    Register
                </button>
            </form>
            
           <div class="back-link">
    <a href="{{ url('/user_login') }}">Back to Login</a>
            </div>
        </div>
    </div>
      <div class="footer">
        © 2026 skin_care_center.com | All Rights Reserved.
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>