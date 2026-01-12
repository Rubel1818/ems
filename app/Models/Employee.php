<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        'present_district',
        'permanent_address_bn',
        'permanent_address_en',
        'permanent_district',
        'birth_date',
        'office_name',
        'office_duration',
        'joining_date',
        'confirmation_date',
        'service_book',
        'status',
        'approved_at',
        'approved_by',
        'district_id',
        'stuff_designation_id',
        'section_id',
        'user_id',
    ];
    // Employee belongs to District
    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function stuffDesignation()
    {
        return $this->belongsTo(StuffDesignation::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'birth_date' => 'date',
    ];

    // 🔥 PRL = birth_date + 58 years
    protected $appends = ['prl_date'];

    public function getPrlDateAttribute()
    {
        return $this->birth_date
            ? $this->birth_date->copy()->addYears(58)
            : null;
    }
    public function histories()
    {
        return $this->hasMany(History::class);
    }
}
