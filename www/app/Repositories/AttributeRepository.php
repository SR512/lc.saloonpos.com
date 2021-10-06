<?php


namespace App\Repositories;


use App\Models\Attribute;
use Carbon\Carbon;

class AttributeRepository
{
    //get attribute
    public function getAttribute()
    {
        return Attribute::latest();
    }

    // Create New Recoard
    public function create($params)
    {
        return Attribute::create([
            'size' => $params->name,
            'created_at' => Carbon::now()
        ]);

    }

    // Update New Recoard
    public function update($id, $params)
    {
        return Attribute::findorfail($id)->update([
            'size' => $params->name,
            'updated_at' => Carbon::now()
        ]);

    }

    // findById data
    public function findById($id)
    {
        return Attribute::find($id);
    }

    //Filter data
    public function filterAttributeData($params)
    {
        $attribute = new Attribute();

        if (!empty($params->name)) {
            $name = $params->name;
            $attribute = $attribute->where('size', 'LIKE', '%' . $name . '%');
        }

        return $attribute->latest()->paginate(config('constants.PER_PAGE'));
    }

}
