<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|max:155',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed',
            'tel' => 'required|regex:/([0-9\s\-\+\(\)]*)$/|min:10|numeric',
            'department_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name input is required',
            'email.required' => 'The Email input is required',
            'password.required' => 'The Password input is required',
            'tel.required' => 'Please Enter your phone number!',
            'department_id.required' => 'Please select the department',
        ];
    }


}
