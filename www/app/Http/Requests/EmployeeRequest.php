<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
        $route = ['employees.store','employees.create'];

        if(in_array(request()->route()->getName(),$route)){
            return [
                'first_name' => 'required',
                'last_name' => 'required',
                'gender' => 'required',
                'email' => 'nullable|email|unique:employees',
                'mobile_number' => 'required|unique:employees|numeric|digits:10',
                'date_of_birth' => 'nullable',
                'date_of_anniversary' => 'nullable',
                'address' => 'required',
                'city' => 'required',
                'pin_code' => 'required|numeric|digits:6',
                'job_type' => 'required',
                'commission_percentage' => 'required_if:job_type,BOTH|required_if:job_type,COMMISSION',
                'salary' => 'required_if:job_type,BOTH|required_if:job_type,SALARIED',
            ];
        }else{
            return [
                'first_name' => 'required',
                'last_name' => 'required',
                'gender' => 'required',
                'email' => 'nullable|email',
                'mobile_number' => 'required|numeric|digits:10',
                'date_of_birth' => 'nullable',
                'date_of_anniversary' => 'nullable',
                'address' => 'required',
                'city' => 'required',
                'pin_code' => 'required|numeric|digits:6',
                'job_type' => 'required',
                'commission_percentage' => 'required_if:job_type,BOTH|required_if:job_type,COMMISSION',
                'salary' => 'required_if:job_type,BOTH|required_if:job_type,SALARIED',
            ];
        }

    }
}
