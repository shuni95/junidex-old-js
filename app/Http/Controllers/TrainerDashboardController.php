<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class TrainerDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth.trainer']);
    }

    public function index()
    {
        $user = Auth::guard('trainer')->user();

        return view('app.trainers.dashboard', ['user' => $user]);
    }
}
