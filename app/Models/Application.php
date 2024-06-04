<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'job_id',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'contact_number',
        'file'
    ];
}
