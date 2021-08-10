<?php


namespace App\Repositories;


use App\Models\Customer;
use App\Models\Maintenance;
use App\Models\Settings;
use Carbon\Carbon;

class CustomerRepository
{
    //get Customer
    public function getCustomers()
    {
        return Customer::latest();
    }

    // Create New Recoard
    public function create($params)
    {
        return Customer::create([
            'first_name' => $params->first_name,
            'last_name' => $params->last_name,
            'date_of_birth' => $params->date_of_birth,
            'date_of_anniversary' => $params->date_of_anniversary,
            'email' => $params->email,
            'mobile_number' => $params->mobile_number,
            'address' => $params->address,
            'city' => $params->city,
            'pin_code' => $params->pin_code,
            'created_at' => Carbon::now(),
        ]);

    }


    // Create New Recoard
        public function update($id,$params)
        {
            return Customer::findorfail($id)->update([
                'first_name' => $params->first_name,
                'last_name' => $params->last_name,
                'date_of_birth' => $params->date_of_birth,
                'date_of_anniversary' => $params->date_of_anniversary,
                'email' => $params->email,
                'mobile_number' => $params->mobile_number,
                'address' => $params->address,
                'city' => $params->city,
                'pin_code' => $params->pin_code,
                'updated_at' => Carbon::now(),
            ]);

        }

    // findById data
    public function findById($id)
    {
        return Customer::find($id);
    }

    //Filter data
    public function filterCustomerData($params)
    {
        $customer = new Customer();

        if (!empty($params->name)) {
            $name = $params->name;
            $customer = $customer->where('first_name', 'LIKE', '%' . $name . '%')->orWhere('last_name', 'LIKE', '%' . $name . '%')->orWhere('mobile_number', 'LIKE', '%' . $name . '%');
        }

        return $customer->latest()->paginate(config('constants.PER_PAGE'));
    }

}
