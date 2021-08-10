<?php


namespace App\Repositories;


use App\Models\Customer;
use App\Models\Expense;
use App\Models\Maintenance;
use App\Models\Settings;
use Carbon\Carbon;

class ExpenseRepository
{
    //get Expense
    public function getExpenses()
    {
        return Expense::latest();
    }

    // Create New Recoard
    public function create($params)
    {
        return Expense::create([
            'expenses_name' => $params->expenses_name,
            'date' => $params->date,
            'amount' => $params->amount,
            'created_at' => Carbon::now(),
        ]);

    }


    // Update Recoard
    public function update($id, $params)
    {
        return Expense::findorfail($id)->update([
            'expenses_name' => $params->expenses_name,
            'date' => $params->date,
            'amount' => $params->amount,
            'created_at' => Carbon::now(),
        ]);

    }

    // findById data
    public function findById($id)
    {
        return Expense::find($id);
    }

    //Filter data
    public function filterExpenseData($params)
    {
        $expense = new Expense();

        if (!empty($params->name)) {
            $name = $params->name;
            $expense = $expense->where('first_name', 'LIKE', '%' . $name . '%')->orWhere('last_name', 'LIKE', '%' . $name . '%')->orWhere('mobile_number', 'LIKE', '%' . $name . '%');
        }

        return $expense->latest()->paginate(config('constants.PER_PAGE'));
    }

}
