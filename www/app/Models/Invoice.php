<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table = "invoices";
    protected $fillable = [
      'product_id',
      'employee_id',
      'name',
      'email',
      'mobile',
      'invoicedate',
      'duedate',
      'items',
      'subtotal',
      'tax',
      'discount_type',
      'discount',
      'discount_value',
      'amount',
      'paid',
      'due',
      'note',
      'method',
      'invoice_type',
      'status'
    ];

    public function getCreatedAtFormattedAttribute()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y h:i');
    }
    public function getInvoiceDateFormattedAttribute()
    {
        return Carbon::parse($this->invoicedate)->format('d-m-Y');
    }
    public function employees(){
        return $this->belongsTo('App\Models\Employee','employee_id');
    }
}
