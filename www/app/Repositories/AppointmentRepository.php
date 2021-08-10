<?php


namespace App\Repositories;


use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Maintenance;
use App\Models\Settings;
use Carbon\Carbon;

class AppointmentRepository
{
    //get appointment
    public function getAppointments()
    {
        return Appointment::latest();
    }

    // Create New Appointment
    public function create($params)
    {
        return Appointment::create([
            'customer_id' => $params->customer_id,
            'service_id' => $params->service_id,
            'employee_id' => $params->employee_id,
            'appointment_date_time' => $params->appointment_date_time,
            'created_at' => Carbon::now(),
        ]);

    }


    // Appointment update
    public function update($id, $params)
    {
        return Appointment::findorfail($id)->update([
            'customer_id' => $params->customer_id,
            'service_id' => $params->service_id,
            'employee_id' => $params->employee_id,
            'appointment_date_time' => $params->appointment_date_time,
            'updated_at' => Carbon::now(),
        ]);

    }

    // findById data
    public function findById($id)
    {
        return Appointment::find($id);
    }

    //Filter data
    public function filterAppointmentData($params)
    {
        $appointment = new Appointment();

        if (!empty($params->name)) {
            $name = $params->name;
            //$appointment = $appointment->where('first_name', 'LIKE', '%' . $name . '%')->orWhere('last_name', 'LIKE', '%' . $name . '%')->orWhere('mobile_number', 'LIKE', '%' . $name . '%');
        }

        return $appointment->latest()->paginate(config('constants.PER_PAGE'));
    }

}
