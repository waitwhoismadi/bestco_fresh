<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplyjobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'full_name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'contact' => 'required|min:10',
            'experience' => 'required',
            'file' => 'mimes:pdf,docs|max:3072',
        ];
    }
}
