<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
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
            'start_date'=>'required',
            'start_end'=>'required',
            'report_type'=>'required',
            'employee' => 'required_if:report_type,employee-commission',
            'status' => 'required_if:report_type,customer-invoice|required_if:report_type,seller-invoice',
        ];
    }
}
