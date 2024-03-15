<?php

namespace App\Http\Controllers\Compensation;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\dtr;
use App\Models\Employee;
use App\Models\EmployeeLeave;
use App\Models\JobsAvailable;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;

class CompensationController extends Controller
{
    public function index()
    {
        if(Gate::denies('for-compensation')){
            abort(403);
        }

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
            "num_applicants" => $NumOfApplicants,
            "num_onleave" => $NumOnLeave,
            "part_time" => $PTJobs,
            "full_time" => $FTJobs,
        ]);
    }

    public function leave_request(){
        $leaves = EmployeeLeave::join('employees', 'employees.id', '=', 'employee_leaves.emp_id')
                                ->join('jobs_availables', 'jobs_availables.id', '=', 'employees.job_id')
                                ->get([
                                    'employee_leaves.start_date',
                                    'employee_leaves.end_date',
                                    'employee_leaves.type',
                                    'employee_leaves.leave_form',
                                    'employee_leaves.remarks',
                                    'employees.name', 
                                    'jobs_availables.status',
                                    'jobs_availables.dept',
                                ]);

        return view('hr.leave-request', compact('leaves'));
    }

    public function leave_list(){
        $leaves = EmployeeLeave::where('employee_leaves.remarks', 'Approved')
                                ->whereMonth('employee_leaves.start_date', Carbon::now()->month)
                                ->whereYear('employee_leaves.start_date', Carbon::now()->year)
                                ->join('employees', 'employees.id', '=', 'employee_leaves.emp_id')
                                ->join('jobs_availables', 'jobs_availables.id', '=', 'employees.job_id')
                                ->get([
                                    'employee_leaves.start_date',
                                    'employee_leaves.end_date',
                                    'employee_leaves.type',
                                    'employee_leaves.leave_form',
                                    'employee_leaves.remarks',
                                    'employees.name', 
                                    'jobs_availables.status',
                                    'jobs_availables.dept',
                                ]);

        return view('hr.leave-list', [
            'leaves' => $leaves,
        ]);
    }

    public function time_keeping(){
        $data = dtr::whereMonth('date', Carbon::now()->month)
                    ->whereYear('date', Carbon::now()->year)
                    ->join('employees', 'employees.id', '=', 'dtrs.emp_id')
                    ->get([
                        'dtrs.emp_id',
                        'dtrs.date',
                        'dtrs.absent',
                        'dtrs.undertime',
                        'dtrs.overtime',
                        'dtrs.late',
                        'employees.name',
                    ]);
        return view('hr.time-keeping', compact('data'));
    }

    public function dtr(){

        $month = Carbon::now()->month;
        return view('hr.dtr-absent', [
            'month' => date("F", mktime(0, 0, 0, $month)),
        ]);
    }

    public function leave_credit(){
        $dtr = dtr::where('emp_id', request('ida'))->first();
        if($dtr == null){
            $job_id = Employee::where('id', request('ida'))->first();
            dtr::create([
                'emp_id' => request('ida'),
                'job_id' => $job_id->job_id,
                'date' => Carbon::now(),
                'absent' => request('absent'),
                'undertime' => request('undertime'),
                'late' => request('late'),
                'overtime' => request('overtime'),
            ]);
            

            $message = 'Successfully added a record!';
        }
        else{
            $message = 'Warning: duplicate record!';
        }

        return redirect()->route('time-keeping')->with('message', $message);
    }

    public function leave_credits(){

        return view('hr.leave-credit');
    }

    public function lc_computation(){
        $emp = Employee::where('id', request('ida'))->first();
        $data = dtr::where('emp_id', request('ida'))->first();
        if($data == null){
            abort(404);
        }

        return view('hr.leave-credit-computation', [
            'emp' => $emp,
            'absent' => $data->absent,
            'late' => $data->late,
            'undertime' => $data->undertime,
            'overtime' => $data->overtime,
        ]);
    }
}
