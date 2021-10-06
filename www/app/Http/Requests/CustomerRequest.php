<?php

namespace App\Http\Requests;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
        $route = ['customers.store','customers.create'];

        if (!in_array(request()->route()->getName(),$route)) {

            $rules = [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'nullable|email',
                'mobile_number' => 'required|numeric|digits:10'
            ];
        }else{
            $rules = [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'nullable|email',
                'mobile_number' => 'required|numeric|digits:10|unique:customers'
            ];
        }

        return $rules;
    }
}
