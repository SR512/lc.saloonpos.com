<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table="customers";
    protected $fillable = [
      "first_name",
      "last_name",
      "email",
      "mobile_number",
      "date_of_birth",
      "date_of_anniversary",
      "address",
      "city",
      "pin_code",
      "status",
      "created_at",
      "updated_at"
    ];

    public $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'nullable|email',
        'mobile_number' => 'required|numeric|digits:10|unique:customers'
    ];

    public $update_rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'nullable|email',
        'mobile_number' => 'required|numeric|digits:10'
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
