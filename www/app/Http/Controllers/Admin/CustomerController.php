<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = resolve('customer-repo')->getCustomers();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->full_name;
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at_formatted;
                })
                ->addColumn('date_of_birth', function ($row) {
                    return $row->date_of_birth_formatted;
                })
                ->addColumn('date_of_anniversary', function ($row) {
                    return $row->date_of_anniversary_formatted;
                })
                ->addColumn('action', function ($row) {
                    $btn = view('customer.datatablesActions', compact('row'))->render();
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('customer.customer_list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create_customer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {

        $customer = resolve('customer-repo')->create($request);

        if (!empty($customer)) {
            toastr()->success('Customer save successfully.');

        } else {
            toastr()->error('Customer not save..!');
        }

        return redirect()->route('customer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = resolve('customer-repo')->findById($id);
        return view('customer.edit_customer',compact('customer'));
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
        $customer = resolve('customer-repo')->update($id,$request);

        if (!empty($customer)) {
            toastr()->success('Customer updated successfully.');

        } else {
            toastr()->error('Customer not update..!');
        }

        return redirect()->route('customer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = resolve('customer-repo')->findById($id);

        if (!empty($customer)) {
            if($customer->delete()){
                toastr()->success('Customer delete successfully.');
            }else{
                toastr()->error('Customer not delete.');
            }

        } else {
            toastr()->error('Customer not found..!');
        }
        return redirect()->back();
    }
}
