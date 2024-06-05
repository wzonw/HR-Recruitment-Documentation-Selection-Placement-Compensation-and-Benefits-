<?php

namespace App\Http\Controllers\PM;

use App\Events\DocumentRequestNotif;
use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\DocuRequest;
use App\Models\Employee;
use App\Models\EmployeeLeave;
use App\Models\JobsAvailable;
use App\Models\leaverequest;
use App\Models\User;
use App\Notifications\DocumentReqNotif;
use Barryvdh\DomPDF\Facade\Pdf;
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
        /*
        if(Auth::user()->id == 4){
            return redirect()->route('dashboard-chief');
        }
        elseif(Auth::user()->id > 4){
            $applicant = Application::orderBy('created_at', 'desc')
                                    ->where('email', Auth::user()->email)
                                    ->first();
            if($applicant->remarks != 'Employee'){
                return redirect()->route('dashboard-applicant');
            }
        }
        */

        $NumOfDocuReq = DocuRequest::where('remarks', null)->get();
        $NumOfDocuReq = $NumOfDocuReq->count();

        $NumOfEmp = Employee::where('active', 'Y')->get();
        $NumOfEmp = $NumOfEmp->count();

        $NumOfApplicants = Application::all();
        $NumOfApplicants = $NumOfApplicants->count();

        $NumOnLeave = leaverequest::where('remarks', 'Approved')
                                    ->where('inclusive_start_date', '<=' ,Carbon::today())
                                    ->where('inclusive_end_date', '>=' ,Carbon::today());
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
            "selected_college" => '',
            "num_employees" => $NumOfEmp,
        ]);
    }

    public function update_index(Request $request)
    {
        $NumOfDocuReq = DocuRequest::where('remarks', null)->get();
        $NumOfDocuReq = $NumOfDocuReq->count();

        if($request->college == 'null'){
            return redirect()->route('dashboard');
        }
        else{
            $NumOfEmp = Employee::join('jobs_availables', 'jobs_availables.id', '=', 'employees.job_id')
                                ->where('employees.active', 'Y')
                                ->where('jobs_availables.college', $request->college)
                                ->get([
                                    'jobs_availables.college',
                                ]);
            $NumOfEmp = $NumOfEmp->count();
        }

        $NumOfApplicants = Application::all();
        $NumOfApplicants = $NumOfApplicants->count();

        $NumOnLeave = leaverequest::where('remarks', 'Approved')
                                    ->where('inclusive_start_date', '<=' ,Carbon::today())
                                    ->where('inclusive_end_date', '>=' ,Carbon::today());
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
            "selected_college" => $request->college,
            "num_employees" => $NumOfEmp,
        ]);
    }

    public function emp_list()
    {
        $employees = Employee::join('jobs_availables', 'jobs_availables.id', '=', 'employees.job_id')
                            ->get([
                                'employees.employee_id',
                                'employees.first_name',
                                'employees.last_name',
                                'employees.middle_name',
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
        $user = Employee::where('employee_id', $id)->first();

        $job = JobsAvailable::where('id', $user->job_id)->first();

        $leaves = leaverequest::where('employee_id', $id)->get();

        $files = Application::where('email', $user->personal_email)->first();

        $files->file = json_decode($files->file);

        return view('hr.view-employee-profile', [
            'user' => $user,
            'job' => $job,
            'leaves' => $leaves,
            'files' => $files,
        ]);
    }

    public function document_request(){
        $requests = DocuRequest::where('remarks', null)->get();
        return view('hr.view-request', [
            'requests' => $requests,
        ]);
    }

    public function notify_emp($id){
        $employee = DocuRequest::where('employee_id', $id)
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

    public function export_document_1($id){
        $data = Employee::where('employee_id', $id)
                        ->where('active', 'Y')
                        ->first();
        $job = JobsAvailable::where('id', $data->job_id)->first();

        $day = date('j', strtotime(NOW()));
        
        if($day == 1){
            $day = $day.'st';
        }
        elseif($day == 2){
            $day = $day.'nd';
        }
        elseif($day == 3){
            $day = $day.'rd';
        }
        else{
            $day = $day.'th';
        }

        $pdf = Pdf::loadView('hr.pdf.cert-of-employment', [
            'data' => $data,
            'job' => $job,
            'day' => $day,
        ]);
 
        return $pdf->stream();
    }

    public function export_document_2($id){
        $data = Employee::where('employee_id', $id)
                        ->where('active', 'Y')
                        ->first();
        $job = JobsAvailable::where('id', $data->job_id)->first();

        $day = date('j', strtotime(NOW()));
        
        if($day == 1){
            $day = $day.'st';
        }
        elseif($day == 2){
            $day = $day.'nd';
        }
        elseif($day == 3){
            $day = $day.'rd';
        }
        else{
            $day = $day.'th';
        }

        $pdf = Pdf::loadView('hr.pdf.cert-of-employment-w-compensation', [
            'data' => $data,
            'job' => $job,
            'day' => $day,
        ]);
 
        return $pdf->stream();
    }

    public function emp_search(Request $request)
    {
        $emp_search = $request->input('query');
    
        $employees = Employee::join('jobs_availables', 'jobs_availables.id', '=', 'employees.job_id')
            ->where('employees.name', 'LIKE', '%' . $emp_search . '%')
            ->orWhere('jobs_availables.job_name', 'LIKE', '%' . $emp_search . '%')
            ->orWhere('jobs_availables.status', 'LIKE', '%' . $emp_search . '%')
            ->orWhere('jobs_availables.dept', 'LIKE', '%' . $emp_search . '%')
            ->get([
                'employees.employee_id',
                'employees.first_name',
                'employees.last_name',
                'employees.middle_name',
                'jobs_availables.job_name', 
                'jobs_availables.college',  
                'jobs_availables.dept', 
                'jobs_availables.status', 
                'jobs_availables.salary'
            ]);
    
        return view('hr.view-employee-list', compact('employees'));
    }

    public function req_search (Request $request)
    {
        $req_search = $request->input('query');

        $requests = DocuRequest::where('name','LIKE', '%' . $req_search . '%')
        ->orWhere('documents','LIKE', '%' . $req_search . '%')
        ->get();

        return view('hr.view-request', [
            'requests' => $requests,
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