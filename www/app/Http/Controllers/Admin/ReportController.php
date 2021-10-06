<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\ReportRequest;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class ReportController extends Controller
{

    public function index()
    {
        $employees = Employee::where('job_type', '!=', 'SALARIED')->get()->pluck('full_name', 'id');
        return view('report.report', compact('employees'));
    }

    // Export Expense
    public function exportExpense(Request $request)
    {
        $params = [];
        $params[] = $request->start_date;
        $params[] = $request->end_date;

        if ($request->report_type == 'expense') {
            return Excel::download(new \App\Exports\Expense($params), Carbon::now()->format('d-m-y H:i:s') . '_expense.xlsx');
        }
        if ($request->report_type == 'seller-invoice') {
            return Excel::download(new \App\Exports\SellertInvoice($params,$request->status), Carbon::now()->format('d-m-y H:i:s') . '_expense.xlsx');
        }
        if ($request->report_type == 'employee-commission') {

            $commisonData = [];
            $invoices = \App\Models\Invoice::select('employee_id', 'invoicedate', 'amount')->where('employee_id', $request->employee)->where('invoice_type', 'CUSTOMER')->whereBetween('invoicedate', $params)->get();

            foreach ($invoices as $key => $invoice) {
                $commisonData[$key]['name'] = $invoice->employees->full_name;
                $commisonData[$key]['Date'] = $invoice->invoicedate;
                $commisonData[$key]['amount'] = $invoice->amount;
                $commisonData[$key]['commission'] = $invoice->employees->commission_percentage;
                $commisonData[$key]['commission_amount'] = floor(($invoice->amount * $invoice->employees->commission_percentage) / 100);
            }

            return Excel::download(new \App\Exports\EmployeeCommission($commisonData), Carbon::now()->format('d-m-y H:i:s') . '_employee_commission.xlsx');

        }
        return Excel::download(new \App\Exports\CustomerInvoice($params,$request->status), Carbon::now()->format('d-m-y H:i:s') . '_customer_invoice.xlsx');
    }
}

