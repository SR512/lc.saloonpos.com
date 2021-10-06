<?php

namespace App\Exports;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeeCommission implements FromCollection, WithHeadings
{
    private $params;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return new Collection([$this->params]);
    }

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function headings(): array
    {
        $column = ['Name', 'Invoice date', 'Amount', 'Commission', 'Commission amount'];
        return $column;
    }

}
