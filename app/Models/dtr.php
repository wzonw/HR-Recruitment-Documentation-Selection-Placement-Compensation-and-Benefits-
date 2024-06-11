<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dtr extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'job_id',
        'attendance_date',
        'absent',
        'undertime',
        'late',
        'cto',
        'overtime',
        'vl_used',
        'sl_used',
        'remarks',
    ];
}
