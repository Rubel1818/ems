<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StuffDesignation extends Model
{
    use HasFactory;

    protected $fillable = [
        'designation_name_bn',
        'designation_name_en',
    ];
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
