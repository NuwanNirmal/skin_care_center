<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Skin Care Center</title>
    
    <!-- Bootstrap 5 & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    
    <style>
        :root {
            --primary-green: #137420;
            --dark-green: #0e5417;
            --light-bg: #f8f9fa;
            --sidebar-width: 260px;
        }

        html, body { 
            height: 100%; 
            margin: 0; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
        }

        /* Layout Structure */
        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
            min-height: 100vh;
        }

        /* Sidebar Styling */
        #sidebar {
            min-width: var(--sidebar-width);
            max-width: var(--sidebar-width);
            background: #1a1a1a;
            color: #fff;
            transition: all 0.3s;
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background: var(--primary-green);
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        #sidebar ul.components {
            padding: 20px 0;
        }

        #sidebar ul li a {
            padding: 12px 20px;
            font-size: 1.1em;
            display: block;
            color: #bbb;
            text-decoration: none;
            transition: all 0.3s;
        }

        #sidebar ul li a:hover, #sidebar ul li.active > a {
            color: #fff;
            background: rgba(19, 116, 32, 0.2);
            border-left: 4px solid var(--primary-green);
        }

        #sidebar ul li a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Content Area */
        #content {
            width: 100%;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar { 
            background: #ffffff; 
            padding: 15px 30px; 
            box-shadow: 0 2px 4px rgba(0,0,0,0.08);
        }

        .main-content { 
            flex: 1; 
            padding: 30px; 
        }

        /* Modernized Dashboard Cards */
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.04);
            transition: transform 0.2s, box-shadow 0.2s;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }

        .stat-card .icon-box {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        /* Custom Alert styling */
        .alert-custom {
            background-color: #d4edda;
            border-left: 5px solid #28a745;
            color: #155724;
            border-radius: 4px;
        }

        /* Footer */
        .footer {
            background: #166d2c;
            padding: 15px;
            color: #f7fafc;
            border-top: 1px solid #dee2e6;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="wrapper">
        <!-- Sidebar Navigation -->
        <nav id="sidebar">
            <div class="sidebar-header text-center">
                Skin Care Center
            </div>
            <ul class="list-unstyled components">
                <li class="active">
                    <a href="{{ url('/admin_dashboard') }}"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
                </li>
                <li>
                    <a href="{{ url('/add_doctor') }}"><i class="fa-solid fa-user-plus"></i> Add Doctor</a>
                </li>
                <li>
                    <a href="{{ url('/view_doctor') }}"><i class="fa-solid fa-user-doctor"></i> View Doctors</a>
                </li>
                <li>
                    <a href="{{ url('/view_patient') }}"><i class="fa-solid fa-hospital-user"></i> Patient Details</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content Area -->
        <div id="content">
            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid justify-content-end">
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle border" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user-gear me-2 text-success"></i>Admin
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li>
                                <a class="dropdown-item text-danger" href="{{ url('/admin_logout') }}">
                                    <i class="fa-solid fa-right-from-bracket me-2"></i>Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Main Dynamic Content -->
            <div class="main-content">
                <div class="container-fluid">
                    
                    @if(session('success')) 
                        <div class="alert alert-custom alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="dismiss" aria-label="Close"></button>
                        </div> 
                    @endif
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="fw-bold text-dark">Admin Dashboard</h2>
                        <span class="text-muted"><i class="fa-regular fa-calendar me-1"></i> Today: {{ date('Y-m-d') }}</span>
                    </div>
                    
                    <!-- Dashboard Statistics Grid -->
                    <div class="row g-4">
                        <!-- Doctors Card -->
                        <div class="col-12 col-sm-6 col-xl-3">
                            <div class="stat-card">
                                <div>
                                    <p class="text-muted mb-1 fw-semibold">Total Doctors</p>
                                    <h3 class="fw-bold mb-0 text-dark">{{ $doctorCount }}</h3>
                                </div>
                                <div class="icon-box bg-success-subtle text-success">
                                    <i class="fa-solid fa-user-doctor"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Users Card -->
                        <div class="col-12 col-sm-6 col-xl-3">
                            <div class="stat-card">
                                <div>
                                    <p class="text-muted mb-1 fw-semibold">Total Users</p>
                                    <h3 class="fw-bold mb-0 text-dark">{{ $userCount }}</h3>
                                </div>
                                <div class="icon-box bg-primary-subtle text-primary">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Appointments Card -->
                        <div class="col-12 col-sm-6 col-xl-3">
                            <div class="stat-card">
                                <div>
                                    <p class="text-muted mb-1 fw-semibold">Appointments</p>
                                    <h3 class="fw-bold mb-0 text-dark">{{ $appointmentCount }}</h3>
                                </div>
                                <div class="icon-box bg-warning-subtle text-warning">
                                    <i class="fa-regular fa-calendar-check"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Specialists Card -->
                        <div class="col-12 col-sm-6 col-xl-3">
                            <div class="stat-card">
                                <div>
                                    <p class="text-muted mb-1 fw-semibold">Specialists</p>
                                    <h3 class="fw-bold mb-0 text-dark">{{ $specialistCount }}</h3>
                                </div>
                                <div class="icon-box bg-danger-subtle text-danger">
                                    <i class="fa-solid fa-stethoscope"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Modernized Footer -->
            <div class="footer text-center">
                &copy; {{ date('Y') }} <strong>skin_care_center.com</strong> | All Rights Reserved.
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>