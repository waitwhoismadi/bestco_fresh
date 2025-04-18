<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserregistrationRequest extends FormRequest
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
            'name'=>'required|string',
            'email'=>'required|email|string|unique:users,email',
            'category'=>'required',
            'password'=>'required|max:8|string|confirmed',
            'terms_and_condition'=>'required'

        ];
    }
}
