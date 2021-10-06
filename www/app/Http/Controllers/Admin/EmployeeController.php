<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = resolve('employee-repo')->getEmployees();
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
                    $btn = view('employee.datatablesActions', compact('row'))->render();
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('employee.employee_list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.create_employee');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $employee = resolve('employee-repo')->create($request);

        if (!empty($employee)) {
            toastr()->success('Employee save successfully.');

        } else {
            toastr()->error('Employee not save..!');
        }

        return redirect()->route('employee.index');
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
        $employee = resolve('employee-repo')->findById($id);
        return view('employee.edit_employee', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        $employee = resolve('employee-repo')->update($id, $request);

        if (!empty($employee)) {
            toastr()->success('Employee updated successfully.');

        } else {
            toastr()->error('Employee not update..!');
        }

        return redirect()->route('employee.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = resolve('employee-repo')->findById($id);

        if (!empty($employee)) {
            if($employee->delete()){
                toastr()->success('Employee delete successfully.');
            }else{
                toastr()->error('Employee not delete.');
            }

        } else {
            toastr()->error('Employee not found..!');
        }
        return redirect()->back();
    }
}
