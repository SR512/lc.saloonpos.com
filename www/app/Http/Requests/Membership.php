<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Membership extends FormRequest
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
            'customer_id' => 'required',
            'package_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'customer_id.required' => 'The customer field is required.',
            'package_id.required' => 'The package field is required.',
        ];
    }
}
