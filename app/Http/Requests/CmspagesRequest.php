<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CmspagesRequest extends FormRequest
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
            'page_name'=>['required','string','max:250'],
            'page_slug'=>['max:250',Rule::unique('cms_pages','page_slug')->ignore($this->cm)],
            'page_content'=>['required'],
            'seo_title'=>['required','string'],
            'seo_description'=>['required'],
        ];
    }
}
