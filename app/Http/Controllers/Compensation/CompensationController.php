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
                                ->where('start_date', '<=' ,Carbon::today())
                                ->where('end_date', '>=' ,Carbon::today())
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
        return view('hr.dtr-add-record', [
            'month' => date("F", mktime(0, 0, 0, $month)),
        ]);
    }

    public function add_record(Request $request){
        $dtr = dtr::where('emp_id', $request->id)
                ->whereMonth('date', Carbon::now()->month)
                ->first();
        
        $employee = Employee::where('id', $request->id)->first();

        if($dtr == null && $employee != null){
            dtr::create([
                'emp_id' => $request->id,
                'job_id' => $employee->job_id,
                'date' => Carbon::now(),
                'absent' => $request->absent,
                'undertime' => $request->undertime,
                'late' => $request->late,
                'overtime' => $request->overtime,
            ]);
            

            $message = 'Successfully added a record.';
        }
        elseif($employee == null){
            $message = 'Employee ID not found.';
        }
        elseif($dtr != null && $employee != null){
            $dtr->absent = $request->absent;
            $dtr->undertime = $request->undertime;
            $dtr->late = $request->late;
            $dtr->overtime = $request->overtime;
            $dtr->save();
            $message = 'Successfully updated a record.';
        }
        else{
            $message = 'There is an error.';
        }

        return redirect()->route('add-dtr')->with('message', $message);
    }

    public function lc_computation(){
        $emp = Employee::where('id', request('id'))->first();
        $data = dtr::where('emp_id', request('id'))
                    ->first();
        if($data == null){
            abort(404);
        }

        return view('hr.leave-credit-computation', [
            'emp' => $emp,
            'vl' => $emp->vl_credit,
            'sl' => $emp->sl_credit,
            'absent' => $data->absent,
            'late' => $data->late,
            'undertime' => $data->undertime,
            'overtime' => $data->overtime,
            'cto' => $data->cto,
            'remarks' => $data->remarks,
        ]);
    }
}
