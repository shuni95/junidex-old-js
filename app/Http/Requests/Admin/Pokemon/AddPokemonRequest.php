<?php

namespace App\Http\Requests\Admin\Pokemon;

use Illuminate\Foundation\Http\FormRequest;

class AddPokemonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'japanese_name' => 'required',
            'japanese_katakana' => 'required',
            'type_one' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'japanese_name.required' => 'Japanese Name is required',
            'japanese_katakana.required' => 'Japanase Katakana is required',
            'type_one.required' => 'At least select one type',
        ];
    }
}
