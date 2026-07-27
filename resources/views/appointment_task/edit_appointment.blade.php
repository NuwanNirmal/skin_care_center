<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appointment - Skin care center</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; margin: 0; padding-bottom: 60px; }
        .navbar { background-color: #137420; padding: 15px 20px; color: white; display: flex; justify-content: space-between; }
        .container { display: flex; justify-content: center; padding: 50px 20px; }
        .edit-card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 600px; }
        h2 { text-align: center; color: #137420; margin-bottom: 20px; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        .form-group { display: flex; flex-direction: column; margin-bottom: 10px; }
        label { font-size: 13px; margin-bottom: 5px; color: #666; font-weight: bold; }
        input, select, textarea { padding: 10px; border: 1px solid #ccc; border-radius: 4px; outline: none; }
        .full-width { grid-column: span 2; }
        .update-btn { background-color: #ffc107; color: black; border: none; padding: 12px; border-radius: 4px; cursor: pointer; width: 100%; font-size: 16px; font-weight: bold; margin-top: 10px; }
        .cancel-link { display: block; text-align: center; margin-top: 15px; color: #666; text-decoration: none; font-size: 14px; }
        .footer { text-align: center; padding: 15px; background: #333; color: white; font-size: 14px; position: fixed; bottom: 0; width: 100%; left: 0; }
    </style>
</head>
<body>

    <div class="navbar">
        <div class="logo">Skin care center</div>
        <div class="links">
            <a href="{{ url('/view_appointment') }}" style="color: white; text-decoration: none;">appointment list</a>
        </div>
    </div>

    <div class="container">
        <div class="edit-card">
            <h2>Edit Your Appointment</h2>

            <form action="{{ url('/update_appointment/'.$appointment->id) }}" method="POST">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="full_name" value="{{ $appointment->fullName }}" required>
                    </div>

                    <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" required>
                            <option value="Male" {{ $appointment->gender == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $appointment->gender == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Age</label>
                        <input type="number" name="age" value="{{ $appointment->age }}" required>
                    </div>

                    <div class="form-group">
                        <label>Appointment Date</label>
                        <input type="date" name="date" value="{{ $appointment->appoint_date }}" required>
                    </div>

                    <div class="form-group">
                        <label>Phone No</label>
                        <input type="text" name="phone" value="{{ $appointment->phNo }}" required>
                    </div>

                    <div class="form-group">
                        <label>Diseases</label>
                        <input type="text" name="disease" value="{{ $appointment->diseases }}">
                    </div>

                    <!-- 🔔 NEW: Appointment Time එක එඩිට් කරන්න මෙන්න මේ කොටස එකතු කළා -->
                    <div class="form-group full-width">
                        <label>Appointment Time</label>
                        <input type="text" name="appointment_time" value="{{ $appointment->appointment_time }}" placeholder="e.g., 03:00 PM" required>
                    </div>

                    <div class="form-group full-width">
                        <label>Doctor</label>
                        <select name="doctor" required>
                            <option value="Dr. Roshana" {{ $appointment->doctor_name == 'Dr. Roshana' || $appointment->doctor_name == 'Dr.Roshana' ? 'selected' : '' }}>Dr. Roshana</option>
                            <option value="Dr. Dinithi" {{ $appointment->doctor_name == 'Dr. Dinithi' ? 'selected' : '' }}>Dr. Dinithi</option>
                            <option value="Dr. Melan" {{ $appointment->doctor_name == 'Dr. Melan' ? 'selected' : '' }}>Dr. Melan</option>
                            <option value="Dr. Kasuni" {{ $appointment->doctor_name == 'Dr. Kasuni' ? 'selected' : '' }}>Dr. Kasuni</option>
                            <option value="Dr. Hasitha" {{ $appointment->doctor_name == 'Dr. Hasitha' ? 'selected' : '' }}>Dr. Hasitha</option>
                            <option value="Dr. Pasan" {{ $appointment->doctor_name == 'Dr. Pasan' || $appointment->doctor_name == 'Dr.Pasan' ? 'selected' : '' }}>Dr. Pasan</option>
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <label>Full Address</label>
                        <textarea name="address" rows="3" required>{{ $appointment->address }}</textarea>
                    </div>
                </div>

                <button type="submit" class="update-btn">UPDATE APPOINTMENT</button>
                <a href="{{ url('/view_appointment') }}" class="cancel-link">Cancel and Go Back</a>
            </form>
        </div>
    </div>

    <div class="footer">
        © 2026 skin_care_center.com | All Rights Reserved.
    </div>

</body>
</html>