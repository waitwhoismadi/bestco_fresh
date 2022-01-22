<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyregistrationRequest extends FormRequest
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
        session()->put('register_type', 'company');
        return [
            'company_name'=>'required|string',
            'company_email'=>'required|email|string|unique:users,email|unique:companies,email',
            'industry_type'=>'required',
            'password'=>'required|max:8|string|confirmed',
            'terms_and_condition'=>'required'
        ];
    }
}
