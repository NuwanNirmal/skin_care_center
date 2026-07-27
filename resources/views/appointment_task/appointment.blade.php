<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Appointment - Skin Care Center</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; margin: 0; padding-bottom: 60px; }
        
        .navbar { background-color: #137420; padding: 10px 20px; color: white; display: flex; justify-content: space-between; }
        .navbar a { color: white; text-decoration: none; margin-left: 15px; font-size: 14px; }
        .logo a { font-weight: bold; font-size: 18px; }

        /* 🎨 Container එකේ padding අඩු කර උස පාලනය කිරීම */
        .container { display: flex; align-items: stretch; justify-content: center; padding: 20px 20px; gap: 0px; flex-wrap: wrap; }
        
        /* 🖼️ පින්තූරය Form එකේ උසටම ගැලපෙන ලෙස සකස් කිරීම */
        .doctor-img-wrapper { display: flex; width: 100%; max-width: 350px; }
        .doctor-img { width: 100%; height: 100%; object-fit: cover; border-radius: 8px 0 0 8px; box-shadow: -4px 4px 15px rgba(0,0,0,0.05); }

        /* 📝 Form එක වඩාත් සංයුක්ත (Compact) කර උස ගොඩක් අඩු කිරීම */
        .appointment-card { background: white; padding: 15px 25px; border-radius: 0 8px 8px 0; box-shadow: 4px 4px 15px rgba(0,0,0,0.05); width: 100%; max-width: 480px; display: flex; flex-direction: column; justify-content: center; }
        .appointment-card h2 { text-align: center; color: #137420; margin-top: 0; margin-bottom: 2px; font-weight: bold; font-size: 20px; }
        .appointment-p { text-align: center; color: #666; font-size: 11px; margin-bottom: 12px; margin-top: 0; }

        /* Row gap සහ Column gap අඩු කිරීම */
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px 12px; }
        .form-group { display: flex; flex-direction: column; margin-bottom: 0px; }
        .form-group label { font-size: 11px; margin-bottom: 3px; color: #444; font-weight: bold; }
        
        /* Input fields වල padding අඩු කර උස කැපීම */
        .form-group input, .form-group select { padding: 6px 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 12px; outline: none; background-color: #fff; height: 32px; box-sizing: border-box; }
        .form-group input:focus, .form-group select:focus { border-color: #137420; }
        
        .full-width { grid-column: span 2; }
        
        /* Button එකේ padding අඩු කිරීම */
        .submit-btn { background-color: #137420; color: white; border: none; padding: 8px; border-radius: 4px; cursor: pointer; width: 100%; font-size: 14px; margin-top: 8px; font-weight: bold; transition: 0.3s; height: 36px; }
        .submit-btn:hover { background-color: #0e5a18; }

        .alert { padding: 6px; border-radius: 4px; margin-bottom: 10px; text-align: center; font-size: 12px; font-weight: bold; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .error-text { color: #dc3545; font-size: 10px; margin-top: 1px; }

        footer { text-align: center; padding: 10px; background-color: #137420; color: white; position: fixed; bottom: 0; width: 100%; font-size: 11px; z-index: 10; }

        @media (max-width: 768px) {
            .doctor-img-wrapper { max-width: 100%; display: none; } /* Mobile වලදී පින්තූරය hide කලේ ඉඩ ඉතුරු කරගන්න */
            .appointment-card { border-radius: 8px; max-width: 100%; padding: 15px; }
        }
    </style>
</head>
<body>

    <div class="navbar">
        <div class="logo"><a href="/">Skin care center</a></div>
        <div class="links">
            <a href="{{ url('/user_view') }}">Home</a>
            <a href="{{ url('/view_appointment') }}">View appointment</a>
            <a href="#"> {{ Auth::user()->full_name ?? 'User' }}</a>
        </div>
    </div>

    <div class="container">
        <div class="doctor-img-wrapper">
            <img src="{{ asset('appointmentt.jpg') }}" alt="Doctors" class="doctor-img">
        </div>

        <div class="appointment-card">
            <h2>Book Your Appointment</h2>
            <p class="appointment-p">Please fill in the details to schedule your clinical session</p>
            
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ url('/save_appointment') }}" method="POST">
                @csrf 
                
                <div class="form-grid">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="full_name" value="{{ Auth::user()->full_name }}" required>
                        @error('full_name') <span class="error-text">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" required>
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Age</label>
                        <input type="number" name="age" value="{{ old('age') }}" placeholder="Enter Age" required>
                    </div>

                    <div class="form-group">
                        <label>Appointment Date</label>
                        <input type="date" name="date" value="{{ old('date') }}" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ Auth::user()->email }}" required>
                    </div>

                    <div class="form-group">
                        <label>Phone No</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Enter Phone No" required>
                    </div>

                    <div class="form-group">
                        <label>Doctor</label>
                        <select name="doctor" required>
                            <option value="">-- Select Doctor --</option>
                            <option value="Dr. Roshana" {{ old('doctor') == 'Dr. Roshana' ? 'selected' : '' }}>Dr. Roshana</option>
                            <option value="Dr. Dinithi" {{ old('doctor') == 'Dr. Dinithi' ? 'selected' : '' }}>Dr. Dinithi</option>
                            <option value="Dr. Melan" {{ old('doctor') == 'Dr. Melan' ? 'selected' : '' }}>Dr. Melan</option>
                            <option value="Dr. Kasuni" {{ old('doctor') == 'Dr. Kasuni' ? 'selected' : '' }}>Dr. Kasuni</option>
                            <option value="Dr. Hasitha" {{ old('doctor') == 'Dr. Hasitha' ? 'selected' : '' }}>Dr. Hasitha</option>
                            <option value="Dr. Pasan" {{ old('doctor') == 'Dr. Pasan' ? 'selected' : '' }}>Dr. Pasan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Preferred Time Slot</label>
                        <select name="appointment_time" required>
                            <option value="">-- Select Time Slot --</option>
                            <option value="09:00 AM" {{ old('appointment_time') == '09:00 AM' ? 'selected' : '' }}>09:00 AM - 10:00 AM</option>
                            <option value="11:00 AM" {{ old('appointment_time') == '11:00 AM' ? 'selected' : '' }}>11:00 AM - 12:00 PM</option>
                            <option value="01:00 PM" {{ old('appointment_time') == '01:00 PM' ? 'selected' : '' }}>01:00 PM - 02:00 PM</option>
                            <option value="03:00 PM" {{ old('appointment_time') == '03:00 PM' ? 'selected' : '' }}>03:00 PM - 04:00 PM</option>
                            <option value="05:00 PM" {{ old('appointment_time') == '05:00 PM' ? 'selected' : '' }}>05:00 PM - 06:00 PM</option>
                            <option value="06:00 PM" {{ old('appointment_time') == '06:00 PM' ? 'selected' : '' }}>06:00 PM - 07:00 PM</option>
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <label>Diseases</label>
                        <input type="text" name="disease" value="{{ old('disease') }}" placeholder="Enter Disease / Symptoms (Optional)">
                    </div>

                    <!-- ⏱️ Full Address එකට Textarea වෙනුවට සාමාන්‍ය Input එකක් දැම්මා උස අඩු කරන්න -->
                    <div class="form-group full-width">
                        <label>Full Address</label>
                        <input type="text" name="address" value="{{ old('address') }}" placeholder="Enter Address" required>
                    </div>
                </div>
                
                <button type="submit" class="submit-btn">Submit Appointment</button>
            </form>
        </div>
    </div>

    <footer>
        &copy; {{ date('Y') }} Skin Care Center | All Rights Reserved.
    </footer>

</body>
</html>