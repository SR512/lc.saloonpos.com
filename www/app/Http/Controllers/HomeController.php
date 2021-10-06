<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Invoice;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products_with_size_data = [];
        $customers = Customer::all()->count();
        $todaysCustomerBirthday = Customer::where('date_of_birth', Carbon::now()->format('Y-m-d'))->get();
        $todaysEmployeeBirthday = Employee::where('date_of_birth', Carbon::now()->format('Y-m-d'))->get();
        $employees = Employee::all()->count();
        $todaysCustomerSales = Invoice::where('invoice_type', 'CUSTOMER')->where('invoicedate', Carbon::now()->format('Y-m-d'))->sum('paid');
        $todaysSalllerSales = Invoice::where('invoice_type', 'SELLER')->where('invoicedate', Carbon::now()->format('Y-m-d'))->sum('paid');
        $todaysCustomeDue = Invoice::where('invoice_type', 'CUSTOMER')->where('invoicedate', Carbon::now()->format('Y-m-d'))->sum('due');
        $todaysSalllerDue = Invoice::where('invoice_type', 'SELLER')->where('invoicedate', Carbon::now()->format('Y-m-d'))->sum('due');
        $products = Product::all();
        if (!empty($products)) {
            foreach ($products as $key => $row) {

                foreach ($row->stocks as $stock) {

                    if($stock->quantity < $stock->min_quantity){
                        $products_with_size_data[$key]['product_id'] = $row->id;
                        $products_with_size_data[$key]['product_name'] = $row->product_name;
                        $data = [];
                        $data['id'] = $stock->id;
                        $data['size'] = $stock->attribute_size->size;
                        $data['quantity'] = $stock->quantity;
                        $data['min_quantity'] = $stock->min_quantity;
                        $data['price'] = $stock->price;

                        $products_with_size_data[$key]['size'][] = $data;
                    }
                }
            }
        }
        return view('index', compact('customers', 'employees', 'todaysCustomerSales', 'todaysSalllerSales','todaysCustomeDue','todaysSalllerDue','todaysCustomerBirthday','todaysEmployeeBirthday','products_with_size_data'));
    }
}
