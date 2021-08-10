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
        $customer = new Customer();

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules = $customer->rules;
        }else{
            $rules = $customer->update_rules;
        }

        return $rules;
    }
}
