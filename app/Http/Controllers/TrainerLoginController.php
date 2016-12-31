<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;

class TrainerLoginController extends Controller
{
    public function create()
    {
        return view('app.trainers.login');
    }

    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = User::where('email', request('email'))->first();

            if ($user->trainer) {
                return redirect()->route('app.trainers.dashboard');
            }
        }

        return redirect()->route('app.trainers.login.showForm')->with('error_message', 'Invalid credentials.');
    }
}
