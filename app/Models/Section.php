<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;
    protected $fillable = [
        'section_name_bn',
        'section_name_en',
    ];

    // One Section has many Employees
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
