<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AppointmentController;

// Index page
Route::get('/', function () {
    return view('index.index');   // resources/views/index/index.blade.php
});

// User Login page
Route::get('/user_login', [UserController::class, 'showLogin']);
Route::post('/user_login_check', [UserController::class, 'loginCheck']);

// Appointment page
Route::get('/appointment', function () {
    return view('appointment'); // resources/views/appointment.blade.php
});

// Doctor page
Route::get('/doctor', function () {
    return view('doctor');  // resources/views/doctor.blade.php
});

// Controllers
Route::post('/login-check', [LoginController::class, 'loginCheck']);
Route::post('/appointment-save', [AppointmentController::class, 'saveAppointment']);
