<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Skin Care Center</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

    <nav class="navbar">
        <div>
            skin care center
        </div>
        
        <div class="nav-links">
            <a href="{{ url('/user_view') }}">user dashboard</a>
            <a href="{{ url('/appointment') }}">Appointment</a>
            <a href="{{ url('/view_appointment') }}">View appointment</a>
            
            <div class="user-dropdown">
                <div class="user-btn">
                    <i class="fas fa-user-circle"></i> 
                    {{ Auth::user()->full_name }} <i class="fas fa-caret-down"></i>
                </div>
                <div class="dropdown-content">
                    <a href="{{ url('/view_profile') }}">View Profile</a>
                    <a href="{{ route('password.request') }}">Change Password</a>
                    <a href="{{ url('/user_logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="profile-container">
        <div class="profile-card">
            
            <div class="profile-avatar">
                <i class="fas fa-user-circle"></i>
            </div>
            
            <h2>{{ $user->full_name }}</h2>
            <span class="profile-role">Patient / Registered User</span>

            <div class="profile-details">
                <div class="detail-group">
                    <div class="detail-label">Full Name</div>
                    <div class="detail-value">: {{ $user->full_name }}</div>
                </div>
                <div class="detail-group">
                    <div class="detail-label">Email Address</div>
                    <div class="detail-value">: {{ $user->email }}</div>
                </div>
                <div class="detail-group">
                    <div class="detail-label">Account Created</div>
                    <div class="detail-value">: {{ date('Y-m-d', strtotime($user->created_at)) }}</div>
                </div>
            </div>

            <div class="profile-actions">
                <a href="{{ url('/user_view') }}" class="btn-profile btn-back">
                    <i class="fas fa-arrow-left"></i> Back to Dashboard
                </a>
                <a href="{{ url('/edit_profile') }}" class="btn-profile btn-edit">
                    <i class="fas fa-user-edit"></i> Edit Profile
                </a>
            </div>

        </div>
    </div>

    <footer>
        &copy; {{ date('Y') }} skin_care_center.com | All Rights Reserved.
    </footer>

</body>
</html>