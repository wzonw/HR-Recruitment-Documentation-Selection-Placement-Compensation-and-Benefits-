<?php

namespace App\Http\Controllers;

use App\Models\JobsAvailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class JobsAvailableController extends Controller
{
    public function index()
    {
        return view('jobs-available');
    }

    public function search(Request $request)
    {
        $status = $request->input('status');
        $job_name = $request -> input('job_name');
        $college = $request -> input('college');

        $jobs = JobsAvailable::where('status', 'LIKE', '%'.$status.'%')
        ->where('job_name','LIKE','%' .$job_name.'%')
        ->where('college','LIKE','%' .$college.'%')
        ->paginate(50);  
        
        return view('livewire.job-table-filtered', compact('jobs'));
    }

}
