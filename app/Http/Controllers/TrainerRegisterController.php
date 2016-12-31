<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Trainer;

class TrainerRegisterController extends Controller
{
    public function create()
    {
        return view('app.trainers.register');
    }

    public function store()
    {
        $user = User::create([
            'name' => request('name'),
            'lastname' => request('lastname'),
            'username' => request('username'),
            'birthday' => request('birthday'),
            'email' => request('email'),
            'password' => request('password'),
        ]);

        Trainer::create([
            'user_id' => $user->id
        ]);

        return redirect()->route('app.trainers.register.thanks');
    }

    public function thanks()
    {
        return view('app.trainers.thanks_for_register');
    }
}
