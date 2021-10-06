<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table="employees";
    protected $fillable=[
      'first_name',
      'last_name',
      'gender',
      'email',
      'mobile_number',
      'date_of_birth',
      'date_of_anniversary',
      'address',
      'city',
      'pin_code',
      'job_type',
      'commission_percentage',
      'salary',
      'commission',
      'created_at',
      'updated_at'
    ];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
    public function getCreatedAtFormattedAttribute()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y H:i');
    }
    public function getDateOfBirthFormattedAttribute()
    {
        return Carbon::parse($this->date_of_birth)->format('d-m-Y');
    }
    public function getDateOfAnniversaryFormattedAttribute()
    {
        return Carbon::parse($this->date_of_anniversary)->format('d-m-Y');
    }

}
