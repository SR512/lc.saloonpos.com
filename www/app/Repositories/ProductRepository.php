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
        return Customer::latest();
    }

    // Create New Recoard
    public function create($params)
    {
        return Product::create([
            'product_name' => $params->product_name,
            'customer_price' => $params->customer_price,
            'delear_price' => $params->delear_price,
            'qty' => $params->qty,
            'min_qty' => $params->min_qty,
            'created_at' => Carbon::now(),
        ]);

    }


    // Create New Recoard
        public function update($id,$params)
        {
            return Product::findorfail($id)->update([
                'product_name' => $params->product_name,
                'customer_price' => $params->customer_price,
                'delear_price' => $params->delear_price,
                'qty' => $params->qty,
                'min_qty' => $params->min_qty,
                'status' => $params->status,
                'created_at' => Carbon::now(),
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
            $product = $product->where('first_name', 'LIKE', '%' . $name . '%')->orWhere('last_name', 'LIKE', '%' . $name . '%')->orWhere('mobile_number', 'LIKE', '%' . $name . '%');
        }

        return $product->latest()->paginate(config('constants.PER_PAGE'));
    }

}
