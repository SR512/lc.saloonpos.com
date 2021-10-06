<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $table="appointments";
    protected $fillable=[
        'customer_id',
        'service_id',
        'employee_id',
        'appointment_date_time',
        'appointment_status',
        'created_at',
        'updated_at'
    ];
}
