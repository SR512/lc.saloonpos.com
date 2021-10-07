<?php


namespace App\Repositories;


use App\Models\Customer;
use App\Models\Maintenance;
use App\Models\Membership;
use App\Models\Package;
use App\Models\Product;
use App\Models\Settings;
use Carbon\Carbon;

class PackageRepository
{
    //get Package
    public function getPackage()
    {
        return Package::latest();
    }

    // Create New Recoard
    public function create($params)
    {
        return Package::create([
            'packagename' => $params->packagename,
            'duration' => $params->duration,
            'totalprice' => $params->totalprice,
            'packagedetail' => json_encode($params->packagedetail),
            'packagedesc' => $params->packagedesc,
            'created_at' => Carbon::now(),
        ]);

    }


    // Create New Recoard
    public function update($id, $params)
    {
        return Package::findorfail($id)->update([
            'packagename' => $params->packagename,
            'duration' => $params->duration,
            'totalprice' => $params->totalprice,
            'packagedetail' => json_encode($params->packagedetail),
            'packagedesc' => $params->packagedesc,
            'updated_At' => Carbon::now(),
        ]);

    }

    // findById data
    public function findById($id)
    {
        return Package::find($id);
    }


}
