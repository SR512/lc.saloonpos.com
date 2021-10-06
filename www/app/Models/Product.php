<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable=[
        'product_name',
        'serial_number',
        'status',
        'created_at',
        'updated_at'
    ];

    public function getCreatedAtFormattedAttribute()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y H:i');
    }

    public function stocks(){
        return $this->hasMany('App\Models\Stocks','product_id','id');
    }

}
