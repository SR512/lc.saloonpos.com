<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    protected $table = "memberships";
    protected $fillable = [
        'membership_no',
        'customer_id',
        'package_id',
        'packagedetail',
        'end_date',
        'status',
        'created_at',
        'updated_At',
    ];

    public function customers(){
        return $this->belongsTo('App\Models\Customer','customer_id');
    }
    public function packages(){
        return $this->belongsTo('App\Models\Package','package_id');
    }
    public function getCreatedAtFormattedAttribute()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y H:i');
    }

    public function getEndDateAtFormattedAttribute()
    {
        return Carbon::parse($this->end_date)->format('d-m-Y');
    }
}
