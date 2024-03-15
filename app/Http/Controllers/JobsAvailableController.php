<?php

namespace App\Http\Controllers;

use App\Models\JobsAvailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class JobsAvailableController extends Controller
{
    public function index()
    {
        if(Gate::denies('for-applicants')){
            abort(403);
        }
        
        return view('jobs-available');
    }

}
