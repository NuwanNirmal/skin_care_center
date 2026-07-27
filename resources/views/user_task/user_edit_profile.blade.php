<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Skin Care Center</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        .main-container {
            flex: 1; 
        }
        .navbar-title {
            font-size: 24px;
            font-weight: bold;
            color: #ffffff; 
            text-decoration: none;
            cursor: default; 
        }
        
    
        .logout-link {
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin-left: 20px;
            text-decoration: none;
        }
        .logout-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    
    <nav class="navbar">
        <span class="navbar-title">Skin Care Center</span>
        
        <div class="nav-links" style="display: flex; align-items: center;">
            <a href="{{ url('/user_view') }}">Home</a>
            <a href="{{ url('/view_profile') }}" class="active">My Profile</a>
            
            
            <a href="{{ route('logout') }}" class="logout-link">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </nav>

    
    <div class="main-container">
        <div class="edit-card">
            <h2>Edit Profile</h2>
            
            
            @if(session('success'))
                <div style="background-color: #d4edda; color: #155724; padding: 12px; margin-bottom: 20px; border-radius: 5px; border: 1px solid #c3e6cb; text-align: center; font-weight: bold;">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div style="background-color: #f8d7da; color: #721c24; padding: 12px; margin-bottom: 20px; border-radius: 5px; border: 1px solid #f5c6cb; text-align: center; font-weight: bold;">
                    {{ session('error') }}
                </div>
            @endif
            
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                
                <label>Full Name</label>
                <input type="text" name="full_name" value="{{ $user->full_name }}" required>
                
                <label>Email Address</label>
                <input type="email" name="email" value="{{ $user->email }}" required>
                
                
                <button type="submit" class="btn-update">Update Profile</button>
            </form>
            
            <a href="{{ url('/view_profile') }}" class="back-link">Cancel & Go Back</a>
        </div>
    </div>

    
    <footer style="margin-top: auto; width: 100%;">
        <p>&copy; {{ date('Y') }} <span>Skin Care Center</span>. All Rights Reserved.</p>
    </footer>

</body>
</html>