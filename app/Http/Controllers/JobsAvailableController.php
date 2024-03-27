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
        $job_name = $request ->input('position');
        $college = $request ->input('placement');

        $jobs = JobsAvailable::where('active', 'Y')
                            ->where('status', 'LIKE', '%'.$status.'%')
                            ->where('college','LIKE','%'.$college.'%')
                            ->where('job_name','LIKE','%'.$job_name.'%')
                            ->paginate(5);
        
        return view('livewire.job-table-filtered', compact('jobs'));
    }

}
