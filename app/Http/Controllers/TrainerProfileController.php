<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;

class TrainerProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'web']);
    }

    public function myself()
    {
        $user = Auth::user();

        return view('app.trainers.myself', ['user' => $user]);
    }

    public function show($username)
    {
        if (!Auth::user()->trainer) {
            return redirect()->route('app.trainers.register.showForm');
        }

        $user = User::where('username', $username)->firstOrFail();

        return view('app.trainers.show_profile', ['user' => $user]);
    }
}
