<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Service;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = resolve('package-repo')->getPackage();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('created_at', function ($row) {
                    return $row->created_at_formatted;
                })
                ->addColumn('action', function ($row) {
                    $btn = view('package.datatablesActions', compact('row'))->render();
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('package.package_list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::orderBy('service_name', 'ASC')->get();
        return view('package.create_package', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $package = resolve('package-repo')->create($request);

        if (!empty($package)) {
            toastr()->success('Package save successfully.');

        } else {
            toastr()->error('Package not save..!');
        }

        return redirect()->route('package.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $package = resolve('package-repo')->findById($id);
        $services = Service::orderBy('service_name', 'ASC')->get();
        return view('package.show_package', compact('package', 'services'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $services = Service::orderBy('service_name', 'ASC')->get();
        $package = resolve('package-repo')->findByID($id);
        return view('package.edit_package', compact('services', 'package'));
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

        $package = resolve('package-repo')->update($id, $request);

        if (!empty($package)) {
            toastr()->success('Package update successfully.');

        } else {
            toastr()->error('Package not update..!');
        }

        return redirect()->route('package.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package = resolve('package-repo')->findByID($id);

        if (!empty($package)) {
            if ($package->delete()) {
                toastr()->success('Package delete successfully.');
            } else {
                toastr()->error('Package not delete.');
            }

        } else {
            toastr()->error('Package not found..!');
        }
        return redirect()->back();
    }
}
