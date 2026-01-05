<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = [
        'district_name_bn',
        'district_name_en',
    ];

    // Relationship: District has many employees
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
