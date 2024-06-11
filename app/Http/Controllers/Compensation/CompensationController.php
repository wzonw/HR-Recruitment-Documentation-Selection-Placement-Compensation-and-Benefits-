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
        $dtr = dtr::where('employee_id', $request->id)
                ->whereMonth('attendance_date', Carbon::now()->month)
                ->whereYear('attendance_date', Carbon::now()->year)
                ->first();
        
        $employee = Employee::where('employee_id', $request->id)->first();

        if($dtr == null && $employee != null){
            dtr::create([
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

    public function dtr_report_generate($type){
        if($type == 'Full-time'){
            $type = 'Plantilla';
        }
        elseif($type == 'Part-time'){
            $type = 'COS/JO';
        }
        $data = dtr::where('attendance_date', date('Y-m-d', strtotime(Carbon::now())))
                    ->join('employees', 'employees.employee_id', '=', 'dtrs.employee_id')
                    ->where('employees.employee_type', $type)
                    ->get([
                        'dtrs.employee_id',
                        'dtrs.attendance_date',
                        'dtrs.absent',
                        'dtrs.undertime',
                        'dtrs.overtime',
                        'dtrs.late',
                        'dtrs.cto',
                        'employees.first_name', 
                        'employees.middle_name', 
                        'employees.last_name',
                    ]);
        return view('hr.dtr-report-generate', compact('data'));
    }

    public function dtr_report_full_time($day){
        if($day == 15){
            $employees = Employee::where('employee_type', 'Plantilla')
                            ->where('active', 1)
                            ->get();
            $month = Carbon::NOW()->month;
            $year = Carbon::NOW()->year;
            $daysInMonth =  Carbon::NOW()->daysInMonth;

            if($employees != null){
                /* calculate the expected working days and hours */
                foreach($employees as $employee){
                    /* calculate the expected working days of employee (current month) */
                    $workdays=0;
                    $employee->work_days = json_decode($employee->work_days);
                    for($day=1; $day<=15; $day++) {
                        $wd = date("w",mktime(0,0,0,$month,$day,$year));
                        if(in_array($wd, $employee->work_days)){
                            $workdays += 1;
                        }
                    }

                    /* calculate the expected working hours of employee (per day) */
                    $work_sec = strtotime($employee->end_of_shift) - strtotime($employee->start_of_shift);
                    $work_hours = floor(($work_sec % 86400) / 3600);

                    /* calculate the expected working hours of employee (for the current month) */
                    $complete_working_hrs = $workdays * $work_hours;

                    /* employee's dtr for the current month, current year */
                    $employee_dtr = dailytimerecord::where('employee_id', $employee->employee_id)
                                                    ->whereMonth('attendance_date', NOW()->month)
                                                    ->whereYear('attendance_date', NOW()->year)
                                                    ->whereDay('attendance_date', '<=', 15)
                                                    ->get();

                    /* absences, late, undertime, overtime */
                    $absent = 0;
                    $late = 0;
                    $undertime = 0;
                    $overtime = 0;
                    $cto = 0;

                    /* calculate for cto (working hrs during rest day) */
                    foreach($employee_dtr as $key=>$dtr){
                        $d = date("w",strtotime($dtr->attendance_date));
                        if(in_array($d, $employee->work_days) == false){
                            $s = strtotime($dtr->time_out)-strtotime($dtr->time_in);
                            $h = floor(($s % 86400) / 3600);
                            $cto += $h * 1.5; 
                            unset($employee_dtr[$key]);
                        }
                    }

                    /* calculate for absences */
                    if($employee_dtr->count() < $workdays){
                        $absent = $workdays - $employee_dtr->count();
                    }

                    /* calculate working hrs of the employee excluding rest days */
                    $working_hrs = 0;
                    foreach($employee_dtr as $dtr){
                        $sec = strtotime($dtr->time_out)-strtotime($dtr->time_in);
                        $hr = floor(($sec % 86400) / 3600);
                        $working_hrs += $hr;
                    }

                    if($working_hrs != $complete_working_hrs){
                        foreach($employee_dtr as $dtr){
                            // late
                            if($dtr->time_in > $employee->start_of_shift){
                                $sec = strtotime($dtr->time_in)-strtotime($employee->start_of_shift);
                                $hr = $sec / 3600;
                                $late += $hr;
                            }
                            // undertime
                            if($dtr->time_out < $employee->end_of_shift){
                                $sec = strtotime($employee->end_of_shift)-strtotime($dtr->time_out);
                                $hr = $sec / 3600;
                                $undertime += $hr;
                            }
                            // overtime
                            if($dtr->time_out > $employee->end_of_shift){
                                $sec = strtotime($dtr->time_out)-strtotime($employee->end_of_shift);
                                $hr = $sec / 3600;
                                $overtime += $hr;
                            }
                        }

                        $monthly_report = dtr::where('employee_id', $employee->employee_id)
                                            ->whereMonth('attendance_date', NOW()->month)
                                            ->first();
                        if($monthly_report == null){
                            dtr::create([
                                'employee_id' => $employee->employee_id,
                                'job_id' => $employee->job_id,
                                'attendance_date' => NOW(),
                                'late' => $late,
                                'undertime' => $undertime,
                                'absent' => $absent,
                                'overtime' => $overtime,
                                'cto' => $cto,
                            ]);
                        }
                        else{
                            $monthly_report->attendance_date = NOW();
                            $monthly_report->late = $late;
                            $monthly_report->undertime = $undertime;
                            $monthly_report->absent = $absent;
                            $monthly_report->overtime = $overtime;
                            $monthly_report->cto = $cto;
                            $monthly_report->save();
                        }

                    }
                }
                $message = 'Successfully generated a dtr report of full time employees for the month of '.date('F', strtotime(Carbon::NOW()));
            }
            else{
                $message = 'No employees found.';    
            }

            $type = 'Full-time';
            return redirect()->route('dtr-report-generate', $type)->with('message', $message);
        }
        elseif($day == 30){
            $employees = Employee::where('employee_type', 'Plantilla')
                            ->where('active', 1)
                            ->get();
            $month = Carbon::NOW()->month;
            $year = Carbon::NOW()->year;
            $daysInMonth =  Carbon::NOW()->daysInMonth;

            if($employees != null){
                /* calculate the expected working days and hours */
                foreach($employees as $employee){
                    /* calculate the expected working days of employee (current month) */
                    $workdays=0;
                    $employee->work_days = json_decode($employee->work_days);
                    for($day=16; $day<=$daysInMonth; $day++) {
                        $wd = date("w",mktime(0,0,0,$month,$day,$year));
                        if(in_array($wd, $employee->work_days)){
                            $workdays += 1;
                        }
                    }

                    /* calculate the expected working hours of employee (per day) */
                    $work_sec = strtotime($employee->end_of_shift) - strtotime($employee->start_of_shift);
                    $work_hours = floor(($work_sec % 86400) / 3600);

                    /* calculate the expected working hours of employee (for the current month) */
                    $complete_working_hrs = $workdays * $work_hours;

                    /* employee's dtr for the current month, current year */
                    $employee_dtr = dailytimerecord::where('employee_id', $employee->employee_id)
                                                    ->whereMonth('attendance_date', NOW()->month)
                                                    ->whereYear('attendance_date', NOW()->year)
                                                    ->whereDay('attendance_date', '>', 15)
                                                    ->get();

                    /* absences, late, undertime, overtime */
                    $absent = 0;
                    $late = 0;
                    $undertime = 0;
                    $overtime = 0;
                    $cto = 0;

                    /* calculate for cto (working hrs during rest day) */
                    foreach($employee_dtr as $key=>$dtr){
                        $d = date("w",strtotime($dtr->attendance_date));
                        if(in_array($d, $employee->work_days) == false){
                            $s = strtotime($dtr->time_out)-strtotime($dtr->time_in);
                            $h = floor(($s % 86400) / 3600);
                            $cto += $h * 1.5; 
                            unset($employee_dtr[$key]);
                        }
                    }

                    /* calculate for absences */
                    if($employee_dtr->count() < $workdays){
                        $absent = $workdays - $employee_dtr->count();
                    }

                    /* calculate working hrs of the employee excluding rest days */
                    $working_hrs = 0;
                    foreach($employee_dtr as $dtr){
                        $sec = strtotime($dtr->time_out)-strtotime($dtr->time_in);
                        $hr = floor(($sec % 86400) / 3600);
                        $working_hrs += $hr;
                    }

                    if($working_hrs != $complete_working_hrs){
                        foreach($employee_dtr as $dtr){
                            // late
                            if($dtr->time_in > $employee->start_of_shift){
                                $sec = strtotime($dtr->time_in)-strtotime($employee->start_of_shift);
                                $hr = $sec / 3600;
                                $late += $hr;
                            }
                            // undertime
                            if($dtr->time_out < $employee->end_of_shift){
                                $sec = strtotime($employee->end_of_shift)-strtotime($dtr->time_out);
                                $hr = $sec / 3600;
                                $undertime += $hr;
                            }
                            // overtime
                            if($dtr->time_out > $employee->end_of_shift){
                                $sec = strtotime($dtr->time_out)-strtotime($employee->end_of_shift);
                                $hr = $sec / 3600;
                                $overtime += $hr;
                            }
                        }

                        $monthly_report = dtr::where('employee_id', $employee->employee_id)
                                            ->whereMonth('attendance_date', NOW()->month)
                                            ->first();
                        if($monthly_report == null){
                            dtr::create([
                                'employee_id' => $employee->employee_id,
                                'job_id' => $employee->job_id,
                                'attendance_date' => NOW(),
                                'late' => $late,
                                'undertime' => $undertime,
                                'absent' => $absent,
                                'overtime' => $overtime,
                                'cto' => $cto,
                            ]);
                        }
                        else{
                            $monthly_report->attendance_date = NOW();
                            $monthly_report->late = $late;
                            $monthly_report->undertime = $undertime;
                            $monthly_report->absent = $absent;
                            $monthly_report->overtime = $overtime;
                            $monthly_report->cto = $cto;
                            $monthly_report->save();
                        }

                    }
                }
                $message = 'Successfully generated a dtr report of full time employees for the month of '.date('F', strtotime(Carbon::NOW()));
            }
            else{
                $message = 'No employees found.';    
            }

            $type = 'Full-time';
            return redirect()->route('dtr-report-generate', $type)->with('message', $message);
        }
        else{
            $message = 'Reports for full time employees are only generated every 15th and 30th day of the month.';
            return redirect()->route('dtr-report')->with('message', $message);
        }
    }

    public function dtr_report_part_time($day){
        if($day == 30){
            $employees = Employee::where('employee_type', 'COS/JO')
                            ->where('active', 1)
                            ->get();
            $month = Carbon::NOW()->month;
            $year = Carbon::NOW()->year;
            $daysInMonth =  Carbon::NOW()->daysInMonth;

            if($employees != null){
                /* calculate the expected working days and hours */
                foreach($employees as $employee){
                    /* calculate the expected working days of employee (current month) */
                    $workdays=0;
                    $employee->work_days = json_decode($employee->work_days);
                    for($day=1; $day<=$daysInMonth; $day++) {
                        $wd = date("w",mktime(0,0,0,$month,$day,$year));
                        if(in_array($wd, $employee->work_days)){
                            $workdays += 1;
                        }
                    }

                    /* calculate the expected working hours of employee (per day) */
                    $work_sec = strtotime($employee->end_of_shift) - strtotime($employee->start_of_shift);
                    $work_hours = floor(($work_sec % 86400) / 3600);

                    /* calculate the expected working hours of employee (for the current month) */
                    $complete_working_hrs = $workdays * $work_hours;

                    /* employee's dtr for the current month, current year */
                    $employee_dtr = dailytimerecord::where('employee_id', $employee->employee_id)
                                                    ->whereMonth('attendance_date', NOW()->month)
                                                    ->whereYear('attendance_date', NOW()->year)
                                                    ->get();

                    /* absences, late, undertime, overtime */
                    $absent = 0;
                    $late = 0;
                    $undertime = 0;
                    $overtime = 0;
                    $cto = 0;

                    /* calculate for cto (working hrs during rest day) */
                    foreach($employee_dtr as $key=>$dtr){
                        $d = date("w",strtotime($dtr->attendance_date));
                        if(in_array($d, $employee->work_days) == false){
                            $s = strtotime($dtr->time_out)-strtotime($dtr->time_in);
                            $h = floor(($s % 86400) / 3600);
                            $cto += $h * 1.5; 
                            unset($employee_dtr[$key]);
                        }
                    }

                    /* calculate for absences */
                    if($employee_dtr->count() < $workdays){
                        $absent = $workdays - $employee_dtr->count();
                    }

                    /* calculate working hrs of the employee excluding rest days */
                    $working_hrs = 0;
                    foreach($employee_dtr as $dtr){
                        $sec = strtotime($dtr->time_out)-strtotime($dtr->time_in);
                        $hr = floor(($sec % 86400) / 3600);
                        $working_hrs += $hr;
                    }

                    if($working_hrs != $complete_working_hrs){
                        foreach($employee_dtr as $dtr){
                            // late
                            if($dtr->time_in > $employee->start_of_shift){
                                $sec = strtotime($dtr->time_in)-strtotime($employee->start_of_shift);
                                $hr = $sec / 3600;
                                $late += $hr;
                            }
                            // undertime
                            if($dtr->time_out < $employee->end_of_shift){
                                $sec = strtotime($employee->end_of_shift)-strtotime($dtr->time_out);
                                $hr = $sec / 3600;
                                $undertime += $hr;
                            }
                            // overtime
                            if($dtr->time_out > $employee->end_of_shift){
                                $sec = strtotime($dtr->time_out)-strtotime($employee->end_of_shift);
                                $hr = $sec / 3600;
                                $overtime += $hr;
                            }
                        }

                        $monthly_report = dtr::where('employee_id', $employee->employee_id)
                                            ->whereMonth('attendance_date', NOW()->month)
                                            ->first();
                        if($monthly_report == null){
                            dtr::create([
                                'employee_id' => $employee->employee_id,
                                'job_id' => $employee->job_id,
                                'attendance_date' => NOW(),
                                'late' => $late,
                                'undertime' => $undertime,
                                'absent' => $absent,
                                'overtime' => $overtime,
                                'cto' => $cto,
                            ]);
                        }
                        else{
                            $monthly_report->attendance_date = NOW();
                            $monthly_report->late = $late;
                            $monthly_report->undertime = $undertime;
                            $monthly_report->absent = $absent;
                            $monthly_report->overtime = $overtime;
                            $monthly_report->cto = $cto;
                            $monthly_report->save();
                        }

                    }
                }
                $message = 'Successfully generated a dtr report of part time employees for the month of '.date('F', strtotime(Carbon::NOW()));
            }
            else{
                $message = 'No employees found.';    
            }

            $type = 'Part-time';
            return redirect()->route('dtr-report-generate', $type)->with('message', $message);
        }
        else{
            $message = 'Reports for part time employees are only generated every 30th day of the month.';
            return redirect()->route('dtr-report')->with('message', $message);
        }
    }

    public function lc_computation(Request $request){
        $emp = Employee::where('employee_id', $request->id)->first();
        $data = dtr::where('employee_id', $request->id)
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
        $employee_dtr = dtr::whereMonth('attendance_date', Carbon::now()->month)
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
        $employee_dtr = dtr::whereMonth('attendance_date', Carbon::now()->month)
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