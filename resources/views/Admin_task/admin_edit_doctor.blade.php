<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Doctor Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

    <div class="navbar">
        <div class="logo">Skin care center</div>
        <div class="nav-links d-flex align-items-center">

            <a href="{{ url('/admin_dashboard') }}">Home</a>
        </div>
    </div>

    <div class="main-container">
        <div class="form-container">
            <div class="form-title">Edit Profile Information</div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            
            <form action="{{ url('/update_doctor') }}" method="POST">
                @csrf
                
                
                <input type="hidden" name="id" value="{{ $doctor->id }}">
                
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

                <div class="row mt-4">
                        
                        <a href="{{ url('/view_doctor') }}" class="btn btn-secondary w-100 fw-bold">Cancel</a>
                    </div>
                    <div class="col-20">
                        <button type="submit" class="btn btn-submit w-100 fw-bold">Update Profile</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <div class="footer" style="width: 100%; text-align: center; margin-top: auto;">
        &copy; {{ date('Y') }} skin_care_center.com | All Rights Reserved.
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>