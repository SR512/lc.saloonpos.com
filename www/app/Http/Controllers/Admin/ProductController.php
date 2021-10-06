<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\Stocks;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = resolve('product-repo')->getProducts();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('product_name', function ($row) {
                    return $row->product_name;
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at_formatted;
                })
                ->addColumn('action', function ($row) {
                    $btn = view('product.datatablesActions', compact('row'))->render();
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('product.product_list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sizes = Attribute::orderBy('size', 'ASC')->get();
        return view('product.create_product', compact('sizes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::create([
            'product_name' => $request->product_name,
            'serial_number' => "QS" . rand(00000, 99999),
            'created_at' => Carbon::now()
        ]);

        if (!empty($product)) {
            foreach ($request->product['detail'] as $row) {
                Stocks::create([
                    'product_id' => $product->id,
                    'attribute_size_id' => $row['size'],
                    'quantity' => $row['qty'],
                    'min_quantity' => $row['min_Qty'],
                    'price' => $row['price'],
                    'purchase_price' => $row['price'],
                    'purchased_date' => Carbon::now(),
                    'created_at' => Carbon::now(),
                ]);
            }
            toastr()->success('Product created successfully.');
            return redirect()->route('product.index');
        } else {
            toastr()->error('Product not created successfully.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = resolve('product-repo')->findById($id);
        $sizes = Attribute::orderBy('size', 'ASC')->get();
        return view('product.show_product', compact('product', 'sizes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = resolve('product-repo')->findById($id);
        $sizes = Attribute::orderBy('size', 'ASC')->get();
        return view('product.edit_product', compact('product', 'sizes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id)->update([
            'product_name' => $request->product_name,
            'updated_at' => Carbon::now()
        ]);

        Stocks::where('product_id', $id)->delete();

        if ($product) {
            foreach ($request->product['detail'] as $row) {

                Stocks::create([
                    'product_id' => $id,
                    'attribute_size_id' => $row['size'],
                    'quantity' => $row['qty'],
                    'min_quantity' => $row['min_Qty'],
                    'price' => $row['price'],
                    'purchase_price' => $row['price'],
                    'purchased_date' => Carbon::now(),
                    'created_at' => Carbon::now(),
                ]);
            }
            toastr()->success('Product updated successfully.');
            return redirect()->route('product.index');
        } else {
            toastr()->error('Product not update successfully.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = resolve('product-repo')->findById($id);

        if (!empty($product)) {
            if($product->delete()){
                toastr()->success('Product delete successfully.');
            }else{
                toastr()->error('Product not delete.');
            }

        } else {
            toastr()->error('Product not found..!');
        }
        return redirect()->back();
    }
}
