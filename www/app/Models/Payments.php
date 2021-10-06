<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;
    protected $table="";
    protected $fillable=[
      'invoice_id',
      'payment_date',
      'amount',
      'method',
    ];
}
