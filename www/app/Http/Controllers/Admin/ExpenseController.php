<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = resolve('expense-repo')->getExpenses();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('date', function ($row) {
                    return $row->date_at_formatted;
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at_formatted;
                })
                ->addColumn('action', function ($row) {
                    $btn = view('expense.datatablesActions', compact('row'))->render();
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('expense.expense_list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expense.create_expense');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseRequest $request)
    {
        $attribute = resolve('expense-repo')->create($request);

        if (!empty($attribute)) {
            toastr()->success('Expense save successfully.');

        } else {
            toastr()->error('Expense not save..!');
        }

        return redirect()->route('expense.index');
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
        $expense = resolve('expense-repo')->findById($id);
        return view('expense.edit_expense', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenseRequest $request, $id)
    {
        $expense = resolve('expense-repo')->update($id, $request);

        if (!empty($expense)) {
            toastr()->success('Expense updated successfully.');

        } else {
            toastr()->error('Expense not update..!');
        }

        return redirect()->route('expense.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = resolve('expense-repo')->findById($id);

        if (!empty($expense)) {
            if ($expense->delete()) {
                toastr()->success('Expense delete successfully.');
            } else {
                toastr()->error('Expense not delete.');
            }

        } else {
            toastr()->error('Attribute not found..!');
        }
        return redirect()->back();
    }
}
