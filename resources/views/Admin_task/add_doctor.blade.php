<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Doctor - Skin care center</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('style.css') }}">
    
    <style>
        body { font-family: sans-serif; background: #f4f7f6; margin: 0; }
        
        
        .navbar { background: #137420; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; color: white; }
        .nav-links a { color: white; text-decoration: none; margin-left: 20px; text-transform: none; font-size: 16px; }
        .admin-dropdown { color: white !important; background: transparent; border: none; font-size: 16px; }
        .dropdown-menu a { color: black !important; text-decoration: none; }

        
        .main-container { padding: 40px; }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .form-title {
            text-align: center;
            font-size: 28px;
            margin-bottom: 25px;
            color: #333;
        }
        .form-label { font-weight: bold; color: #444; }
        .form-control, .form-select { border-radius: 4px; padding: 10px; }
        
        
        .btn-submit { 
            background-color: #0d6efd; 
            color: white; 
            border: none; 
            width: 100px; 
            padding: 10px; 
            border-radius: 4px; 
        }
        .btn-submit:hover { background-color: #0b5ed7; }
    </style>
</head>
<body>

    <div class="navbar">
        <div class="logo" style="font-size: 20px; font-weight: bold;">Skin care center</div>
        <div class="nav-links d-flex align-items-center">
            <a href="{{ url('/admin_dashboard') }}">Home</a>
          
            <div class="dropdown ms-3">
                <button class="btn admin-dropdown dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Admin
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ url('/admin_logout') }}">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="main-container">
        <div class="form-container">
            <h2 class="form-title">Add Doctor</h2>
            
            @if(session('success'))
                <div class="alert alert-success p-2 mb-3">{{ session('success') }}</div>
            @endif

            <form action="{{ url('/save_doctor') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="full_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">DOB</label>
                    <input type="date" name="dob" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Qualification</label>
                    <input type="text" name="qualification" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Specialist</label>
                    <select name="specialist" class="form-select" required>
                        <option value="">--select--</option>
                        <option value="Dermatologist">Dermatologist</option>
                        <option value="Surgeon">Surgeon</option>
                        <option value="Physician">Physician</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mob No</label>
                    <input type="text" name="mobile" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="text-start">
                    <button type="submit" class="btn-submit">Submit</button>
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