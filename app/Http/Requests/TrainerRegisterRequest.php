<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Carbon\Carbon;

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

        return [
            'name' => 'required',
            'lastname' => 'required',
            'birthday' => 'required|before:' . $ten_year_ago,
            'email' => 'required|email',
            'username' => 'required|alpha_num',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The trainer\'s first name is required.'
        ];
    }
}
