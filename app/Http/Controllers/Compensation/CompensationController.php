<?php

namespace App\Http\Controllers\Compensation;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\DocuRequest;
use App\Models\documentrequest;
use App\Models\dtr;
use App\Models\EmployeeLeave;
use App\Models\dailytimerecord;
use App\Models\Employee;
use App\Models\JobsAvailable;
use App\Models\leaverequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;

class CompensationController extends Controller
{
    public function index()
    {
        /*if(Gate::denies('for-compensation')){
            abort(403);
        }*/

        $NumOfDocuReq = documentrequest::where('remarks', null)->get();
        $NumOfDocuReq = $NumOfDocuReq->count();

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
        ]);
    }

    public function leave_request(){
        $leaves = leaverequest::orderBy('leaverequests.inclusive_start_date', 'ASC')
                                ->join('employees', 'employees.employee_id', '=', 'leaverequests.employee_id')
                                ->join('jobs_availables', 'jobs_availables.id', '=', 'employees.job_id')
                                ->whereMonth('leaverequests.inclusive_start_date', Carbon::now()->month)
                                ->get([
                                    'leaverequests.employee_id',
                                    'leaverequests.inclusive_start_date',
                                    'leaverequests.inclusive_end_date',
                                    'leaverequests.type_of_leave',
                                    'leaverequests.remarks',
                                    'employees.first_name', 
                                    'employees.middle_name', 
                                    'employees.last_name', 
                                    'jobs_availables.status',
                                    'jobs_availables.college',
                                ]);

        return view('hr.leave-request', compact('leaves'));
    }

    public function leave_list(){
        $leaves = leaverequest::where('leaverequests.remarks', 'Approved')
                                ->where('leaverequests.inclusive_start_date', '<=' ,Carbon::today())
                                ->where('leaverequests.inclusive_end_date', '>=' ,Carbon::today())
                                ->join('employees', 'employees.employee_id', '=', 'leaverequests.employee_id')
                                ->join('jobs_availables', 'jobs_availables.id', '=', 'employees.job_id')
                                ->get([
                                    'leaverequests.inclusive_start_date',
                                    'leaverequests.inclusive_end_date',
                                    'leaverequests.type_of_leave',
                                    'leaverequests.remarks',
                                    'employees.first_name', 
                                    'employees.middle_name', 
                                    'employees.last_name',
                                    'jobs_availables.status',
                                    'jobs_availables.college',
                                    'jobs_availables.dept',
                                ]);

        return view('hr.leave-list', [
            'leaves' => $leaves,
        ]);
    }

    public function time_keeping(){
        $data = dailytimerecord::whereMonth('attendance_date', Carbon::now()->month)
                    ->whereYear('attendance_date', Carbon::now()->year)
                    ->join('employees', 'employees.employee_id', '=', 'dailytimerecords.employee_id')
                    ->get([
                        'dailytimerecords.employee_id',
                        'dailytimerecords.attendance_date',
                        'dailytimerecords.absent',
                        'dailytimerecords.undertime',
                        'dailytimerecords.overtime',
                        'dailytimerecords.late',
                        'employees.first_name', 
                        'employees.middle_name', 
                        'employees.last_name',
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
        $dtr = dailytimerecord::where('employee_id', $request->id)
                ->whereMonth('attendance_date', Carbon::now()->month)
                ->whereYear('attendance_date', Carbon::now()->year)
                ->first();
        
        $employee = Employee::where('employee_id', $request->id)->first();

        if($dtr == null && $employee != null){
            dailytimerecord::create([
                'employee_id' => $request->id,
                'job_id' => $employee->job_id,
                'attendance_date' => Carbon::now(),
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

    public function lc_computation(Request $request){
        $emp = Employee::where('employee_id', $request->id)->first();
        $data = dailytimerecord::where('employee_id', $request->id)
                    ->whereMonth('attendance_date', Carbon::now()->month)
                    ->whereYear('attendance_date', Carbon::now()->year)
                    ->first();
        if($data == null && $emp != null){
            $message = "Employee ID: ".$emp->employee_id." has no daily time record for the month of ".
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
                'vl' => $emp->vacation_credits,
                'sl' => $emp->sick_credits,
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
        $emp = Employee::where('employee_id', request('id'))->first();
        
        if($emp != null){
            $emp->vacation_credits = request('new_vl');
            $emp->sick_credits = request('new_sl');
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
        $employee_dtr = dailytimerecord::whereMonth('attendance_date', Carbon::now()->month)
                            ->whereYear('attendance_date', Carbon::now()->year)
                            ->get();
        $employees = employee::where('active', 'Y')->get();
        
        foreach($employee_dtr as $key=>$value){
            foreach($employees as $k=>$v){ 
                if($value->employee_id == $v->employee_id){
                    unset($employees[$k]);
                }
            }
        }

        return view('hr.leave-credit-complete-attendance', [
            'employees' => $employees,
        ]);
    }

    public function save_new_leave_credit(Request $request){
        $employee_dtr = dailytimerecord::whereMonth('attendance_date', Carbon::now()->month)
                            ->whereYear('attendance_date', Carbon::now()->year)
                            ->get();
        $employees = employee::where('active', 'Y')->get();

        foreach($employee_dtr as $dtr){
            foreach($employees as $employee){ 
                if($dtr->employee_id == $employee->employee_id){
                    unset($employees[$employee->employee_id-1]);
                }
            }
        }

        foreach($employees as $employee){
            $employee->vacation_credits = request('new_vl_'.$employee->employee_id);
            $employee->sick_credits = request('new_sl_'.$employee->employee_id);
            $employee->save();
        }
        
        $employee_records = employee::where('active', 'Y')->get();

        return view('hr.leave-credit-list', [
            'employees' => $employee_records,
        ]);
    }

    public function lc_resignation(Request $request){
        $emp = Employee::where('employee_id', $request->id)
                        //->where('first_name', 'LIKE', '%'. $request->first_name. '%')
                        //->where('last_name', 'LIKE', '%'. $request->last_name. '%')
                        ->where('active', 'Y')
                        ->first();
        if($emp == null){
            $message = 'Employee not found.';
            return redirect()->route('leave-credit')->with('message', $message);
        }
        else{
            if($request->vl != null && $request->sl == null){
                $emp->vacation_credits = $request->vl;
                $emp->save();
            }
            elseif($request->vl == null && $request->sl != null){
                $emp->sick_credits = $request->sl;
                $emp->save();
            }
            elseif($request->vl != null && $request->sl != null){
                $emp->vacation_credits = $request->vl;
                $emp->sick_credits = $request->sl;
                $emp->save();
            }

            return view('hr.leave-credit-resignation', [
                'emp' => $emp,
            ]);
        }
    }

    public function monetize_lc_resignation($id){
        $emp = Employee::where('employee_id', $id)
                        ->where('active', 'Y')
                        ->first();
        
        if($emp == null){
            $message = 'Employee not found.';
            return redirect()->route('leave-credit')->with('message', $message);
        }
        else{
            $job = JobsAvailable::where('id', $emp->job_id)->first();
            return view('hr.leave-credit-retirement', [
                'emp' => $emp,
                'job' => $job,
            ]);
        }
    }

    public function transfer_lc_resignation($id){
        $emp = Employee::where('employee_id', $id)
                        ->where('active', 'Y')
                        ->first();
        
        if($emp == null){
            $message = 'Employee not found.';
            return redirect()->route('leave-credit')->with('message', $message);
        }
        else{
            $job = JobsAvailable::where('id', $emp->job_id)->first();
            return view('hr.leave-credit-resignation-transfer', [
                'emp' => $emp,
                'job' => $job,
            ]);
        }
    }

    public function monetize_lc_retirement(Request $request){
        $emp = Employee::where('employee_id', $request->id)
                        //->where('first_name', 'LIKE', '%'. $request->first_name. '%')
                        //->where('last_name', 'LIKE', '%'. $request->last_name. '%')
                        ->where('active', 'Y')
                        ->first();
        
        if($emp == null){
            $message = 'Employee not found.';
            return redirect()->route('leave-credit')->with('message', $message);
        }
        else{
            $job = JobsAvailable::where('id', $emp->job_id)->first();
            return view('hr.leave-credit-retirement', [
                'emp' => $emp,
                'job' => $job,
            ]);
        }
    }

    public function download_file($id){
        $emp = Employee::where('employee_id', $id)
                        ->where('active', 'Y')
                        ->first();
        $job = JobsAvailable::where('id', $emp->job_id)->first();

        $pdf = Pdf::loadView('hr.pdf.lc-monetization-retirement', [
            'emp' => $emp,
            'job' => $job,
        ]);

        return $pdf->stream();
    }

    public function download_file_transfer($id){
        $emp = Employee::where('employee_id', $id)
                        ->where('active', 'Y')
                        ->first();
        $job = JobsAvailable::where('id', $emp->job_id)->first();

        $pdf = Pdf::loadView('hr.pdf.lc-transfer-resignation', [
            'emp' => $emp,
            'job' => $job,
        ]);

        return $pdf->stream();
    }
    
    public function leave_search(Request $request)
    {
        $leave_search = $request->input ('query');

        $leaves = leaverequest::join('employees', 'employees.employee_id', '=', 'leaverequests.employee_id')
        ->join('jobs_availables', 'jobs_availables.id', '=', 'employees.job_id')
        ->where('employees.name','LIKE', '%' . $leave_search . '%')
        ->orWhere('jobs_availables.status','LIKE', '%' . $leave_search . '%')
                            ->get();

        return view('hr.leave-list', compact('leaves')); 
    }

    public function lr_search(Request $request)
    {
        $lr_search = $request ->input('query');

        $leaves = leaverequest::orderBy('leaverequests.inclusive_start_date', 'ASC')
                                ->join('employees', 'employees.employee_id', '=', 'leaverequests.employee_id')
                                ->join('jobs_availables', 'jobs_availables.id', '=', 'employees.job_id')
                                ->whereMonth('leaverequests.inclusive_start_date', Carbon::now()->month)
                                ->where('employees.name','LIKE', '%' . $lr_search . '%')
                                ->orWhere('jobs_availables.status','LIKE', '%' . $lr_search . '%')
                                ->get();

        return view('hr.leave-request', compact('leaves'));
    }

    public function tk_filter(Request $request)
    {
        $query = dailytimerecord::join('employees', 'employees.employee_id', '=', 'dailytimerecords.employee_id');
    
        if ($request->filled('date')) {
            $query->whereDate('dailytimerecords.attendance_date', $request->input('date'));
        } else {
            $query->whereMonth('dailytimerecords.date', Carbon::now()->month)
                  ->whereYear('dailytimerecords.date', Carbon::now()->year);
        }
    
        $data = $query->get();
    
        return view('hr.time-keeping', compact('data'));
    }
    
}