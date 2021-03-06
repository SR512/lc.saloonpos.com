<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'site_logo' => 'nullable|mimes:jpg,jpeg,png|max:4096',
            'name' => 'required',
            'gst' => 'required',
            'email' => 'nullable|email',
            'mobile' => 'nullable|digits:10',
            'address' => 'required',
        ];
    }
}
