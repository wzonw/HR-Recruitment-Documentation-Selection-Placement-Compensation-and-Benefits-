<?php

namespace App\Http\Controllers\PM;

use App\Events\DocumentRequestNotif;
use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\DocuRequest;
use App\Models\Employee;
use App\Models\EmployeeLeave;
use App\Models\JobsAvailable;
use App\Models\User;
use App\Notifications\DocumentReqNotif;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PMController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Gate::denies('for-pm')){
            abort(403);
        }

        $NumOfDocuReq = DocuRequest::where('remarks', null)->get();
        $NumOfDocuReq = $NumOfDocuReq->count();

        $NumOfApplicants = Application::all();
        $NumOfApplicants = $NumOfApplicants->count();

        $NumOnLeave = EmployeeLeave::where('remarks', 'Approved')
                                    ->where('start_date', '<=' ,Carbon::today())
                                    ->where('end_date', '>=' ,Carbon::today());
        $NumOnLeave = $NumOnLeave->count();

        $PTJobs = JobsAvailable::where('status', 'COS/JO')
                ->where('active', 'Y')
                ->get();
        $FTJobs = JobsAvailable::where('status', 'Plantilla')
                ->where('active', 'Y')
                ->get();
        return view('hr.dashboard.index', [
            "num_reqs" => $NumOfDocuReq,
            "num_applicants" => $NumOfApplicants,
            "num_onleave" => $NumOnLeave,
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
                                'jobs_availables.college',  
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

        $leaves = EmployeeLeave::where('emp_id', $id)->get();

        return view('hr.view-employee-profile', [
            'user' => $user,
            'job' => $job,
            'leaves' => $leaves,
        ]);
    }

    public function document_request(){
        $requests = DocuRequest::where('remarks', null)->get();
        return view('hr.view-request', [
            'requests' => $requests,
        ]);
    }

    public function notify_emp($id){
        $employee = DocuRequest::where('emp_id', $id)
                                ->where('remarks', null)
                                ->first();  
        if($employee != null){
            $employee->remarks = 'done';
            $employee->save();

            event(new DocumentRequestNotif($employee));
            
            $message = 'notified employee about request.';
        }
        else{
            $message = 'employee request is not found.';
        }
        return redirect()->route('view-request')->with('message', $message);
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
