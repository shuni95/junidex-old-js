<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;

class TrainerProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth.trainer']);
    }

    public function myself()
    {
        $user = Auth::guard('trainer')->user();

        return view('app.trainers.myself', ['user' => $user]);
    }

    public function show($username)
    {
        $user = Auth::guard('trainer')->user();

        $user = User::where('username', $username)->firstOrFail();

        return view('app.trainers.show_profile', ['user' => $user]);
    }
}
