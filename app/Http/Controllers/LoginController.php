<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function loginCheck(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // DB check
        $user = DB::table('users')
            ->where('email', $email)
            ->where('password', $password) // ⚠️ For demo only (real project use hashing)
            ->first();

        if ($user) {
            return redirect('/user')->with('success', 'Login Successful!');
        } else {
            return redirect('/login')->with('error', 'Invalid Credentials!');
        }
    }
}
