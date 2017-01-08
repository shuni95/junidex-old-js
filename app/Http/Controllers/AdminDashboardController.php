<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth.admin']);
    }

    public function index()
    {
        $admin = Auth::guard('admin')->user();

        return view('admin.dashboard', ['user' => $admin->user]);
    }
}
