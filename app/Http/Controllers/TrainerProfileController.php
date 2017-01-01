<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class TrainerProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'web']);
    }

    public function show()
    {
        $user = Auth::user();

        return view('app.trainers.show_profile', ['user' => $user]);
    }
}
