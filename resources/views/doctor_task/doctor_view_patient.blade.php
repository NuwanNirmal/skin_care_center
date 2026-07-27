<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Details</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('style.css') }}">
    
    <style>
        body { font-family: sans-serif; background: #f4f7f6; margin: 0; }
        
        /* Dashboard Navbar */
        .navbar { background: #137420; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; color: white; }
        .nav-links a { color: white; text-decoration: none; margin-left: 20px; }
        .doctor-dropdown { color: white !important; background: transparent; border: none; font-size: 16px; }
        .dropdown-menu a { color: black !important; text-decoration: none; }
        
        /* Table Container */
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
        
        /* Table Border & Slim Row Padding */
        .table th {
            border-bottom: 2px solid #333 !important;
            font-weight: bold;
            color: #000;
            padding: 8px 10px !important; /* සිහින් තීරුවක් කිරීමට */
        }
        .table td { 
            vertical-align: middle; 
            padding: 6px 10px !important; /* රෝ එකේ පළල (උස) උපරිම අඩු කිරීමට */
            font-size: 14px;
        }
        
        /* Status Badge Styling */
        .badge-status {
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
            display: inline-block;
        }
        .badge-pending { background-color: #ffc107; color: #000; }
        .badge-approved { background-color: #198754; color: #fff; }
        .badge-rejected { background-color: #dc3545; color: #fff; }

        /* Form reset to prevent stretching */
        .table td form {
            display: inline-block;
            margin: 0;
            padding: 0;
            width: auto;
        }

        /* Tiny Action Buttons (නියමිත පරිදි ගොඩක්ම චූටි කිරීමට) */
        .btn-action-tiny { 
            padding: 0 !important;
            font-size: 10px !important; 
            border-radius: 3px !important;
            height: 22px !important;
            width: 22px !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            border: none !important;
            box-shadow: none !important;
        }
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
        <div class="table-container">

            <div class="table-title">Patient Details (My Appointments)</div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <table class="table table-hover mt-3 align-middle">
                <thead>
                    <tr>
                        <th>App No</th> <!-- අලුතින් එකතු කළා -->
                        <th>Patient Name</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Appoint Date</th>
                        <th>Time</th> <!-- අලුතින් එකතු කළා -->
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Disease</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $appoi)
                    <tr>
                        <!-- Appointment Number එක පෙන්වීම -->
                        <td><strong class="text-secondary">{{ $appoi->appointment_no }}</strong></td> 
                        
                        <td>{{ $appoi->fullName }}</td>
                        <td>{{ $appoi->gender }}</td>
                        <td>{{ $appoi->age }}</td>
                        <td>{{ $appoi->appoint_date }}</td>
                        
                        <!-- Appointment Time එක පෙන්වීම -->
                        <td><span class="badge bg-light text-dark border">{{ $appoi->appointment_time }}</span></td>
                        
                        <td>{{ $appoi->email }}</td>
                        <td>{{ $appoi->phNo }}</td>
                        <td>{{ $appoi->diseases }}</td>
                        <td>{{ $appoi->address ?? 'N/A' }}</td>
                        <td>
                            @if($appoi->status == 'Approved')
                                <span class="badge-status badge-approved">Approved</span>
                            @elseif($appoi->status == 'Rejected')
                                <span class="badge-status badge-rejected">Rejected</span>
                            @else
                                <span class="badge-status badge-pending">Pending</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1 justify-content-center align-items-center">
                                <form action="{{ url('/appointment/approve/'.$appoi->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to approve this appointment?');">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-action-tiny" title="Accept Appointment" {{ $appoi->status == 'Approved' ? 'disabled' : '' }}>
                                        <i class="fa fa-check"></i>
                                    </button>
                                </form>

                                <form action="{{ url('/appointment/reject/'.$appoi->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to reject this appointment?');">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-action-tiny" title="Reject Appointment" {{ $appoi->status == 'Rejected' ? 'disabled' : '' }}>
                                        <i class="fa fa-times"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="12" class="text-center text-muted py-4">no appointments have been booked for you yet..</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
    <div class="footer text-center py-3 text-muted">
        © 2026 skin_care_center.com | All Rights Reserved.
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>