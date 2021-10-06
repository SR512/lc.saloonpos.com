<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellerInvoiceRequest extends FormRequest
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
            'name'=>'required',
            'email'=>'nullable|email',
            'mobile'=>'required|numeric|digits:10',
            'invoicedate'=>'required',
            'duedate'=>'required',
            'method'=>'required',
            'status'=>'required',
            'due'=>'nullable|numeric',
            'paid'=>'nullable|numeric',
            'amount'=>'required|numeric',
        ];
    }
}
