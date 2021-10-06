<?php


namespace App\Repositories;


use App\Models\Attribute;
use App\Models\Invoice;
use App\Models\Stocks;
use Carbon\Carbon;

class SellerInvoiceRepository
{
    //get invoice
    public function getInvoice()
    {
        return Invoice::where('invoice_type', 'SELLER')->latest();
    }

    // Create New Recoard
    public function create($params)
    {
        $invoice = Invoice::create([
            'product_id' => '1',
            'employee_id' => $params['employee'],
            'name' => $params['name'],
            'email' => $params['email'],
            'mobile' => $params['mobile'],
            'invoicedate' => $params['invoicedate'],
            'duedate' => $params['duedate'],
            'items' => json_encode($params['item']),
            'subtotal' => $params['subtotal'],
            'tax' => $params['tax'],
            'discount_type' => $params['discounttype'],
            'discount' => $params['discount'],
            'discount_value' => $params['discount_value'],
            'amount' => $params['amount'],
            'paid' => $params['paid'],
            'due' => $params['due'],
            'note' => $params['note'],
            'method' => $params['method'],
            'invoice_type' => 'SELLER',
            'status' => $params['status'],
            'created_at' => Carbon::now()
        ]);

        if (!empty($invoice)) {
            foreach ($params['item'] as $item) {
                $stocks = Stocks::find($item['size_id']);

                if (!empty($stocks)) {
                    $stocks->quantity = ($stocks->quantity) - $item['quantity'];
                    $stocks->save();
                }
            }
        }

        return $invoice;
    }

    // Update New Recoard
    public function update($id, $params)
    {
        return Invoice::findorfail($id)->update([
            'product_id' => '1',
            'employee_id' => $params['employee'],
            'name' => $params['name'],
            'email' => $params['email'],
            'mobile' => $params['mobile'],
            'invoicedate' => $params['invoicedate'],
            'duedate' => $params['duedate'],
            'items' => json_encode($params['item']),
            'subtotal' => $params['subtotal'],
            'tax' => $params['tax'],
            'discount_type' => $params['discounttype'],
            'discount' => $params['discount'],
            'discount_value' => $params['discount_value'],
            'amount' => $params['amount'],
            'paid' => $params['paid'],
            'due' => $params['due'],
            'note' => $params['note'],
            'method' => $params['method'],
            'invoice_type' => 'SELLER',
            'status' => $params['status'],
            'updated_at' => Carbon::now()
        ]);

    }

    // findById data
    public function findById($id)
    {
        return Invoice::find($id);
    }

    //Filter data
    public function filterInvoiceData($params)
    {
        $invoice = new Invoice();

        if (!empty($params->name)) {
            $name = $params->name;
            //$invoice = $invoice->where('size', 'LIKE', '%' . $name . '%');
        }

        return $invoice->latest()->paginate(config('constants.PER_PAGE'));
    }

}
