<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Carbon\Carbon;

use App\User;

class TrainerRegisterRequest extends FormRequest
{
    public function __construct()
    {
        $this->redirectRoute = 'app.trainers.register.showForm';
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $ten_year_ago = Carbon::today()->subYears(10)->addDay()->toDateString();

        $rules = [
            'name'     => 'required',
            'lastname' => 'required',
            'birthday' => 'required|before:' . $ten_year_ago,
            'email'    => 'required|email|unique:users',
            'username' => 'required|alpha_num|unique:users',
            'password' => 'required|confirmed',
        ];

        $user = User::seek()->first();

        if ($user && $user->admin) {
            unset($rules['email']);
            unset($rules['username']);
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required'      => 'The trainer\'s first name is required.',
            'lastname.required'  => 'The trainer\'s last name is required.',
            'username.unique'    => 'The username has already exists.',
            'email.unique'       => 'The email has already exists.',
            'password.confirmed' => 'Choose a password you can remember.',
        ];
    }
}
