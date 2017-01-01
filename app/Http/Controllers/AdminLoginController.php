<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\RoleConstants;

use Auth;

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

        if ($is_admin && Auth::attempt(['email' => $user->email, 'password' => request('password')])) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('admin.login.showForm');
    }
}
