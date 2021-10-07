<?php


namespace App\Repositories;


use App\Models\Customer;
use App\Models\Maintenance;
use App\Models\Membership;
use App\Models\Product;
use App\Models\Settings;
use Carbon\Carbon;

class MembershipRepository
{
    //get Product
    public function getMembership()
    {
        return Membership::latest();
    }

    // Create New Recoard
    public function create($params)
    {
        return Membership::create([
            'membership_no' => $params->membership_no,
            'customer_id' => $params->customer_id,
            'package_id' => $params->package_id,
            'packagedetail' => json_encode($params->packagedetail),
            'end_date' => json_encode($params->end_date),
            'created_at' => Carbon::now(),
        ]);

    }


    // Create New Recoard
    public function update($id, $params)
    {
        return Membership::findorfail($id)->update([
            'membership_no' => $params->membership_no,
            'customer_id' => $params->customer_id,
            'package_id' => $params->package_id,
            'packagedetail' => json_encode($params->packagedetail),
            'end_date' => json_encode($params->end_date),
            'updated_At' => Carbon::now(),
        ]);

    }

    // findById data
    public function findById($id)
    {
        return Membership::find($id);
    }


}
