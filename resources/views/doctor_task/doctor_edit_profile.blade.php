<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skin care center-Edit Doctor Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

     <link rel="stylesheet" href="{{ asset('style.css') }}">


    <style>
        body { font-family: sans-serif; background: #f4f7f6; margin: 0; }
        .navbar { background: #137420; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; color: white; }
        .nav-links a { color: white; text-decoration: none; margin-left: 20px; }
        .doctor-dropdown { color: white !important; background: transparent; border: none; font-size: 16px; }
        .dropdown-menu a { color: black !important; text-decoration: none; }
        
        .main-container { padding: 40px; display: flex; justify-content: center; }
        .form-container { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); width: 100%; max-width: 600px; }
        .form-title { text-align: center; margin-bottom: 25px; font-size: 26px; color: #333; font-weight: bold; }
        .btn-submit { background-color: #137420; color: white; font-weight: bold; width: 100%; padding: 10px; }
        .btn-submit:hover { background-color: #0f5c19; color: white; }
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
        <div class="form-container">
            <div class="form-title"><i class="fa-solid fa-user-pen me-2" style="color: #137420;"></i> Edit Profile Information</div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('/doctor_update_profile') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Full Name</label>
                    <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $doctor->full_name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Date of Birth</label>
                    <input type="date" name="dob" class="form-control" value="{{ old('dob', $doctor->dob) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Qualification</label>
                    <input type="text" name="qualification" class="form-control" value="{{ old('qualification', $doctor->qualification) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Specialist</label>
                    <select name="specialist" class="form-select" required>
                        <option value="Skin" {{ old('specialist', $doctor->specialist) == 'Skin' ? 'selected' : '' }}>Skin</option>
                        <option value="Hair" {{ old('specialist', $doctor->specialist) == 'Hair' ? 'selected' : '' }}>Hair</option>
                        <option value="Cosmetic" {{ old('specialist', $doctor->specialist) == 'Cosmetic' ? 'selected' : '' }}>Cosmetic</option>
                        <option value="Laser" {{ old('specialist', $doctor->specialist) == 'Laser' ? 'selected' : '' }}>Laser</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $doctor->email) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Mobile Number</label>
                    <input type="text" name="mobile" class="form-control" value="{{ old('mobile', $doctor->mobNo) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Password</label>
                    <input type="text" name="password" class="form-control" value="{{ old('password', $doctor->password) }}" required>
                </div>

                <div class="row mt-4 align-items-center">
    <div class="col-6">
        <a href="{{ url('/doctor_view_profile') }}" class="btn btn-secondary w-100 fw-bold py-2">Cancel</a>
    </div>
    <div class="col-6">
        <button type="submit" class="btn btn-submit m-0 py-2">Update Profile</button>
    </div>
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