<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = [
        'employee_id',
        'section_id',
        'designation_id',
        'start_date',
        'end_date'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function designation()
    {
        return $this->belongsTo(StuffDesignation::class);
    }
}
