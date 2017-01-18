<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\User;

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
        $user = User::seek()->first();

        $is_admin = $user ? $user->admin : null;

        if ($is_admin && Hash::check(request('password'), $user->password)) {
            Auth::guard('admin')->login($user->admin);

            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('admin.login.showForm')->with('error_message', 'Invalid credentials.');
    }
}
