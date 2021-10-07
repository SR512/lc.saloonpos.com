<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Service;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = resolve('appointment-repo')->getAppointments();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('customer_id', function ($row) {
                    return $row->customers->full_name;
                })
                ->addColumn('service_id', function ($row) {
                    return $row->services->service_name;
                })
                ->addColumn('employee_id', function ($row) {
                    return $row->employees->full_name;
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at_formatted;
                })
                ->addColumn('appointment_date_time', function ($row) {
                    return $row->date_at_formatted;
                })
                ->addColumn('action', function ($row) {
                    $btn = view('appointment.datatablesActions', compact('row'))->render();
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('appointment.appointment_list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all()->pluck('full_name', 'id');
        $services = Service::all()->pluck('service_name', 'id');
        $employees = Employee::all()->pluck('full_name', 'id');
        return view('appointment.create_appointment', compact('customers', 'services', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $appointment = resolve('appointment-repo')->create($request);

        if (!empty($appointment)) {
            toastr()->success('Aappointment save successfully.');

        } else {
            toastr()->error('Appointment not save..!');
        }

        return redirect()->route('appointment.index');
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
        $appointment = resolve('appointment-repo')->findByID($id);
        $customers = Customer::all()->pluck('full_name', 'id');
        $services = Service::all()->pluck('service_name', 'id');
        $employees = Employee::all()->pluck('full_name', 'id');
        return view('appointment.edit_appointment', compact('customers', 'services', 'employees', 'appointment'));


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
        $appointment = resolve('appointment-repo')->update($id, $request);

        if (!empty($appointment)) {
            toastr()->success('Appointment update successfully.');

        } else {
            toastr()->error('Appointment not update..!');
        }

        return redirect()->route('appointment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = resolve('appointment-repo')->findByID($id);
        if (!empty($appointment)) {
            if ($appointment->delete()) {
                toastr()->success('Appointment delete successfully.');
            } else {
                toastr()->error('Appointment not delete.');
            }

        } else {
            toastr()->error('Appointment not found..!');
        }
        return redirect()->back();
    }

    public function changeStatus($id, $status)
    {

        $appointment = resolve('appointment-repo')->changeStatus($id, $status);
        if ($appointment) {
            toastr()->success('Appointment ' . $status . ' successfully.');

        } else {
            toastr()->error('Appointment not found..!');
        }
        return redirect()->back();

    }
}
