<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\RoleConstants;

use Auth;
use Hash;

class AdminLoginController extends Controller
{
    public function create()
    {
        return view('admin.login');
    }

    public function login()
    {
        $user = User::where('email', request('email'))
        ->orWhere('username', request('username'))
        ->first();

        $is_admin = $user ? $user->admin : null;

        if ($is_admin && Hash::check(request('password'), $user->password)) {
            Auth::guard('admin')->login($user);

            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('admin.login.showForm')->with('error_message', 'Invalid credentials.');
    }
}
