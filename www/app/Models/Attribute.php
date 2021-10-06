<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $table = "attribute_size";
    protected $fillable = [
        "size"
    ];

    public function getCreatedAtFormattedAttribute()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y H:i');
    }

}
