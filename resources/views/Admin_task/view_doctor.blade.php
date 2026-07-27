<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

     <link rel="stylesheet" href="{{ asset('style.css') }}">
    
    <style>
        body { font-family: sans-serif; background: #f4f7f6; margin: 0; }
        
        
        .navbar { background: #137420; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; color: white; }
        .nav-links a { color: white; text-decoration: none; margin-left: 20px; }
        .admin-dropdown { color: white !important; background: transparent; border: none; font-size: 16px; }
        .dropdown-menu a { color: black !important; text-decoration: none; }
        
        
        .main-container { padding: 40px; }
        .table-container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .table-title {
            text-align: center;
            margin-bottom: 25px;
            font-size: 28px;
            color: #333;
        }
        
        
        .table th {
            border-bottom: 2px solid #333 !important;
            font-weight: bold;
            color: #000;
        }
        .table td { vertical-align: middle; }
        
        
        .btn-custom-edit {
            background-color: #0d6efd;
            color: white;
            padding: 2px 8px;
            font-size: 12px;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
        }
        .btn-custom-edit:hover { background-color: #0b5ed7; color: white; }
        
        .btn-custom-delete {
            background-color: #dc3545;
            color: white;
            padding: 2px 8px;
            font-size: 12px;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
        }
        .btn-custom-delete:hover { background-color: #bb2d3b; color: white; }
    </style>
</head>
<body>

    <div class="navbar">
        <div class="logo">Skin care center</div>
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
        <div class="table-container">
            
            @if(session('success')) 
                <div class="alert alert-success p-2 mb-3">{{ session('success') }}</div> 
            @endif

            <div class="table-title">Doctor Details</div>

            <table class="table table-hover mt-3">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>DOB</th>
                        <th>Qualification</th>
                        <th>Specialist</th>
                        <th>Email</th>
                        <th>Mob No</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($doctors as $doc)
                    <tr>
                        <td>{{ $doc->full_name }}</td>
                        <td>{{ $doc->dob }}</td>
                        <td>{{ $doc->qualification }}</td>
                        <td>{{ $doc->specialist }}</td>
                        <td>{{ $doc->email }}</td>
                        <td>{{ $doc->mobNo }}</td>
                        <td>
                            <a href="{{ url('/edit_doctor/'.$doc->id) }}" class="btn-custom-edit me-1">Edit</a>
                            
                            <a href="{{ url('/delete_doctor/'.$doc->id) }}" 
                               class="btn-custom-delete" 
                               onclick="return confirm('Are you sure you want to delete this doctor?')">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    
    <div class="footer">
        © 2026 skin_care_center.com | All Rights Reserved.
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>