<?php


namespace App\Repositories;


use App\Models\Customer;
use App\Models\Employee;
use App\Models\Maintenance;
use App\Models\Settings;
use Carbon\Carbon;

class EmployeeRepository
{
    //get Employees
    public function getEmployees()
    {
        return Employee::latest();
    }

    // Create New Recoard
    public function create($params)
    {
        return Employee::create([
            'first_name' => $params->first_name,
            'last_name' => $params->last_name,
            'gender' => $params->gender,
            'date_of_birth' => $params->date_of_birth,
            'date_of_anniversary' => $params->date_of_anniversary,
            'email' => $params->email,
            'mobile_number' => $params->mobile_number,
            'address' => $params->address,
            'city' => $params->city,
            'pin_code' => $params->pin_code,
            'job_type' => $params->job_type,
            'commission_percentage' => $params->commission_percentage,
            'salary' => $params->salary,
            'commission' => $params->commission,
            'created_at' => Carbon::now(),
        ]);

    }


    // Update Recoard
    public function update($id, $params)
    {
        return Employee::findorfail($id)->update([
            'first_name' => $params->first_name,
            'last_name' => $params->last_name,
            'gender' => $params->gender,
            'date_of_birth' => $params->date_of_birth,
            'date_of_anniversary' => $params->date_of_anniversary,
            'email' => $params->email,
            'mobile_number' => $params->mobile_number,
            'address' => $params->address,
            'city' => $params->city,
            'pin_code' => $params->pin_code,
            'job_type' => $params->job_type,
            'commission_percentage' => $params->commission_percentage,
            'salary' => $params->salary,
            'commission' => $params->commission,
            'updated_at' => Carbon::now(),
        ]);

    }

    // findById data
    public function findById($id)
    {
        return Employee::find($id);
    }

    //Filter data
    public function filterEmployeeData($params)
    {
        $employee = new Employee();

        if (!empty($params->name)) {
            $name = $params->name;
            $employee = $employee->where('first_name', 'LIKE', '%' . $name . '%')->orWhere('last_name', 'LIKE', '%' . $name . '%')->orWhere('mobile_number', 'LIKE', '%' . $name . '%');
        }

        return $employee->latest()->paginate(config('constants.PER_PAGE'));
    }

}
