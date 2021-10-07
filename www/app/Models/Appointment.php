<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function getCreatedAtFormattedAttribute()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y H:i');
    }

    public function getDateAtFormattedAttribute()
    {
        return Carbon::parse($this->appointment_date_time)->format('d-m-Y H:i:s');
    }

    public function customers(){
        return $this->belongsTo('App\Models\Customer','customer_id');
    }
    public function services(){
        return $this->belongsTo('App\Models\Service','service_id');
    }
    public function employees(){
        return $this->belongsTo('App\Models\Employee','employee_id');
    }
}
