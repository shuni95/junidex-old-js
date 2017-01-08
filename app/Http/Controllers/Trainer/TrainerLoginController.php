<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;

use App\User;

use Auth;
use Hash;

class TrainerLoginController extends Controller
{
    public function create()
    {
        return view('app.trainers.login');
    }

    public function login()
    {
        $user = User::seek()->first();

        $is_trainer = $user ? $user->trainer : null;

        if ($is_trainer && Hash::check(request('password'), $user->password)) {
            Auth::guard('trainer')->login($user->trainer);

            return redirect()->route('app.trainers.dashboard');
        }

        return redirect()->route('app.trainers.login.showForm')->with('error_message', 'Invalid credentials.');
    }

    public function logout()
    {
        Auth::guard('trainer')->logout();

        return redirect('/');
    }
}
