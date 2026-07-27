<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    
    <style>
        body { font-family: sans-serif; background: #f4f7f6; margin: 0; display: flex; flex-direction: column; min-height: 100vh; }
        .navbar { background: #137420; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; color: white; }
        .nav-links a { color: white; text-decoration: none; margin-left: 20px; }
        .admin-dropdown { color: white !important; background: transparent; border: none; font-size: 16px; }
        .dropdown-menu a { color: black !important; text-decoration: none; }
        
        .main-container { padding: 40px; flex: 1; }
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
        .table td { vertical-align: middle; font-size: 14px; }
        
        /* Status Badges */
        .badge-pending { background-color: #ffc107; color: #000; padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: bold; }
        .badge-approved { background-color: #198754; color: #fff; padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: bold; }
        .badge-rejected { background-color: #dc3545; color: #fff; padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: bold; }

        /* Print Report Layout */
        @media print {
            body * { visibility: hidden; }
            .table-container, .table-container * { visibility: visible; }
            .table-container { position: absolute; left: 0; top: 0; width: 100%; box-shadow: none; padding: 0; }
            .btn, .navbar, .footer, .alert, .action-buttons-wrapper { display: none !important; }
        }
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
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-container">
            
            <div class="table-title">Patient Details (Appointments)</div>

            <div class="d-flex justify-content-between align-items-center mb-4 action-buttons-wrapper">
                <div>
                    <button onclick="window.print()" class="btn btn-dark text-white me-2">
                        <i class="fa-solid fa-file-pdf me-2"></i>Print Daily Report
                    </button>
                    
                    @if(request('filter') == 'history')
                        <a href="{{ url('/view_patient') }}" class="btn btn-outline-success">
                            <i class="fa-solid fa-calendar-day me-2"></i>Show Today's Appointments
                        </a>
                    @else
                        <a href="{{ url('/view_patient?filter=history') }}" class="btn btn-outline-secondary">
                            <i class="fa-solid fa-history me-2"></i>View Past Appointments History
                        </a>
                    @endif
                </div>

                @if(request('filter') != 'history' && $appointments->count() > 0)
                    <form action="{{ url('/clear_today_appointments') }}" method="POST" onsubmit="return confirm('Are you sure you want to completely clear and delete ALL of today\'s appointments? This action cannot be undone.');">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-trash-can me-2"></i>Clear Today's Appointments
                        </button>
                    </form>
                @endif
            </div>

            @if($appointments->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mt-3 align-middle">
                        <thead>
                            <tr>
                                <th>App No</th> <th>Patient Name</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Appoint Date</th>
                                <th>Time</th> <th>Email</th>
                                <th>Phone</th>
                                <th>Disease</th>
                                <th>Doctor Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appoi)
                            <tr>
                                <td><strong class="text-secondary">{{ $appoi->appointment_no }}</strong></td>
                                
                                <td>{{ $appoi->fullName }}</td>
                                <td>{{ $appoi->gender }}</td>
                                <td>{{ $appoi->age }}</td>
                                <td>{{ $appoi->appoint_date }}</td>
                                
                                <td><span class="badge bg-light text-dark border">{{ $appoi->appointment_time }}</span></td>
                                
                                <td>{{ $appoi->email }}</td>
                                <td>{{ $appoi->phNo }}</td>
                                <td>{{ $appoi->diseases }}</td>
                                <td>{{ $appoi->doctor_name ?? 'N/A' }}</td>
                                <td>
                                    @if(strtolower($appoi->status) == 'approved')
                                        <span class="badge-approved">Approved</span>
                                    @elseif(strtolower($appoi->status) == 'rejected')
                                        <span class="badge-rejected">Rejected</span>
                                    @else
                                        <span class="badge-pending">Pending</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info text-center my-4">
                    <i class="fa-solid fa-info-circle me-2"></i>No appointments found for this selection.
                </div>
            @endif

        </div>
    </div>

    <div class="footer py-3" style="width: 100%; text-align: center; margin-top: auto; background: #0a5c15; border-top: 1px solid #dee2e6; color: white;">
        &copy; {{ date('Y') }} skin_care_center.com | All Rights Reserved.
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>