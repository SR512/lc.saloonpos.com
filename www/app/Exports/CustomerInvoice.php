<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomerInvoice implements FromCollection,WithHeadings
{
    private $params;
    private $status;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct($params,$status)
    {
        $this->params = $params;
        $this->status = $status;
    }
    public function headings(): array
    {
        $column = ['Name','Email','Mobile','Invoice date','Subtotal','Tax','Discount type','Discount','Discount_value','Amount','Paid','Due','Method','status'];
        return $column;
    }

    public function collection()
    {
        return \App\Models\Invoice::select('name','email','mobile','invoicedate','subtotal','tax','discount_type','discount','discount_value','amount','paid','due','method','status')->where('invoice_type','CUSTOMER')->whereBetween('invoicedate', $this->params)->where('status',$this->status)->get();
    }

}
