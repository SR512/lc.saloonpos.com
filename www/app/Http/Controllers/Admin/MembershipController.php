<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Membership;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = resolve('membership-repo')->getMembership();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('customer_id', function ($row) {
                    return $row->customers->full_name;
                })
                ->addColumn('package_id', function ($row) {
                    return $row->packages->packagename;
                })
                ->addColumn('end_date', function ($row) {
                    return $row->end_date_at_formatted;
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at_formatted;
                })
                ->addColumn('action', function ($row) {
                    $btn = view('membership.datatablesActions', compact('row'))->render();
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('membership.membership_list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all()->pluck('full_name', 'id');
        $packages = Package::all()->pluck('packagename', 'id');
        return view('membership.create_membership', compact('customers', 'packages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Generate unique appointment_no
        $unique_appointment_no_str = "M0000";
        $appointment_no = Membership::Where('membership_no', 'LIKE', $unique_appointment_no_str . '%')->count();
        $new_appointment_no = $unique_appointment_no_str . str_pad(($appointment_no + 1), 0, 0, STR_PAD_LEFT);

        $package = resolve('package-repo')->findById($request->package_id);
        $request['packagedetail'] = $package->packagedetail;
        $request['membership_no'] = $new_appointment_no;
        $request['end_date'] = Carbon::now()->addMonth($package->duration)->format('Y-m-d');

        $membership = resolve('membership-repo')->create($request);

        if (!empty($membership)) {
            toastr()->success('Membership save successfully.');

        } else {
            toastr()->error('Membership not save..!');
        }

        return redirect()->route('membership.index');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $membership = resolve('membership-repo')->findByID($id);
        return view('membership.show_membership', compact('membership'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $membership = resolve('membership-repo')->findByID($id);
        return view('membership.edit_membership', compact('membership'));
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

        $membership = resolve('membership-repo')->update($id, $request);

        if ($membership) {
            toastr()->success('Membership updated successfully.');

        } else {
            toastr()->error('Membership not updated..!');
        }

        return redirect()->route('membership.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $membership = resolve('membership-repo')->findByID($id);

        if (!empty($membership)) {
            if ($membership->delete()) {
                toastr()->success('Membership delete successfully.');
            } else {
                toastr()->error('Membership not delete.');
            }

        } else {
            toastr()->error('Membership not found..!');
        }
        return redirect()->back();
    }

    public function changeStatus($id)
    {

        $membership = resolve('membership-repo')->changeStatus($id);
        if ($membership) {
            toastr()->success('Membership status change successfully.');

        } else {
            toastr()->error('Membership not found..!');
        }
        return redirect()->back();

    }
}
