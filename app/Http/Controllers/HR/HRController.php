<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Employee;
use App\Models\JobsAvailable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class HRController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Gate::denies('for-admins')){
            abort(403);
        }

        $NumOfApplicants = Application::all();
        $NumOfApplicants = $NumOfApplicants->count();

        $PTJobs = JobsAvailable::where('status', 'COS/JO')
                ->where('active', 'Y')
                ->get();
        $FTJobs = JobsAvailable::where('status', 'Plantilla')
                ->where('active', 'Y')
                ->get();
        return view('hr.dashboard.index', [
            "num_applicants" => $NumOfApplicants,
            "part_time" => $PTJobs,
            "full_time" => $FTJobs,
        ]);
    }

    public function emp_list()
    {
        $employees = Employee::join('jobs_availables', 'jobs_availables.id', '=', 'employees.job_id')
                            ->get([
                                'employees.id',
                                'employees.name',
                                'jobs_availables.job_name', 
                                'jobs_availables.dept', 
                                'jobs_availables.status', 
                                'jobs_availables.salary'
                            ]);

        return view('hr.view-employee-list', compact('employees'));
    }

    public function emp_detail($id)
    {
        $user = Employee::where('id', $id)->first();

        $job = JobsAvailable::where('id', $user->job_id)->first();

        return view('hr.view-employee-profile', [
            'user' => $user,
            'job' => $job,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
