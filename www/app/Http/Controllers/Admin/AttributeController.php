<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = resolve('attribute-repo')->getAttribute();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->size;
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at_formatted;
                })
                ->addColumn('action', function ($row) {
                    $btn = view('attribute.datatablesActions', compact('row'))->render();
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('attribute.attribute_list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('attribute.create_attribute');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeRequest $request)
    {
        $attribute = resolve('attribute-repo')->create($request);

        if (!empty($attribute)) {
            toastr()->success('Attribute save successfully.');

        } else {
            toastr()->error('Attribute not save..!');
        }

        return redirect()->route('attribute.index');
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
        $attribute = resolve('attribute-repo')->findById($id);
        return view('attribute.edit_attribute', compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeRequest $request, $id)
    {
        $attribute = resolve('attribute-repo')->update($id, $request);

        if (!empty($attribute)) {
            toastr()->success('Attribute updated successfully.');

        } else {
            toastr()->error('Attribute not update..!');
        }

        return redirect()->route('attribute.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attribute = resolve('attribute-repo')->findById($id);

        if (!empty($attribute)) {
            if ($attribute->delete()) {
                toastr()->success('Attribute delete successfully.');
            } else {
                toastr()->error('Attribute not delete.');
            }

        } else {
            toastr()->error('Attribute not found..!');
        }
        return redirect()->back();
    }
}
