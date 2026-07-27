<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB; 


// --- 1. HOME PAGE ---
// Main landing page of the website
Route::get('/', function () { 
    return view('index'); 
})->name('index');



// --- 2. ADMIN AUTHENTICATION ---
// Show admin login form
Route::get('/admin_login', function () { 
    return view('Admin_task.admin_login'); 
})->name('admin.login');

// Handle admin login verification, dashboard view, and logout
Route::post('/admin_login_check', [UserController::class, 'adminLoginCheck']);
Route::get('/admin_dashboard', [UserController::class, 'adminDashboard']);
Route::get('/admin_logout', [UserController::class, 'adminLogout']);



// --- 3. ADMIN - DOCTOR & PATIENT MANAGEMENT ---

// Show form to add a new doctor
Route::get('/add_doctor', function () { 
    return view('Admin_task.add_doctor'); 
});

// Save, view, edit, update, and delete doctor records
Route::post('/save_doctor', [UserController::class, 'saveDoctor']);
Route::get('/view_doctor', [UserController::class, 'viewDoctors']);
Route::get('/edit_doctor/{id}', [UserController::class, 'editDoctor']);
Route::post('/update_doctor', [UserController::class, 'updateDoctor']); 
Route::get('/delete_doctor/{id}', [UserController::class, 'deleteDoctor']);

// [UPDATED] View all patient appointments from the admin panel with daily report and history filtering
Route::get('/view_patient', [UserController::class, 'adminViewPatients']);

// [ADDED] Clear all of today's appointments instantly
Route::post('/clear_today_appointments', [UserController::class, 'clearTodayAppointments']);


// --- 4. USER AUTHENTICATION & REGISTRATION (PATIENTS) ---

// Show user login and registration forms
Route::get('/user_login', function () { return view('user_task.user_login'); })->name('login');
Route::get('/user_register', function () { return view('user_task.user_register'); });

// Handle user registration saving and login authentication
Route::post('/user_register_save', [UserController::class, 'registerSave']);
Route::post('/user_login_check', [UserController::class, 'loginCheck']);



// --- 5. PASSWORD RECOVERY 
// Show forgot password request form
Route::get('/user_forgot_password', function () {
    return view('user_task.user_forgot_password');
})->name('password.request');

// Update password directly using the form data
Route::post('/update-password-direct', [UserController::class, 'updatePasswordDirect']);



// --- 6. PUBLIC & PROTECTED ROUTES (USER) ---


// Public page: Anyone can view the appointment information page without logging in
Route::get('/appointment', function () { 
    return view('appointment_task.appointment'); 
})->name('user.appointment');

// Public page: User dashboard landing view (accessible without auth restrictions)
Route::get('/user_view', function () { 
    return view('user_task.user_view'); 
})->name('user.dashboard');


// Protected Routes: Only logged-in users ('auth' middleware active) can enter here
Route::middleware(['auth'])->group(function () {
    
    // View appointments list
    Route::get('/view_appointment', [UserController::class, 'viewAppointments'])->name('user.view_appointment'); 
    
    // Save new appointment details
    Route::post('/save_appointment', [UserController::class, 'saveAppointment']);
    
    // Edit, update, and delete existing appointments
    Route::get('/edit_appointment/{id}', [UserController::class, 'editAppointment']);
    Route::post('/update_appointment/{id}', [UserController::class, 'updateAppointment']);
    Route::get('/delete_appointment/{id}', [UserController::class, 'deleteAppointment']); 
    
    // User profile features: View and edit profile screens
    Route::get('/view_profile', [UserController::class, 'showProfile']);
    Route::get('/edit_profile', [UserController::class, 'editUserProfile']);
    
    // Handle form submission to update user profile details
    Route::post('/update_profile_save', [UserController::class, 'updateUserProfile'])->name('profile.update');
});

// Public Logout: Placed outside middleware to safely logout users and prevent 404 errors
Route::get('/logout', [UserController::class, 'logout'])->name('logout');



// --- 7. DOCTOR FLOW ---

// Doctor login form panel and credential verification
Route::get('/doctor_login', function () { return view('doctor_task.doctor_login'); });
Route::post('/doctor_login_check', [UserController::class, 'doctorLoginCheck']);

// Doctor dashboard metrics, patient lists, and logout controller actions
Route::get('/doctor_dashboard', [UserController::class, 'doctorDashboard']);
Route::get('/doctor_view_patients', [UserController::class, 'doctorViewPatients']);
Route::get('/doctor_logout', [UserController::class, 'doctorLogout']);

// Doctor personal profiles management: View, edit, and update records
Route::get('/doctor_view_profile', [UserController::class, 'showDoctorProfile']);
Route::get('/doctor_edit_profile', [UserController::class, 'editDoctorProfile']);
Route::post('/doctor_update_profile', [UserController::class, 'updateDoctorProfile']);

// [ADDED] Doctor Appointment Status Update Actions (Approve & Reject)
Route::post('/appointment/approve/{id}', [UserController::class, 'approveAppointment']);
Route::post('/appointment/reject/{id}', [UserController::class, 'rejectAppointment']);