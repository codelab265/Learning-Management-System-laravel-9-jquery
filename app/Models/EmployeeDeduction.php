<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDeduction extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function deduction()
    {
        return $this->belongsTo(Deduction::class, 'deduction_id');
    }
}