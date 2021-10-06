<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $table = 'expenses';
    protected $fillable=[
        'expenses_name',
        'date',
        'amount',
        'created_at',
        'updated_at'
    ];

    public function getCreatedAtFormattedAttribute()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y H:i');
    }

    public function getDateAtFormattedAttribute()
    {
        return Carbon::parse($this->date)->format('d-m-Y');
    }
}
