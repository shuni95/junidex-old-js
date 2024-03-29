<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();

        return view('admin.dashboard', ['user' => $admin->user]);
    }
}
