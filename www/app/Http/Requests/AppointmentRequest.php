<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
            'service_id' => 'required',
            'employee_id' => 'required',
            'appointment_date_time' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'customer_id.required' => 'The customer field is required.',
            'service_id.required' => 'The service field is required.',
            'employee_id.required' => 'The employee field is required.',
        ];
    }
}
