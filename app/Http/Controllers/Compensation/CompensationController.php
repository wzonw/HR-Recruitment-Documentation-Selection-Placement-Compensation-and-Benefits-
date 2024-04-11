<?php

namespace App\Http\Controllers\Compensation;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\DocuRequest;
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

    public function leave_request(){
        $leaves = EmployeeLeave::orderBy('employee_leaves.start_date', 'ASC')
                                ->join('employees', 'employees.id', '=', 'employee_leaves.emp_id')
                                ->join('jobs_availables', 'jobs_availables.id', '=', 'employees.job_id')
                                ->whereMonth('employee_leaves.start_date', Carbon::now()->month)
                                ->get([
                                    'employee_leaves.emp_id',
                                    'employee_leaves.start_date',
                                    'employee_leaves.end_date',
                                    'employee_leaves.type',
                                    'employee_leaves.leave_form',
                                    'employee_leaves.remarks',
                                    'employees.name', 
                                    'jobs_availables.status',
                                    'jobs_availables.college',
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
                                    'jobs_availables.college',
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
                ->whereYear('date', Carbon::now()->year)
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
                'remarks' => $request->remarks,
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
            $dtr->remarks = $request->remarks;
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
                    ->whereMonth('date', Carbon::now()->month)
                    ->whereYear('date', Carbon::now()->year)
                    ->first();
        if($data == null && $emp != null){
            $message = "Employee ID: ".$emp->id." has no daily time record for the month of ".
                        date('F', strtotime(Carbon::now()));
            return redirect()->route('leave-credit')->with('message', $message);
        }
        elseif($emp == null){
            $message = "Employee ID not found.";
            return redirect()->route('leave-credit')->with('message', $message);
        }
        else{
            return view('hr.leave-credit-computation', [
                'emp' => $emp,
                'vl' => $emp->vl_credit,
                'sl' => $emp->sl_credit,
                'vl_used' => $data->vl_used,
                'sl_used' => $data->sl_used,
                'absent' => $data->absent,
                'late' => $data->late,
                'undertime' => $data->undertime,
                'overtime' => $data->overtime,
                'cto' => $data->cto,
                'remarks' => $data->remarks,
            ]);
        }
    }
    
    public function lc_computation_save(){
        $emp = Employee::where('id', request('id'))->first();
        
        if($emp != null){
            $emp->vl_credit = request('new_vl');
            $emp->sl_credit = request('new_sl');
            $emp->cto = request('new_cto');
            $emp->save();

            $emp = array($emp);
            return view('hr.leave-credit-list', [
                'employees' => $emp,
            ]);
        }
        else{
            $message = "Employee ID not found.";
            return redirect()->route('leave-credit')->with('message', $message);
        }
    }

    public function lc_computation_complete_attendance(){
        $employee_dtr = dtr::whereMonth('date', Carbon::now()->month)
                            ->whereYear('date', Carbon::now()->year)
                            ->get();
        $employees = Employee::where('active', 'Y')->get();
        
        foreach($employee_dtr as $dtr){
            foreach($employees as $employee){ 
                if($dtr->emp_id == $employee->id){
                    unset($employees[$employee->id-1]);
                }
            }
        }

        return view('hr.leave-credit-complete-attendance', [
            'employees' => $employees,
        ]);
    }

    public function save_new_leave_credit(Request $request){
        $employee_dtr = dtr::whereMonth('date', Carbon::now()->month)
                            ->whereYear('date', Carbon::now()->year)
                            ->get();
        $employees = Employee::where('active', 'Y')->get();

        foreach($employee_dtr as $dtr){
            foreach($employees as $employee){ 
                if($dtr->emp_id == $employee->id){
                    unset($employees[$employee->id-1]);
                }
            }
        }

        foreach($employees as $employee){
            $employee->vl_credit = request('new_vl_'.$employee->id);
            $employee->sl_credit = request('new_sl_'.$employee->id);
            $employee->save();
        }
        
        $employee_records = Employee::where('active', 'Y')->get();

        return view('hr.leave-credit-list', [
            'employees' => $employee_records,
        ]);
    }
    public function leave_search(Request $request)
    {
        $leave_search = $request->input ('query');

        $leaves = EmployeeLeave::join('employees', 'employees.id', '=', 'employee_leaves.emp_id')
        ->join('jobs_availables', 'jobs_availables.id', '=', 'employees.job_id')
        ->where('employees.name','LIKE', '%' . $leave_search . '%')
        ->orWhere('jobs_availables.status','LIKE', '%' . $leave_search . '%')
                            ->get();

        return view('hr.leave-list', compact('leaves')); 
    }

    public function lr_search(Request $request)
    {
        $lr_search = $request ->input('query');

        $leaves = EmployeeLeave::orderBy('employee_leaves.start_date', 'ASC')
                                ->join('employees', 'employees.id', '=', 'employee_leaves.emp_id')
                                ->join('jobs_availables', 'jobs_availables.id', '=', 'employees.job_id')
                                ->whereMonth('employee_leaves.start_date', Carbon::now()->month)
                                ->where('employees.name','LIKE', '%' . $lr_search . '%')
                                ->orWhere('jobs_availables.status','LIKE', '%' . $lr_search . '%')
                                ->get();

        return view('hr.leave-request', compact('leaves'));
    }

    public function tk_filter(Request $request)
    {
        $query = dtr::join('employees', 'employees.id', '=', 'dtrs.emp_id');
    
        if ($request->filled('date')) {
            $query->whereDate('dtrs.date', $request->input('date'));
        } else {
            $query->whereMonth('dtrs.date', Carbon::now()->month)
                  ->whereYear('dtrs.date', Carbon::now()->year);
        }
    
        $data = $query->get();
    
        return view('hr.time-keeping', compact('data'));
    }
    
}