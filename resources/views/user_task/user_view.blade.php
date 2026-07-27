<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Skin Care Center</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .navbar-title {
            font-size: 24px;
            font-weight: bold;
            color: #ffffff;
            letter-spacing: 1px;
            cursor: default;
        }

        /* --- NEW MODERN BANNER DESIGN --- */
        .banner {
            position: relative;
            min-height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden; 
            padding: 40px 20px;
            text-align: center;
        }

        .banner::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("{{ asset('dashboard-bg.jpg') }}"); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            filter: blur(2px); 
            background-color: rgba(0, 0, 0, 0.5); 
            background-blend-mode: overlay;
            transform: scale(1.05); 
            z-index: 1;
        }

        .banner-content {
            position: relative;
            z-index: 2;
            color: white;
        }

        .banner-content h1 {
            font-size: 36px;
            margin: 0 0 10px 0;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.6);
        }

        .banner-content p {
            font-size: 18px;
            opacity: 0.9;
            margin: 0;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
        }

        .navbar i, .user-btn i {
            margin-right: 5px;
        }

        .main-wrapper {
            flex: 1;
        }

        /* --- DOCTOR SCHEDULE TIMETABLE STYLES (NOW MOVED UP) --- */
        .schedule-section {
            max-width: 1000px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .schedule-title {
            text-align: center;
            font-size: 28px;
            color: #222;
            margin-bottom: 5px;
            font-weight: 700;
        }

        .schedule-subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 15px;
        }

        .schedule-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: none;
        }

        .schedule-table th {
            background-color: #137420;
            color: white;
            text-align: left;
            padding: 15px 20px;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .schedule-table td {
            padding: 18px 20px;
            border-bottom: 1px solid #f1f1f1;
            vertical-align: middle;
        }

        .schedule-table tr:last-child td {
            border-bottom: none;
        }

        .schedule-table tr:hover {
            background-color: #fdfdfd;
        }

        .doc-name {
            font-weight: bold;
            color: #137420;
            font-size: 16px;
            display: block;
        }

        .doc-qual {
            font-size: 13px;
            color: #666;
            display: block;
            margin-top: 4px;
        }

        .slots-row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .time-box-simple {
            border: 1px solid #dcdcdc;
            color: #137420;
            padding: 6px 14px;
            font-size: 13px;
            border-radius: 20px;
            background: #f4faf5;
            font-weight: 600;
            transition: all 0.2s;
        }

        .time-box-simple:hover {
            background: #137420;
            color: white;
            border-color: #137420;
        }

        /* --- MODERN RE-DESIGNED CARDS SECTION (NOW MOVED DOWN) --- */
        .services-section {
            background-color: #ffffff;
            padding: 60px 20px;
            border-top: 1px solid #eaeaea;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            max-width: 1100px;
            margin: 0 auto;
        }

        .service-card {
            background: #fff; 
            padding: 35px 25px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            border: 1px solid #f0f0f0;
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.12);
            border-color: #137420;
        }

        .service-card .icon-box {
            width: 70px;
            height: 70px;
            background: #e8f5e9;
            color: #137420;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin: 0 auto 20px auto;
        }

        .service-card h2 {
            color: #222;
            font-size: 20px;
            margin-bottom: 20px;
            font-weight: 700;
            position: relative;
            padding-bottom: 10px;
        }

        .service-card h2::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 2px;
            background-color: #137420;
        }

        .service-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .service-list li {
            color: #555;
            font-size: 14px;
            padding: 8px 0;
            border-bottom: 1px dashed #f0f0f0;
            font-weight: 500;
        }

        .service-list li:last-child {
            border-bottom: none;
        }

        .center-card {
            background: linear-gradient(135deg, #137420 0%, #0c4e15 100%);
            color: white;
            border: none;
        }

        .center-card .icon-box {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .center-card h2 {
            color: white;
        }
        .center-card h2::after {
            background-color: white;
        }
        .center-card p {
            color: rgba(255,255,255,0.9);
            font-size: 15px;
            line-height: 1.6;
            margin-top: 15px;
        }
    </style>
</head>
<body>

    <div class="main-wrapper">
        
        <nav class="navbar">
            <div class="navbar-title">
                Skin Care Center
            </div>
            
            <div class="nav-links">
                <a href="{{ url('/appointment') }}">Appoitment</a>
                <a href="{{ url('/view_appointment') }}">View Appointment</a>
                
                <div class="user-dropdown">
                    <div class="user-btn">
                        <i class="fas fa-user-circle"></i> 
                        {{ Auth::user()->full_name }} <i class="fas fa-caret-down"></i>
                    </div>
                    <div class="dropdown-content">
                        <a href="{{ url('/view_profile') }}"><i class="fas fa-user"></i> View Profile</a>
                        <a href="{{ route('password.request') }}"><i class="fas fa-key"></i> Change Password</a>
                        <a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="banner">
            <div class="banner-content">
                <h1>Welcome to Patient Dashboard</h1>
                <p>Your Health and Skin Care, Managed Professionally</p>
            </div>
        </div>

        <div class="schedule-section">
            <h2 class="schedule-title">Doctors Availability</h2>
            <p class="schedule-subtitle">Find your specialist and check their available treatment times</p>

            <table class="schedule-table">
                <thead>
                    <tr>
                        <th style="width: 45%;">Doctor Name & Qualification</th>
                        <th style="width: 55%;">Available Time Slots</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <span class="doc-name">Dr. Melan Silva</span>
                            <span class="doc-qual">MBBS, Diploma in Skin Care</span>
                        </td>
                        <td>
                            <div class="slots-row">
                                <div class="time-box-simple">09:00 AM</div>
                                <div class="time-box-simple">10:00 AM</div>
                                <div class="time-box-simple">11:00 AM</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="doc-name">Dr. Kasuni Fernando</span>
                            <span class="doc-qual">MBBS, MD (Dermatology)</span>
                        </td>
                        <td>
                            <div class="slots-row">
                                <div class="time-box-simple">11:00 AM</div>
                                <div class="time-box-simple">12:00 PM</div>
                                <div class="time-box-simple">01:00 PM</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="doc-name">Dr. Hasitha Rathnayake</span>
                            <span class="doc-qual">MBBS, MS (Plastic Surgery)</span>
                        </td>
                        <td>
                            <div class="slots-row">
                                <div class="time-box-simple">01:00 PM</div>
                                <div class="time-box-simple">02:00 PM</div>
                                <div class="time-box-simple">03:00 PM</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="doc-name">Dr. Pasan Gunawardena</span>
                            <span class="doc-qual">MBBS, Dip. in Laser Surgery</span>
                        </td>
                        <td>
                            <div class="slots-row">
                                <div class="time-box-simple">03:00 PM</div>
                                <div class="time-box-simple">04:00 PM</div>
                                <div class="time-box-simple">05:00 PM</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="doc-name">Dr. Roshana Wickramage</span>
                            <span class="doc-qual">MBBS, MD (Pediatrics)</span>
                        </td>
                        <td>
                            <div class="slots-row">
                                <div class="time-box-simple">04:00 PM</div>
                                <div class="time-box-simple">05:00 PM</div>
                                <div class="time-box-simple">06:00 PM</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="doc-name">Dr. Dinithi Madushika</span>
                            <span class="doc-qual">MBBS Skin Care</span>
                        </td>
                        <td>
                            <div class="slots-row">
                                <div class="time-box-simple">05:00 PM</div>
                                <div class="time-box-simple">06:00 PM</div>
                                <div class="time-box-simple">07:00 PM</div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="services-section">
            <div class="welcome-section" style="text-align: center; padding-bottom: 40px;">
                <h1 style="font-size: 30px; color: #222; margin: 0;">Key Features of our Hospital</h1>
                <hr style="width: 50px; border: 2px solid #137420; margin: 10px auto;">
            </div>

            <div class="services-grid">
                
                <div class="service-card">
                    <div class="icon-box"><i class="fas fa-stethoscope"></i></div>
                    <h2>MEDICAL SERVICES</h2>
                    <ul class="service-list">
                        <li>SKIN CHECKUPS</li>
                        <li>PROFESSIONAL CARE</li>
                        <li>FIRST AID</li>
                        <li>EXPERT DOCTORS</li>
                        <li>HEALTHY SKIN</li>
                    </ul>
                </div>
                
                <div class="service-card center-card">
                    <div class="icon-box"><i class="fas fa-plus-circle"></i></div>
                    <h2>SKIN CARE EXCELLENCE</h2>
                    <p>Providing professional and personalized skin care services with our expert medical team. We ensure your skin stays healthy, glowing, and safe 24/7.</p>
                </div>
                
                <div class="service-card">
                    <div class="icon-box"><i class="fas fa-user-md"></i></div>
                    <h2>DERMATOLOGY</h2>
                    <ul class="service-list">
                        <li>CLINICAL CARE</li>
                        <li>ALLERGY TREATMENTS</li>
                        <li>LASER SURGERY</li>
                        <li>NURSING SUPPORT</li>
                        <li>24/7 ASSISTANCE</li>
                    </ul>
                </div>

            </div>
        </div>

    </div>

    <div class="footer" style="width: 100%; text-align: center; padding: 15px 0; background: #247940; color: #fff;">
        © 2026 skin_care_center.com | All Rights Reserved.
    </div>

</body>
</html>