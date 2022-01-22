<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CurrentPasswordCheckRule;

class PasswordRequest extends FormRequest
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
        if(auth()->user()->role_type == 'company'):
            $this->redirect = route('company_dashboard.setting',['page'=>'change-password']);
        else:
            $this->redirect = route('user_dashboard.setting',['page'=>'change-password']);
        endif;
        return [
            'old_password' => ['required', 'min:6', new CurrentPasswordCheckRule],
            'password' => ['required', 'min:6', 'confirmed', 'different:old_password'],
            'password_confirmation' => ['required', 'min:6'],
        ];
    }
}
