<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function saveAppointment(Request $request)
    {
        DB::table('appointments')->insert([
            'full_name' => $request->input('full_name'),
            'email' => $request->input('email'),
            'appoint_date' => $request->input('appoint_date'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/appointment')->with('success', 'Appointment booked successfully!');
    }
}

