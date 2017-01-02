<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Carbon\Carbon;

class TrainerRegisterRequest extends FormRequest
{
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
            'email' => 'required',
            'username' => 'required|alpha_num',
            'password' => 'required',
        ];
    }
}
