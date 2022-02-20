<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentAccessRequestRequest extends FormRequest
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
            'document_id' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'The description input is required',
            'document_id.required' => 'Please select the document you want to gain access the category',
        ];
    }
}
