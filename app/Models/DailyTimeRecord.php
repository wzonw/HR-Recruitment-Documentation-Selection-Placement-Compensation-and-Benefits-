<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dailytimerecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'attendance_date',
        'employee_id',
        'job_id',
        'date',
        'absent',
        'undertime',
        'late',
        'overtime',
        'vl_used',
        'sl_used',
        'remarks',
    ];

    protected $primaryKey = 'employee_id';
}
