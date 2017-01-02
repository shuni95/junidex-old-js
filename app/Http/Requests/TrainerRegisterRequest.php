<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainerRegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'lastname' => 'required',
            'birthday' => 'required',
            'email' => 'required',
            'username' => 'required|alpha_num',
            'password' => 'required',
        ];
    }
}
