<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointment'; 

    // Database එකේ created_at, updated_at නොමැති නිසා මෙය false කළ යුතුය
    public $timestamps = false; 

    protected $fillable = [
        'user_id', 
        'appointment_no',   // 👈 NEW: Appointment Number එක සේව් වෙන්න අවසර දුන්නා
        'fullName', 
        'gender', 
        'age', 
        'appoint_date', 
        'appointment_time', // 👈 NEW: Appointment Time එක සේව් වෙන්න අවසර දුන්නා
        'email', 
        'phNo', 
        'diseases', 
        'doctor_name', // දත්තගබඩාවේ ඇති සැබෑ Column නම
        'doctor',      // අමතර ආරක්ෂාව සඳහා (Controller එකෙන් වැරදීමකින් පැමිණියහොත් සිදුවන Error වැළැක්වීමට)
        'doctor_id',   // අමතර ආරක්ෂාව සඳහා
        'address',
        'status'
    ];
}