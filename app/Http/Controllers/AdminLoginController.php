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

    }

    public function login()
    {
        $user = User::where('email', request('email'))
        ->orWhere('username', request('username'))
        ->first();

        $is_admin = $user->roles->contains(function($role) {
            return $role->id == RoleConstants::ADMIN_ROLE;
        });

        if ($is_admin && Hash::check(request('password'), $user->password)) {
            Auth::guard('admin')->login($user);

            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('admin.login.showForm');
    }
}
