<?php

namespace App\Models;

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
}
