<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MemberRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:225|' . Rule::unique('users'),
            'password' => 'required|max:255|confirmed',
            'avatar' => 'required',
            // 'repassword' => 'required|max:255|same:password',
        ];
    }
    public function messages()
    {
        return [
            // 'repassword.same' => 'Password Confirmation should match the Password',
        ];
    }
}
