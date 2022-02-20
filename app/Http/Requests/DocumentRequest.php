<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
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
            'category_id' => 'required',
            'access_level' => 'required',
            'document' => 'required|mimes:pdf,docx,doc|max:5240',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name input is required',
            'description.required' => 'The description input is required',
            'category_id.required' => 'Please select the category',
            'document.required' => 'Please select the document',
            'document.max' => 'Document too large ..The document size should not be greater than 5Mbs',
        ];
    }
}
