<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    use HasFactory;
<<<<<<< HEAD
=======
    
    protected $fillable = [
        'employee_id',
        'job_id',
        'employee_type',
        'school_email',
        'first_name',
        'middle_name',
        'last_name',
        'age',
        'gender',
        'personal_email',
        'phone',
        'birth_date',
        'address',
        'start_of_employment',
        'current_position',
        'is_faculty',
        'salary',
    ];
    protected $primaryKey = 'employee_id';
>>>>>>> refs/remotes/origin/hr_0604
}
