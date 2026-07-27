<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
use Carbon\Carbon;

class UserController extends Controller
{
    // Checking the admin login (password and email)
    public function adminLoginCheck(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $admin = DB::table('admin')->where('email', trim($request->email))->first(); 

        if ($admin && $request->password === $admin->password) {
            session(['admin_logged_in' => true, 'admin_email' => $admin->email]);
            return redirect('/admin_dashboard')->with('success', 'Welcome Admin!');
        }

        return back()->with('error', 'wrong your email or password!');
    }

    // Displays the Admin Dashboard view with statistics counts
    public function adminDashboard()
    {
        if (!session('admin_logged_in')) {
            return redirect('/admin_login')->with('error', 'please first log in to the system.');
        }

        // Finding the count for the admin dashboard cards
        $doctorCount = DB::table('doctor')->count();
        $userCount = DB::table('users')->count();
        $appointmentCount = DB::table('appointment')->count();
        $specialistCount = DB::table('doctor')->distinct('specialist')->count('specialist');

        return view('Admin_task.admin_dashbord', compact('doctorCount', 'userCount', 'appointmentCount', 'specialistCount'));
    }

    // Handles the admin logout workflow
    public function adminLogout(Request $request)
    {
        $request->session()->forget(['admin_logged_in', 'admin_email']);
        return redirect('/admin_login')->with('success', 'Admin logout sucsses!');
    }

    // Admin - Doctor Management (Saves new doctor record)
    public function saveDoctor(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'dob' => 'required|date',
            'qualification' => 'required',
            'specialist' => 'required',
            'email' => 'required|email|unique:doctor,email',
            'mobile' => 'required',
            'password' => 'required',
        ]);
               
        // Add a new row to the doctor table
        DB::table('doctor')->insert([
            'full_name'     => $request->full_name,
            'dob'           => $request->dob,
            'qualification' => $request->qualification,
            'specialist'    => $request->specialist,
            'email'         => trim($request->email),
            'mobNo'         => $request->mobile, 
            'password'      => trim($request->password),
        ]);

        return redirect('/view_doctor')->with('success', 'Doctor Added Successfully!');
    }

    // Show all doctors list to the admin
    public function viewDoctors()
    {
        $doctors = DB::table('doctor')->get();
        return view('Admin_task.view_doctor', compact('doctors'));
    }

    // Show the old profile data before updating it
    public function editDoctor($id)
    {
        $doctor = DB::table('doctor')->where('id', $id)->first();
        return view('Admin_task.admin_edit_doctor', compact('doctor'));
    }

    // Check data validity and perform doctor information update
    public function updateDoctor(Request $request)
    {
        $request->validate([
            'id'            => 'required', 
            'full_name'     => 'required',
            'dob'           => 'required|date',
            'qualification' => 'required',
            'specialist'    => 'required',
            'email'         => 'required|email|unique:doctor,email,' . $request->id,
            'mobile'        => 'required',
            'password'      => 'required', 
        ]);

        // Change the new data in DB and update form
        DB::table('doctor')->where('id', $request->id)->update([
            'full_name'     => $request->full_name,
            'dob'           => $request->dob,
            'qualification' => $request->qualification,
            'specialist'    => $request->specialist,
            'email'         => trim($request->email),
            'mobNo'         => $request->mobile,
            'password'      => trim($request->password), 
        ]);

        return redirect('/view_doctor')->with('success', 'Doctor Updated Successfully!');
    }

    // Admin action to delete a doctor from the system
    public function deleteDoctor($id)
    {
        DB::table('doctor')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Doctor Deleted Successfully!');
    }


    // --- ADMIN - PATIENT APPOINTMENT REPORT & FILTER MANAGEMENT ---

    // Admin Controller action to filter and view patient appointments list (Today vs Past History)
    public function adminViewPatients(Request $request)
    {
        if (!session('admin_logged_in')) {
            return redirect('/admin_login')->with('error', 'please first log in to the system.');
        }

        // Get the current application date dynamically using Carbon
        $todayDate = Carbon::today()->toDateString();

        if ($request->query('filter') == 'history') {
            // Fetch past appointments (older than today)
            $appointments = DB::table('appointment')
                                ->whereDate('appoint_date', '<', $todayDate)
                                ->orderBy('appoint_date', 'desc')
                                ->get();
        } else {
            // Uses whereDate to isolate exact matching calendar dates for today's data
            $appointments = DB::table('appointment')
                                ->whereDate('appoint_date', '=', $todayDate)
                                ->orderBy('id', 'desc')
                                ->get();
        }

        return view('Admin_task.view_patient', compact('appointments'));
    }

    // Admin action to delete all appointments scheduled for the current date
    public function clearTodayAppointments()
    {
        if (!session('admin_logged_in')) {
            return redirect('/admin_login')->with('error', 'please first log in to the system.');
        }

        $todayDate = Carbon::today()->toDateString();

        // Safely purge rows matching today's structured date component
        DB::table('appointment')->whereDate('appoint_date', '=', $todayDate)->delete();

        return redirect()->back()->with('success', 'All of today\'s appointments have been completely cleared!');
    }


    // --- USER AUTHENTICATION & REGISTRATION ---

    // Registers a new user account profile
    public function registerSave(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
        ]);

        // Send the user details to users table
        DB::table('users')->insert([
            'full_name' => $request->full_name,
            'email' => trim($request->email),
            'password' => trim($request->password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/user_login')->with('success', 'Registration Successful! Please Login.');
    }

    // Verifies user credentials during standard member login
    public function loginCheck(Request $request)
    {
        $request->validate([
            'email' => 'required|email', 
            'password' => 'required'
        ]);
        
        // Match the email and password in the user table
        $user = DB::table('users')
                    ->where('email', trim($request->email))
                    ->where('password', trim($request->password))
                    ->first();
        
        // If matching user is found, login using id session setup
        if ($user) {
            Auth::loginUsingId($user->id);
            $request->session()->regenerate();
            return redirect('/user_view')->with('success', 'Welcome Back!');
        }
        
        return back()->with('error', 'Login Failed. wrong your email or password!');
    }


    // --- DOCTOR FLOW (FIXED & TRIMMING LOGIC REMOVED) ---

    // Verifies credentials for the specialized Doctor portal login
    public function doctorLoginCheck(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $email = trim($request->email);
        $password = trim($request->password);

        // සරලව සහ ඍජුවම ඊමේල් සහ පාස්වර්ඩ් එක මැච් කර බැලීම (සියලුම දොස්තරලාට ලොග් විය හැක)
        $doctor = DB::table('doctor')
                    ->where('email', $email)
                    ->where('password', $password)
                    ->first();
        
        if ($doctor) {
            session([
                'doctor_logged_in' => true, 
                'doctor_id'        => $doctor->id, 
                'doctor_name'      => $doctor->full_name // ඩේටාබේස් එකේ තියෙන නම ඒ විදිහටම සෙෂන් එකට දේ
            ]);
            return redirect('/doctor_dashboard')->with('success', 'Successfully logged in!');
        }
        
        return back()->with('error', 'Wrong doctor details! Check your email and password.');
    }

    // Loads dashboard statistics and personalized appointment lists for doctor
    public function doctorDashboard()
    {
        if (!session('doctor_logged_in')) {
            return redirect('/doctor_login');
        }
        
        $doctorName = session('doctor_name'); 
          
        // එඩිට් කළා: නමේ කොටසක් හෝ ගැලපේ නම් (LIKE Query මඟින්) ඇපොයින්ට්මන්ට්ස් ලබාගැනීම
        $appointments = Appointment::where('doctor_name', 'LIKE', '%' . $doctorName . '%')
                                    ->orWhere(function($query) use ($doctorName) {
                                        $query->whereRaw('? LIKE CONCAT("%", doctor_name, "%")', [$doctorName]);
                                    })
                                    ->orderBy('id', 'desc')
                                    ->get(); 
        
        $allDoctorsCount = DB::table('doctor')->count();
        
        return view('doctor_task.doctor_dashbord', compact('appointments', 'allDoctorsCount'));
    }
 
    // Filter out patient data lists assigned specifically to this doctor
    public function doctorViewPatients()
    {
        if (!session('doctor_logged_in')) {
            return redirect('/doctor_login');
        }
        
        $doctorName = session('doctor_name');

        // එඩිට් කළා: නමේ කොටසක් හෝ ගැලපේ නම් (LIKE Query මඟින්) ඇපොයින්ට්මන්ට්ස් ලබාගැනීම
        $appointments = Appointment::where('doctor_name', 'LIKE', '%' . $doctorName . '%')
                                    ->orWhere(function($query) use ($doctorName) {
                                        $query->whereRaw('? LIKE CONCAT("%", doctor_name, "%")', [$doctorName]);
                                    })
                                    ->orderBy('id', 'desc')
                                    ->get(); 
        
        return view('doctor_task.doctor_view_patient', compact('appointments'));
    }

    // Standard session clear logout process for doctor account
    public function doctorLogout(Request $request)
    {
        $request->session()->forget(['doctor_logged_in', 'doctor_id', 'doctor_name']);
        return redirect('/doctor_login')->with('success', 'Doctor log out success!');
    }

    // Fetch and display active doctor profile interface data
    public function showDoctorProfile()
    {
        if (!session('doctor_logged_in')) {
            return redirect('/doctor_login');
        }
    
        $doctor = DB::table('doctor')->where('id', session('doctor_id'))->first();
        return view('doctor_task.doctor_view_profile', compact('doctor'));
    }

    // Show the profile modifier form layout for specific doctor account
    public function editDoctorProfile()
    {
        if (!session('doctor_logged_in')) {
            return redirect('/doctor_login');
        }

        $doctor = DB::table('doctor')->where('id', session('doctor_id'))->first();
        return view('doctor_task.doctor_edit_profile', compact('doctor'));
    }

    // Process profile submission modifications for doctor entities
    public function updateDoctorProfile(Request $request)
    {
        if (!session('doctor_logged_in')) {
            return redirect('/doctor_login');
        }

        $request->validate([
            'full_name' => 'required',
            'dob' => 'required|date',
            'qualification' => 'required',
            'specialist' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'password' => 'required',
        ]);

        // Update the new data into doctor table
        DB::table('doctor')->where('id', session('doctor_id'))->update([
            'full_name'     => $request->full_name,
            'dob'           => $request->dob,
            'qualification' => $request->qualification,
            'specialist'    => $request->specialist,
            'email'         => trim($request->email),
            'mobNo'         => $request->mobile,
            'password'      => trim($request->password),
        ]);

        session(['doctor_name' => $request->full_name]);

        return redirect('/doctor_view_profile')->with('success', 'My Profile Details Updated Successfully!');
    }


    // --- 5. APPOINTMENT ACTIONS ---

    public function saveAppointment(Request $request)
    {
        $request->validate([
            'full_name' => 'required', 
            'gender' => 'required', 
            'age' => 'required|numeric', 
            'date' => 'required|date', 
            'email' => 'required|email', 
            'phone' => 'required', 
            'doctor' => 'required',
            'appointment_time' => 'required'
        ]);

        $doctorName = $request->doctor;

        // දොස්තරගේ නම නිවැරදිව ඩේටාබේස් එකෙන් තහවුරු කරගෙන ලබාගැනීම
        $docData = DB::table('doctor')
                    ->where('full_name', $doctorName)
                    ->orWhere('id', $doctorName)
                    ->first();

        if ($docData) {
            $doctorName = $docData->full_name; 
        }
        
        // AUTO GENERATE UNIQUE INTEGER APPOINTMENT NUMBER
        $lastAppointment = Appointment::orderBy('id', 'desc')->first();
        $nextId = $lastAppointment ? ($lastAppointment->id + 1) : 1;
        
        $appointmentNo = date('Y') . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        
        Appointment::create([
            'user_id' => Auth::id(), 
            'appointment_no' => $appointmentNo, 
            'fullName' => $request->full_name, 
            'gender' => $request->gender, 
            'age' => $request->age,
            'appoint_date' => $request->date, 
            'appointment_time' => $request->appointment_time, 
            'email' => $request->email, 
            'phNo' => $request->phone, 
            'diseases' => $request->disease,
            'doctor_name' => $doctorName, 
            'address' => $request->address, 
            'status' => 'Pending',
        ]);

        return redirect()->back()->with('success', 'Appointment Saved Successfully! Your App No is: ' . $appointmentNo);
    }

    public function viewAppointments() 
    { 
        $appointments = Appointment::where('user_id', Auth::id())->get();
        return view('appointment_task.view_appointment', compact('appointments')); 
    }

    public function editAppointment($id)
    {
        $appointment = Appointment::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$appointment) {
            return redirect('/view_appointment')->with('error', 'Appointment Not Found!');
        }

        return view('appointment_task.edit_appointment', compact('appointment'));
    }

    public function updateAppointment(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required',
            'gender'    => 'required',
            'age'       => 'required|numeric',
            'date'      => 'required|date',
            'phone'     => 'required',
            'doctor'    => 'required',
            'address'   => 'required',
            'appointment_time' => 'required' 
        ]);

        $doctorName = $request->doctor;
        $docData = DB::table('doctor')
                    ->where('full_name', $doctorName)
                    ->orWhere('id', $doctorName)
                    ->first();

        if ($docData) {
            $doctorName = $docData->full_name;
        }

        Appointment::where('id', $id)
            ->where('user_id', Auth::id())
            ->update([
                'fullName'     => $request->full_name,
                'gender'       => $request->gender,
                'age'          => $request->age,
                'appoint_date' => $request->date,
                'appointment_time' => $request->appointment_time, 
                'phNo'         => $request->phone,
                'diseases'     => $request->disease,
                'doctor_name'  => $doctorName, 
                'address'      => $request->address,
            ]);

        return redirect('/view_appointment')->with('success', 'Appointment Updated Successfully!');
    }

    public function deleteAppointment($id)
    {
        Appointment::where('id', $id)->where('user_id', Auth::id())->delete();
        return redirect('/view_appointment')->with('success', 'Appointment Deleted Successfully!');
    }


    // --- USER PROFILE MANAGEMENT ---

    public function showProfile() 
    { 
        return view('user_task.user_view_profile', ['user' => Auth::user()]); 
    }

    public function editUserProfile() 
    { 
        return view('user_task.user_edit_profile', ['user' => Auth::user()]); 
    }

    public function updateUserProfile(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'email'     => 'required|email',
        ]);

        DB::table('users')->where('id', Auth::id())->update([
            'full_name'  => $request->full_name,
            'email'      => trim($request->email),
            'updated_at' => now(),
        ]);

        return redirect('/view_profile')->with('success', 'Update Successful! Your profile details update successful');
    }

    public function logout(Request $request) 
    { 
        Auth::logout(); 
        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 
        return redirect('/'); 
    }

    public function updatePasswordDirect(Request $request)
    {
        $request->validate([
            'email'            => 'required|email|exists:users,email',
            'new_password'     => 'required|min:4',
            'confirm_password' => 'required|same:new_password',
        ], [
            'email.exists'          => 'this email to not registered account!',
            'confirm_password.same' => 'the two guard conditions do not match!',
        ]);

        DB::table('users')->where('email', $request->email)->update([
            'password' => trim($request->new_password)
        ]);

        return redirect('/user_login')->with('success', 'Password Updated Successfully! Please Login.');
    }


    // --- DOCTOR ACTIONS (APPROVE / REJECT) ---

    // Doctor action to approve an appointment status
    public function approveAppointment($id)
    {
        if (!session('doctor_logged_in')) {
            return redirect('/doctor_login');
        }

        DB::table('appointment')->where('id', $id)->update([
            'status' => 'Approved'
        ]);

        return redirect()->back()->with('success', 'Appointment Approved Successfully!');
    }

    // Doctor action to reject an appointment status
    public function rejectAppointment($id)
    {
        if (!session('doctor_logged_in')) {
            return redirect('/doctor_login');
        }

        DB::table('appointment')->where('id', $id)->update([
            'status' => 'Rejected'
        ]);

        return redirect()->back()->with('success', 'Appointment Rejected Successfully!');
    }
}