<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;

use App\User;
use App\Trainer;

use App\Http\Requests\TrainerRegisterRequest;

class TrainerRegisterController extends Controller
{
    public function create()
    {
        return view('app.trainers.register');
    }

    public function store(TrainerRegisterRequest $request)
    {
        $user = User::seek()->first();

        if (is_null($user)) {
            $user = User::create([
                'name' => request('name'),
                'lastname' => request('lastname'),
                'username' => request('username'),
                'birthday' => request('birthday'),
                'email' => request('email'),
                'password' => request('password'),
            ]);
        }

        Trainer::create([
            'user_id' => $user->id
        ]);

        return redirect()->route('app.trainers.register.thanks')
               ->with('thanks', true);
    }

    public function thanks()
    {
        if (!session('thanks')) {
            return redirect()->route('app.trainers.register.showForm')
                   ->with(['error_message' => 'You must register before']);
        }

        return view('app.trainers.thanks_for_register');
    }
}
