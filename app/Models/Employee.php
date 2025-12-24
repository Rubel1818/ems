<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'employee_id',
        'photo',
        'name_bn',
        'name_en',
        'designation_bn',
        'designation_en',
        'present_address_bn',
        'present_address_en',
        'permanent_address_bn',
        'permanent_address_en',
        'office_name',
        'office_duration',
        'joining_date',
        'confirmation_date',
        'service_book',
    ];
}
