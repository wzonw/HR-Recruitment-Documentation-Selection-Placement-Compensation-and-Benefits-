<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobsAvailable extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_name',
        'job_desc',
        'status',
        'college',
        'dept',
        'salary',
        'deadline',
    ];
}
