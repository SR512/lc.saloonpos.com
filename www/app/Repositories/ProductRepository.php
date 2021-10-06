<?php


namespace App\Repositories;


use App\Models\Customer;
use App\Models\Maintenance;
use App\Models\Product;
use App\Models\Settings;
use Carbon\Carbon;

class ProductRepository
{
    //get Product
    public function getProducts()
    {
        return Product::latest();
    }

    // Create New Recoard
    public function create($params)
    {
        return Product::create([
            'product_name' => $params->product_name,
            'serial_number' => $params->customer_price,
            'created_at' => Carbon::now(),
        ]);

    }


    // Create New Recoard
        public function update($id,$params)
        {
            return Product::findorfail($id)->update([
                'product_name' => $params->product_name,
                'serial_number' => $params->serial_number,
                'updated_At' => Carbon::now(),
            ]);

        }

    // findById data
    public function findById($id)
    {
        return Product::find($id);
    }

    //Filter data
    public function filterProductData($params)
    {
        $product = new Product();

        if (!empty($params->name)) {
            $name = $params->name;
            $product = $product->where('product_name', 'LIKE', '%' . $name . '%')->orWhere('serial_number', 'LIKE', '%' . $name . '%');
        }

        return $product->latest()->paginate(config('constants.PER_PAGE'));
    }

}
