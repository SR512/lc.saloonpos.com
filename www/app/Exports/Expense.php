<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Expense implements FromCollection, WithHeadings
{
    private $params;

    /**
     * Expense constructor.
     */
    public function __construct($params)
    {
        $this->params = $params;
    }

    public function headings(): array
    {
        $column = ['Expenses name', 'Date', 'Amount', 'created_at'];
        return $column;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return \App\Models\Expense::select('expenses_name', 'date', 'amount', 'created_at')->whereBetween('date', $this->params)->get();
    }
}
