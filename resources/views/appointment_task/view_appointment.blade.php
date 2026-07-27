<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appointment List - skin care center</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; margin: 0; padding-bottom: 60px; }
        .navbar { background-color: #137420; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; color: white; }
        .container { padding: 40px 20px; display: flex; gap: 20px; align-items: flex-start; flex-wrap: wrap; }
        .table-card { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); flex: 2; min-width: 600px; overflow-x: auto; }
        h2 { color: #137420; text-align: center; margin-bottom: 25px; border-bottom: 2px solid #eee; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th { background-color: #f8f9fa; padding: 12px; border-bottom: 2px solid #137420; font-size: 13px; text-align: left; color: #333; font-weight: bold; }
        td { padding: 12px; border-bottom: 1px solid #eee; font-size: 13px; color: #555; }
        
        /* Highlight Badges */
        .badge-no { background-color: #e8f5e9; color: #137420; padding: 4px 8px; border-radius: 4px; font-weight: bold; }
        .badge-time { background-color: #fff3cd; color: #856404; padding: 4px 8px; border-radius: 4px; font-weight: bold; font-size: 12px; border: 1px solid #ffeeba; }
        
        .btn-edit { background-color: #ffc107; color: black; padding: 6px 12px; text-decoration: none; border-radius: 4px; font-weight: bold; font-size: 11px; transition: 0.3s; margin-right: 5px; display: inline-block; }
        .btn-edit:hover { background-color: #e0a800; }
        
        .btn-delete { background-color: #dc3545; color: white; padding: 6px 12px; text-decoration: none; border-radius: 4px; font-weight: bold; font-size: 11px; transition: 0.3s; display: inline-block; }
        .btn-delete:hover { background-color: #c82333; }
        
        .doctor-img { width: 100%; max-width: 280px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }

        footer { text-align: center; padding: 15px; background-color: #137420; color: white; position: fixed; bottom: 0; width: 100%; font-size: 12px; z-index: 10; }
    </style>
</head>
<body>

    <div class="navbar">
        <div class="logo" style="font-weight: bold; font-size: 18px;">Skin care center</div>
        <div class="links">
            <a href="{{ url('/user_view') }}" style="color:white; text-decoration:none; margin-right:15px;">Home</a>
            <a href="{{ url('/appointment') }}" style="color:white; text-decoration:none; margin-right:15px;">Appointment</a>
            <a href="{{ url('/view_appointment') }}" style="color:white; text-decoration:none; font-weight: bold;">View appointment</a>
        </div>
    </div>

    <div class="container">
        <div class="table-card">
            <h2>Appointment List</h2>
            
            @if(session('success'))
                <div style="background:#d4edda; color:#155724; padding:10px; border-radius:5px; margin-bottom:15px; text-align:center; font-weight: bold; font-size: 14px;">
                    {{ session('success') }}
                </div>
            @endif

            <table>
                <thead>
                    <tr>
                        <th>App. No</th> <!-- අලුත් Column එක -->
                        <th>Full Name</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Appoint Date</th>
                        <th>Preferred Time</th> <!-- අලුත් Column එක -->
                        <th>Phone No</th>
                        <th>Diseases</th>
                        <th>Doctor Name</th>
                        <th>Status</th>
                        <th style="min-width: 140px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $app)
                    <tr>
                        <!-- 1. Appointment Number එක පෙන්වන කොටස -->
                        <td>
                            <span class="badge-no">#{{ $app->appointment_no ?? 'N/A' }}</span>
                        </td>
                        
                        <td>{{ $app->fullName }}</td>
                        <td>{{ $app->gender }}</td>
                        <td>{{ $app->age }}</td>
                        <td>{{ $app->appoint_date }}</td>
                        
                        <!-- 2. Appointment Time එක පෙන්වන කොටස -->
                        <td>
                            <span class="badge-time">{{ $app->appointment_time ?? 'Not Set' }}</span>
                        </td>
                        
                        <td>{{ $app->phNo }}</td>
                        <td>{{ $app->diseases }}</td>
                        <td>{{ $app->doctor_name }}</td>
                        <td style="color: green; font-weight:bold;">{{ $app->status }}</td>
                        <td>
                            <a href="{{ url('/edit_appointment/'.$app->id) }}" class="btn-edit">EDIT</a>
                            <a href="{{ url('/delete_appointment/'.$app->id) }}" class="btn-delete" onclick="return confirm('Do you want to delete this appointment?')">DELETE</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <img src="{{ asset('viewAppointment.jpg') }}" class="doctor-img" alt="Doctors">
    </div>

    <footer>
        &copy; {{ date('Y') }} Skin Care Center | All Rights Reserved.
    </footer>

</body>
</html>