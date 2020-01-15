<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompany extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        'name' => 'unique:companies|required|max:255|min:3',
        'email' => 'required|email|max:255',
        'website' => 'required|url',
        'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
      ];
    }
}
