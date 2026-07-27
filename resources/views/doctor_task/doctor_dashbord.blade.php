<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard - Skin Care Center</title>
    
    <!-- Bootstrap 5 & FontAwesome Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background: #f8f9fa; 
            margin: 0; 
        }
        .navbar { 
            background: #137420; 
            padding: 15px 30px; 
            color: white; 
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .navbar .logo {
            font-size: 22px;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .nav-links a { 
            color: rgba(255, 255, 255, 0.9); 
            text-decoration: none; 
            margin-left: 20px; 
            font-weight: 500;
            transition: 0.3s;
        }
        .nav-links a:hover {
            color: #ffc107;
        }
        .doctor-dropdown { 
            color: white !important; 
            background: rgba(255,255,255,0.1); 
            border: 1px solid rgba(255,255,255,0.2); 
            border-radius: 20px;
            padding: 6px 18px;
        }
        .doctor-dropdown:hover {
            background: rgba(255,255,255,0.2);
        }
        .stat-card { 
            background: white; 
            padding: 25px; 
            border-radius: 12px; 
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05); 
            transition: transform 0.3s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .doctor-card {
            background: white;
            border-radius: 15px;
            border: none;
            box-shadow: 0 6px 18px rgba(0,0,0,0.06);
            overflow: hidden;
            transition: 0.3s;
            height: 100%;
        }
        .doctor-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .doctor-header {
            background: linear-gradient(135deg, #1d9630, #137420);
            color: white;
            padding: 20px;
            text-align: center;
        }
        .doctor-avatar {
            width: 70px;
            height: 70px;
            background: white;
            color: #137420;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            margin-bottom: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .time-badge {
            background-color: #e8f5e9;
            color: #1b5e20;
            font-weight: 600;
            padding: 6px 12px;
            margin: 4px;
            border-radius: 8px;
            display: inline-block;
            font-size: 0.85rem;
            border: 1px solid #c8e6c9;
        }
        .feature-box {
            background: white;
            padding: 20px;
            border-radius: 10px;
            border-left: 5px solid #137420;
            box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        }
        .footer {
            background: #187420;
            color: p#f7f6f6;
            padding: 20px 0;
            text-align: center;
            margin-top: 60px;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <!-- Top Navigation Bar -->
    <div class="navbar d-flex justify-content-between align-items-center">
        <div ></i>Skin Care Center</div>
        <div class="nav-links d-flex align-items-center">
            <a href="{{ url('/doctor_dashboard') }}"><i class="fa-solid fa-house me-1"></i> Home</a>
            <a href="{{ url('/doctor_view_patients') }}"><i class="fa-solid fa-user-injured me-1"></i> Patient Details</a>
            
            <div class="dropdown ms-3">
                <button class="btn doctor-dropdown dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-user-md me-1"></i> {{ session('doctor_name', 'Doctor') }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li><a class="dropdown-item" href="{{ url('/doctor_view_profile') }}"><i class="fa-solid fa-id-card me-2 text-secondary"></i>View Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="{{ url('/doctor_logout') }}"><i class="fa-solid fa-sign-out-alt me-2"></i>Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- Main Content Container -->
    <div class="container my-5">
        
        <!-- Alerts Notifications -->
        @if(session('success')) 
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div> 
        @endif
        @if(session('error')) 
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <i class="fa-solid fa-circle-xmark me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div> 
        @endif

        <!-- Welcome Header -->
        <div class="text-center mb-5">
            <h1 class="fw-bold text-dark">Welcome to Doctor Dashboard</h1>
            <p class="text-muted">Manage your daily appointments and view clinical specialists information below.</p>
        </div>
        
        <!-- Statistics Counter Cards Area -->
        <div class="row g-4 justify-content-center mb-5">
            <div class="col-md-4 col-sm-6">
                <div class="stat-card text-center">
                    <div class="text-success mb-2"><i class="fa-solid fa-calendar-check fa-3x"></i></div>
                    <h4 class="text-secondary">My Patients</h4>
                    <p class="fs-1 fw-bold text-success m-0">{{ count($appointments) }}</p>
                </div>
            </div>
            
            <div class="col-md-4 col-sm-6">
                <div class="stat-card text-center">
                    <div class="text-primary mb-2"><i class="fa-solid fa-user-user fa-user-shield fa-3x"></i></div>
                    <h4 class="text-secondary">Total Registered Doctors</h4>
                    <p class="fs-1 fw-bold text-primary m-0">{{ $allDoctorsCount }}</p>
                </div>
            </div>
        </div>

        <hr class="my-5">

        <!-- Section: Medical Panel Grid -->
        <h2 class="text-center fw-bold text-dark mb-4"><i class="fa-solid fa-user-md text-success me-2"></i>Our Medical Experts & Time Slots</h2>
        
        <div class="row g-4">
            <!-- Doctor 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="doctor-card">
                    <div class="doctor-header">
                        <div class="doctor-avatar"><i class="fa-solid fa-user-doctor"></i></div>
                        <h5 class="fw-bold mb-1">Dr. Melan Silva</h5>
                        <small class="opacity-75">MBBS, Diploma in Skin Care</small>
                    </div>
                    <div class="p-4 text-center">
                        <p class="fw-semibold text-muted mb-2"><i class="fa-regular fa-clock me-1 text-success"></i> Available Slots</p>
                        <span class="time-badge">09:00 AM</span>
                        <span class="time-badge">10:00 AM</span>
                        <span class="time-badge">11:00 AM</span>
                    </div>
                </div>
            </div>

            <!-- Doctor 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="doctor-card">
                    <div class="doctor-header">
                        <div class="doctor-avatar"><i class="fa-solid fa-user-doctor"></i></div>
                        <h5 class="fw-bold mb-1">Dr. Kasuni Fernando</h5>
                        <small class="opacity-75">MBBS, MD (Dermatology)</small>
                    </div>
                    <div class="p-4 text-center">
                        <p class="fw-semibold text-muted mb-2"><i class="fa-regular fa-clock me-1 text-success"></i> Available Slots</p>
                        <span class="time-badge">11:00 AM</span>
                        <span class="time-badge">12:00 PM</span>
                        <span class="time-badge">01:00 PM</span>
                    </div>
                </div>
            </div>

            <!-- Doctor 3 -->
            <div class="col-lg-4 col-md-6">
                <div class="doctor-card">
                    <div class="doctor-header">
                        <div class="doctor-avatar"><i class="fa-solid fa-user-doctor"></i></div>
                        <h5 class="fw-bold mb-1">Dr. Hasitha Rathnayake</h5>
                        <small class="opacity-75">MBBS, MS (Plastic Surgery)</small>
                    </div>
                    <div class="p-4 text-center">
                        <p class="fw-semibold text-muted mb-2"><i class="fa-regular fa-clock me-1 text-success"></i> Available Slots</p>
                        <span class="time-badge">01:00 PM</span>
                        <span class="time-badge">02:00 PM</span>
                        <span class="time-badge">03:00 PM</span>
                    </div>
                </div>
            </div>

            <!-- Doctor 4 -->
            <div class="col-lg-4 col-md-6">
                <div class="doctor-card">
                    <div class="doctor-header">
                        <div class="doctor-avatar"><i class="fa-solid fa-user-doctor"></i></div>
                        <h5 class="fw-bold mb-1">Dr. Pasan Gunawardena</h5>
                        <small class="opacity-75">MBBS, Dip. in Laser Surgery</small>
                    </div>
                    <div class="p-4 text-center">
                        <p class="fw-semibold text-muted mb-2"><i class="fa-regular fa-clock me-1 text-success"></i> Available Slots</p>
                        <span class="time-badge">03:00 PM</span>
                        <span class="time-badge">04:00 PM</span>
                        <span class="time-badge">05:00 PM</span>
                    </div>
                </div>
            </div>

            <!-- Doctor 5 -->
            <div class="col-lg-4 col-md-6">
                <div class="doctor-card">
                    <div class="doctor-header">
                        <div class="doctor-avatar"><i class="fa-solid fa-user-doctor"></i></div>
                        <h5 class="fw-bold mb-1">Dr. Roshana Wickramage</h5>
                        <small class="opacity-75">MBBS, MD (Pediatrics)</small>
                    </div>
                    <div class="p-4 text-center">
                        <p class="fw-semibold text-muted mb-2"><i class="fa-regular fa-clock me-1 text-success"></i> Available Slots</p>
                        <span class="time-badge">04:00 PM</span>
                        <span class="time-badge">05:00 PM</span>
                        <span class="time-badge">06:00 PM</span>
                    </div>
                </div>
            </div>

            <!-- Doctor 6 -->
            <div class="col-lg-4 col-md-6">
                <div class="doctor-card">
                    <div class="doctor-header">
                        <div class="doctor-avatar"><i class="fa-solid fa-user-doctor"></i></div>
                        <h5 class="fw-bold mb-1">Dr. Dinithi Madushika</h5>
                        <small class="opacity-75">MBBS Skin Care</small>
                    </div>
                    <div class="p-4 text-center">
                        <p class="fw-semibold text-muted mb-2"><i class="fa-regular fa-clock me-1 text-success"></i> Available Slots</p>
                        <span class="time-badge">05:00 PM</span>
                        <span class="time-badge">06:00 PM</span>
                        <span class="time-badge">07:00 PM</span>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-5">

        <!-- Section: Key Features -->
        <h3 class="fw-bold text-dark mb-4 text-center"><i class="fa-solid fa-star text-warning me-2"></i>Key Features of our Hospital</h3>
        <div class="row g-3 text-start">
            <div class="col-md-4">
                <div class="feature-box">
                    <h5><i class="fa-solid fa-user-shield text-success me-2"></i>Certified Specialists</h5>
                    <p class="text-muted mb-0">All our treatments are carried out by board-certified professional clinical dermatologists.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box">
                    <h5><i class="fa-solid fa-microscope text-success me-2"></i>Modern Technology</h5>
                    <p class="text-muted mb-0">Equipped with highly advanced laser therapies and diagnostic testing medical systems.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box">
                    <h5><i class="fa-solid fa-notes-medical text-success me-2"></i>Patient Centric Care</h5>
                    <p class="text-muted mb-0">Providing dedicated individual skincare analysis and highly flexible digital scheduling slots.</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Standard Footer Block -->
    <div class="footer">
        © 2026 skin_care_center.com | All Rights Reserved.
    </div>

    <!-- Bootstrap Bundle with Popper Component -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>