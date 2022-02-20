<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class editUserRequest extends FormRequest
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
            'name' => 'max:155',
            'email' => 'email|required',
            'tel' => 'regex:/([0-9\s\-\+\(\)]*)$/|min:10|numeric',
            'department_id' => 'integer',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'The  Email is Already  registered into the system',
        ];
    }



}

