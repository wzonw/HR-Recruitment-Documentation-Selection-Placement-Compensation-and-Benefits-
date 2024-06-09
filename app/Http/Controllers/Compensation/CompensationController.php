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
                                    'leaverequests.office_department',
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

    public function dtr_report_generate(){
        $data = dtr::where('date', date('Y-m-d', strtotime(Carbon::now())))
                    ->join('employees', 'employees.employee_id', '=', 'dtrs.employee_id')
                    ->get([
                        'dtrs.employee_id',
                        'dtrs.date',
                        'dtrs.absent',
                        'dtrs.undertime',
                        'dtrs.overtime',
                        'dtrs.late',
                        'employees.first_name', 
                        'employees.middle_name', 
                        'employees.last_name',
                    ]);
        return view('hr.dtr-report-generate', compact('data'));
    }

    public function dtr_report_full_time($day){
        if($day == 15){
            $month = Carbon::NOW()->month;
            $year = Carbon::NOW()->year;
            $weekdays=0;
            for($day=1; $day<=15; $day++) {
                $wd = date("w",mktime(0,0,0,$month,$day,$year));
                if($wd > 0 && $wd < 6){
                    $weekdays += 1;
                }
            }
            $complete_working_hrs = $weekdays * 9; // complete working hrs of the month (9hrs/day)

            $full_timers = employee::where('employee_type', 'Plantilla')->get();

            if($full_timers != null){
                foreach($full_timers as $full_timer){
                    $employee = employee::where('employee_id', $full_timer->employee_id)->first();
                    $employee_dtr = dailytimerecord::where('employee_id', $employee->employee_id)
                                                    ->whereMonth('attendance_date', NOW()->month)
                                                    ->whereDay('attendance_date', '<=', 15)
                                                    ->get();
                    
                    // if the number of dtr records != expected (complete) number of dtr records of the months
                    $absent = 0;
                    if($employee_dtr->count() != $weekdays){
                        $absent = $weekdays - $employee_dtr->count();
                    }
        
                    // calculate working hrs of the employee
                    $working_hrs = 0;
                    foreach($employee_dtr as $dtr){
                        $sec = strtotime($dtr->time_out)-strtotime($dtr->time_in);
                        $hr = floor(($sec % 86400) / 3600);
                        $working_hrs += $hr;
                    }
        
                    if($working_hrs != $complete_working_hrs){
                        $late = 0;
                        $undertime = 0;
                        $overtime = 0;
                        foreach($employee_dtr as $dtr){
                            // late
                            if($dtr->time_in > '08:00:00'){
                                $sec = strtotime($dtr->time_in)-strtotime('08:00:00');
                                $hr = $sec / 3600;
                                $late += $hr;
                            }
                            // undertime
                            if($dtr->time_out < '17:00:00'){
                                $sec = strtotime($dtr->time_out)-strtotime('08:00:00');
                                $hr = $sec / 3600;
                                $undertime += $hr;
                            }
                            // overtime
                            if($dtr->time_out > '17:00:00'){
                                $sec = strtotime($dtr->time_out)-strtotime('08:00:00');
                                $hr = $sec / 3600;
                                $overtime += $hr;
                            }
                        }
                        $monthly_report = dtr::where('employee_id', $employee->employee_id)
                                            ->whereMonth('date', NOW()->month)
                                            ->first();
                        if($monthly_report == null){
                            dtr::create([
                                'employee_id' => $employee->employee_id,
                                'job_id' => $employee->job_id,
                                'date' => NOW(),
                                'late' => $late,
                                'undertime' => $undertime,
                                'absent' => $absent,
                                'overtime' => $overtime,
                            ]);
                        }
                        else{
                            $monthly_report->late = $late;
                            $monthly_report->undertime = $undertime;
                            $monthly_report->absent = $absent;
                            $monthly_report->overtime = $overtime;
                            $monthly_report->save();
                        }
                    }
                }

                $message = 'Successfully generated a dtr report of full time employees for the month of '.date('F', strtotime(Carbon::NOW()->month));    
            }
            else{
                $message = 'No employees found.';    
            }
        }
        elseif($day == 30){
            $month = Carbon::NOW()->month;
            $year = Carbon::NOW()->year;
            $daysInMonth = date('t', strtotime(Carbon::NOW()));
            $weekdays=0;
            for($day=16; $day<=$daysInMonth; $day++) {
                $wd = date("w",mktime(0,0,0,$month,$day,$year));
                if($wd > 0 && $wd < 6){
                    $weekdays += 1;
                }
            }
            $complete_working_hrs = $weekdays * 9; // complete working hrs of the month (9hrs/day)

            $full_timers = employee::where('employee_type', 'Plantilla')->get();

            if($full_timers != null){
                foreach($full_timers as $full_timer){
                    $employee = employee::where('employee_id', $full_timer->employee_id)->first();
                    $employee_dtr = dailytimerecord::where('employee_id', $employee->employee_id)
                                                    ->whereMonth('attendance_date', NOW()->month)
                                                    ->whereDay('attendance_date', '>', 15)
                                                    ->get();
                    
                    // if the number of dtr records != expected (complete) number of dtr records of the months
                    $absent = 0;
                    if($employee_dtr->count() != $weekdays){
                        $absent = $weekdays - $employee_dtr->count();
                    }
        
                    // calculate working hrs of the employee
                    $working_hrs = 0;
                    foreach($employee_dtr as $dtr){
                        $sec = strtotime($dtr->time_out)-strtotime($dtr->time_in);
                        $hr = floor(($sec % 86400) / 3600);
                        $working_hrs += $hr;
                    }
        
                    if($working_hrs != $complete_working_hrs){
                        $late = 0;
                        $undertime = 0;
                        $overtime = 0;
                        foreach($employee_dtr as $dtr){
                            // late
                            if($dtr->time_in > '08:00:00'){
                                $sec = strtotime($dtr->time_in)-strtotime('08:00:00');
                                $hr = $sec / 3600;
                                $late += $hr;
                            }
                            // undertime
                            if($dtr->time_out < '17:00:00'){
                                $sec = strtotime($dtr->time_out)-strtotime('08:00:00');
                                $hr = $sec / 3600;
                                $undertime += $hr;
                            }
                            // overtime
                            if($dtr->time_out > '17:00:00'){
                                $sec = strtotime($dtr->time_out)-strtotime('08:00:00');
                                $hr = $sec / 3600;
                                $overtime += $hr;
                            }
                        }
                        $monthly_report = dtr::where('employee_id', $employee->employee_id)
                                            ->whereMonth('date', NOW()->month)
                                            ->first();
                        if($monthly_report == null){
                            dtr::create([
                                'employee_id' => $employee->employee_id,
                                'job_id' => $employee->job_id,
                                'date' => NOW(),
                                'late' => $late,
                                'undertime' => $undertime,
                                'absent' => $absent,
                                'overtime' => $overtime,
                            ]);
                        }
                        else{
                            $monthly_report->late = $late;
                            $monthly_report->undertime = $undertime;
                            $monthly_report->absent = $absent;
                            $monthly_report->overtime = $overtime;
                            $monthly_report->save();
                        }
                    }
                }

                $message = 'Successfully generated a dtr report of full time employees for the month of '.date('F', strtotime(Carbon::NOW()->month));    
            }
            else{
                $message = 'No employees found.';    
            }
            
            return redirect()->route('dtr-report-generate')->with('message', $message);
        }
        else{
            $message = 'Reports for full time employees are only generated every 15th and 30th day of the month.';
            return redirect()->route('dtr-report')->with('message', $message);
        }
    }

    public function dtr_report_part_time($day){
        if($day == 30){
            $month = Carbon::NOW()->month;
            $year = Carbon::NOW()->year;
            $daysInMonth = date('t', strtotime(Carbon::NOW()));
            $weekdays=20;
            for($day=29; $day<=$daysInMonth; $day++) {
                $wd = date("w",mktime(0,0,0,$month,$day,$year));
                if($wd > 0 && $wd < 6){
                    $weekdays += 1;
                }
            }

            $complete_working_hrs = $weekdays * 9; // complete working hrs of the month (9hrs/day)

            $part_timers = employee::where('employee_type', 'COS/JO')->get();

            if($part_timers != null){
                foreach($part_timers as $part_timer){
                    $employee = employee::where('employee_id', $part_timer->employee_id)->first();
                    $employee_dtr = dailytimerecord::where('employee_id', $employee->employee_id)->get();
                    
                    // if the number of dtr records != expected (complete) number of dtr records of the months
                    $absent = 0;
                    if($employee_dtr->count() != $weekdays){
                        $absent = $weekdays - $employee_dtr->count();
                    }
        
                    // calculate working hrs of the employee
                    $working_hrs = 0;
                    foreach($employee_dtr as $dtr){
                        $sec = strtotime($dtr->time_out)-strtotime($dtr->time_in);
                        $hr = floor(($sec % 86400) / 3600);
                        $working_hrs += $hr;
                    }
        
                    if($working_hrs != $complete_working_hrs){
                        $late = 0;
                        $undertime = 0;
                        $overtime = 0;
                        foreach($employee_dtr as $dtr){
                            // late
                            if($dtr->time_in > '08:00:00'){
                                $sec = strtotime($dtr->time_in)-strtotime('08:00:00');
                                $hr = $sec / 3600;
                                $late += $hr;
                            }
                            // undertime
                            if($dtr->time_out < '17:00:00'){
                                $sec = strtotime($dtr->time_out)-strtotime('08:00:00');
                                $hr = $sec / 3600;
                                $undertime += $hr;
                            }
                            // overtime
                            if($dtr->time_out > '17:00:00'){
                                $sec = strtotime($dtr->time_out)-strtotime('08:00:00');
                                $hr = $sec / 3600;
                                $overtime += $hr;
                            }
                        }
                        $monthly_report = dtr::where('employee_id', $employee->employee_id)
                                            ->whereMonth('date', NOW()->month)
                                            ->first();
                        if($monthly_report == null){
                            dtr::create([
                                'employee_id' => $employee->employee_id,
                                'job_id' => $employee->job_id,
                                'date' => NOW(),
                                'late' => $late,
                                'undertime' => $undertime,
                                'absent' => $absent,
                                'overtime' => $overtime,
                            ]);
                        }
                        else{
                            $monthly_report->late = $late;
                            $monthly_report->undertime = $undertime;
                            $monthly_report->absent = $absent;
                            $monthly_report->overtime = $overtime;
                            $monthly_report->save();
                        }
                    }
                }

                $message = 'Successfully generated a dtr report of part time employees for the month of '.date('F', strtotime(Carbon::NOW()->month));    
            }
            else{
                $message = 'No employees found.';    
            }

            return redirect()->route('dtr-report-generate')->with('message', $message);
        }
        else{
            $message = 'Reports for part time employees are only generated every 30th day of the month.';
            return redirect()->route('dtr-report')->with('message', $message);
        }
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

        foreach($employee_dtr as $key=>$value){
            foreach($employees as $k=>$v){ 
                if($value->employee_id == $v->employee_id){
                    unset($employees[$k]);
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
        ->where('employees.first_name','LIKE', '%' . $leave_search . '%')
        ->orWhere('employees.middle_name','LIKE', '%' . $leave_search . '%')
        ->orWhere('employees.last_name','LIKE', '%' . $leave_search . '%')
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
                                ->where('employees.first_name','LIKE', '%' . $lr_search . '%')
                                ->orWhere('employees.middle_name','LIKE', '%' . $lr_search . '%')
                                ->orWhere('employees.last_name','LIKE', '%' . $lr_search . '%')
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