<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skin Care Center</title>
    
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

    
    <div class="navbar">
        <div class="logo"><b>Skin Care Center</b></div>
        <div class="links">
            
            
            <a href="{{ url('/admin_login') }}">Admin</a>
            <a href="{{ url('/doctor_login') }}">Doctor</a>
            <a href="javascript:void(0);" onclick="checkLogin()">Appointment</a>
            <a href="{{ url('/user_login') }}">User</a>

        </div>
    </div>

    
    <div class="banner-image-only">
        <img src="{{ asset('banner.jpg') }}" alt="Hospital Banner" style="width: 100%; height: auto; display: block;">
    </div>

    
    <div class="features-heading" style="text-align: center; padding: 40px 0 20px 0;">
        <h1 style="font-size: 32px; color: #333; font-weight: normal;">Key Features of our Hospital</h1>
    </div>

    
    <div class="features-container" style="padding: 0 40px 60px 40px;">
        <div class="hero-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; max-width: 1200px; margin: 0 auto;">
            
            <div class="hero-card" style="background: #fff; padding: 25px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); text-align: left; border-radius: 4px;">
                <h2 style="color: #333; font-size: 20px; margin-top: 0;">Medical Services</h2>
                <p style="color: #666; font-size: 14px; line-height: 1.6;">Skin health checkups and professional treatments.</p>
            </div>
            
            <div class="hero-card" style="background: #fff; padding: 25px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); text-align: left; border-radius: 4px;">
                <h2 style="color: #333; font-size: 20px; margin-top: 0;">Healthcare Professionals</h2>
                <p style="color: #666; font-size: 14px; line-height: 1.6;">Our experts ensure the best treatment for your skin health.</p>
            </div>
            
            <div class="hero-card" style="background: #fff; padding: 25px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); text-align: left; border-radius: 4px;">
                <h2 style="color: #333; font-size: 20px; margin-top: 0;">Emergency Care</h2>
                <p style="color: #666; font-size: 14px; line-height: 1.6;">Quick treatment for skin allergies and sudden issues.</p>
            </div>
            
            <div class="hero-card" style="background: #fff; padding: 25px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); text-align: left; border-radius: 4px;">
                <h2 style="color: #333; font-size: 20px; margin-top: 0;">Specialties</h2>
                <p style="color: #666; font-size: 14px; line-height: 1.6;">Acne, pigmentation, and laser treatments.</p>
            </div>
            
        </div>
    </div>

    
    <div class="team" style="padding: 40px 20px; background-color: #ffffff;">
        <h2 style="text-align: center; font-size: 28px; margin-bottom: 30px; color: #222;">Our Team</h2>
        
        <div class="team-grid" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px;">
            <div class="member" style="text-align: center; width: 150px;">
                <img src="{{ asset('dinithi.jpg') }}" alt="Dr. Dinithi" style="width:120px; height:120px; border-radius:50%; object-fit: cover;">
                <p style="margin: 10px 0 0 0; font-weight: bold;">Dr. Dinithi</p>
                <span style="font-size: 12px; color: #777;">Chief Doctor</span>
            </div>
            <div class="member" style="text-align: center; width: 150px;">
                <img src="{{ asset('melann.jpeg') }}" alt="Dr. Melan" style="width:120px; height:120px; border-radius:50%; object-fit: cover;">
                <p style="margin: 10px 0 0 0; font-weight: bold;">Dr. Melan</p>
                <span style="font-size: 12px; color: #777;">Chief Doctor</span>
            </div>
            <div class="member" style="text-align: center; width: 150px;">
                <img src="{{ asset('kasuni.jpeg') }}" alt="Dr. Kasuni" style="width:120px; height:120px; border-radius:50%; object-fit: cover;">
                <p style="margin: 10px 0 0 0; font-weight: bold;">Dr. Kasuni</p>
                <span style="font-size: 12px; color: #777;">Chief Doctor</span>
            </div>
            <div class="member" style="text-align: center; width: 150px;">
                <img src="{{ asset('hasitha.jpeg') }}" alt="Dr. Hasitha" style="width:120px; height:120px; border-radius:50%; object-fit: cover;">
                <p style="margin: 10px 0 0 0; font-weight: bold;">Dr. Hasitha</p>
                <span style="font-size: 12px; color: #777;">Chief Doctor</span>
            </div>
            <div class="member" style="text-align: center; width: 150px;">
                <img src="{{ asset('pasan.jpeg') }}" alt="Dr. Pasan" style="width:120px; height:120px; border-radius:50%; object-fit: cover;">
                <p style="margin: 10px 0 0 0; font-weight: bold;">Dr. Pasan</p>
                <span style="font-size: 12px; color: #777;">Chief Doctor</span>
            </div>
            <div class="member" style="text-align: center; width: 150px;">
                <img src="{{ asset('roshana.jpeg') }}" alt="Dr. Roshana" style="width:120px; height:120px; border-radius:50%; object-fit: cover;">
                <p style="margin: 10px 0 0 0; font-weight: bold;">Dr. Roshana</p>
                <span style="font-size: 12px; color: #777;">Chief Doctor</span>
            </div>
        </div>
    </div>

    
    <div class="footer">
        © 2026 skin_care_center.com | All Rights Reserved.
    </div>

    
    <script>
        function checkLogin() {
            alert("You must register in the system before making appointment.");
            window.location.href = "{{ url('/user_login') }}";
        }
    </script>

</body>
</html>