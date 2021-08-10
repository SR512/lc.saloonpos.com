<?php


namespace App\Repositories;


use App\Models\Customer;
use App\Models\Maintenance;
use App\Models\Service;
use App\Models\Settings;
use Carbon\Carbon;

class ServiceRepository
{
    //get Service
    public function getServices()
    {
        return Service::latest();
    }

    // Create New Recoard
    public function create($params)
    {
        return Service::create([
            'service_name' => $params->service_name,
            'price' => $params->price,
            'created_at' => Carbon::now()
        ]);

    }


    // Update New Recoard
    public function update($id, $params)
    {
        return Service::findorfail($id)->update([
            'service_name' => $params->service_name,
            'price' => $params->price,
            'created_at' => Carbon::now()
        ]);

    }

    // findById data
    public function findById($id)
    {
        return Service::find($id);
    }

    //Filter data
    public function filterServiceData($params)
    {
        $service = new Service();

        if (!empty($params->name)) {
            $name = $params->name;
            $service = $service->where('first_name', 'LIKE', '%' . $name . '%')->orWhere('last_name', 'LIKE', '%' . $name . '%')->orWhere('mobile_number', 'LIKE', '%' . $name . '%');
        }

        return $service->latest()->paginate(config('constants.PER_PAGE'));
    }

}
