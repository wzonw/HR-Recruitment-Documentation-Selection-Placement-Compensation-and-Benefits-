<?php

namespace App\Http\Controllers\Chief;

use App\Events\LeaveReqApproval;
use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\dailytimerecord;
use App\Models\Employee;
use App\Models\leaverequest;
use App\Models\JobsAvailable;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ChiefController extends Controller
{
    public function index()
    {
        /*if(Gate::denies('for-chief')){
            abort(403);
        }*/

        $NumOfEmployees = Employee::where('active', 'Y')->get();
        $NumOfEmployees = $NumOfEmployees->count();

        $NumOnLeave = leaverequest::where('remarks', 'Approved')
                                    ->where('inclusive_start_date', '<=' ,Carbon::today())
                                    ->where('inclusive_end_date', '>=' ,Carbon::today());
        $NumOnLeave = $NumOnLeave->count();

        $applications = Application::join('jobs_availables', 'jobs_availables.id', '=', 'applications.job_id')
                                    ->get([
                                        'applications.remarks',
                                        'applications.first_name',
                                        'applications.middle_name',
                                        'applications.last_name',
                                        'applications.remarks',
                                        'jobs_availables.college',
                                        'jobs_availables.job_name',
                                    ]);

        $leaves = leaverequest::orderBy('leaverequests.inclusive_start_date', 'ASC')
                                ->join('employees', 'employees.employee_id', '=', 'leaverequests.employee_id')
                                ->whereMonth('leaverequests.inclusive_start_date', Carbon::now()->month)
                                ->get([
                                    'leaverequests.inclusive_start_date',
                                    'leaverequests.inclusive_end_date',
                                    'leaverequests.type_of_leave',
                                    'leaverequests.remarks',
                                    'employees.first_name',
                                    'employees.last_name',
                                    'employees.middle_name',
                                ]);
                                
        foreach($leaves as $leave){
            $leave->inclusive_start_date = date("d M", strtotime($leave->inclusive_start_date));
            $leave->inclusive_end_date = date("d M", strtotime($leave->inclusive_end_date));
        }

        return view('hr.dashboard.chief-index', [
            "num_employees" => $NumOfEmployees,
            "num_onleave" => $NumOnLeave,
            "applications" => $applications,
            "leaves" => $leaves,
            "selected_college" => '',
            "selected_position" => '',
            "selected_status" => '',
        ]);
    }

    public function update_index(Request $request)
    {
        /*if(Gate::denies('for-chief')){
            abort(403);
        }*/

        if($request->position == 'null' && $request->college == 'null' && $request->status == 'null'){
            $NumOfEmp = Employee::where('active', 'Y')->get();
            $NumOfEmp = $NumOfEmp->count();
        }
        elseif($request->position == 'null' && $request->college != 'null' && $request->status == 'null'){
            $NumOfEmp = Employee::join('jobs_availables', 'jobs_availables.id', '=', 'employees.job_id')
                                ->where('employees.active', 'Y')
                                ->where('jobs_availables.college', $request->college)
                                ->get([
                                    'jobs_availables.college',
                                ]);
            $NumOfEmp = $NumOfEmp->count();
        }
        elseif($request->position != 'null' && $request->college == 'null' && $request->status == 'null'){
            $NumOfEmp = Employee::join('jobs_availables', 'jobs_availables.id', '=', 'employees.job_id')
                                ->where('employees.active', 'Y')
                                ->where('jobs_availables.job_name', 'LIKE','%'.$request->position.'%')
                                ->get([
                                    'jobs_availables.college',
                                ]);
            $NumOfEmp = $NumOfEmp->count();
        }
        elseif($request->position == 'null' && $request->college == 'null' && $request->status != 'null'){
            $NumOfEmp = Employee::join('jobs_availables', 'jobs_availables.id', '=', 'employees.job_id')
                                ->where('employees.active', 'Y')
                                ->where('jobs_availables.status', $request->status)
                                ->get([
                                    'jobs_availables.college',
                                ]);
            $NumOfEmp = $NumOfEmp->count();
        }
        elseif($request->position != 'null' && $request->college == 'null' && $request->status != 'null'){
            $NumOfEmp = Employee::join('jobs_availables', 'jobs_availables.id', '=', 'employees.job_id')
                                ->where('employees.active', 'Y')
                                ->where('jobs_availables.status', $request->status)
                                ->where('jobs_availables.job_name', 'LIKE','%'.$request->position.'%')
                                ->get([
                                    'jobs_availables.college',
                                ]);
            $NumOfEmp = $NumOfEmp->count();
        }
        elseif($request->position != 'null' && $request->college != 'null' && $request->status == 'null'){
            $NumOfEmp = Employee::join('jobs_availables', 'jobs_availables.id', '=', 'employees.job_id')
                                ->where('employees.active', 'Y')
                                ->where('jobs_availables.college', $request->college)
                                ->where('jobs_availables.job_name', 'LIKE','%'.$request->position.'%')
                                ->get([
                                    'jobs_availables.college',
                                ]);
            $NumOfEmp = $NumOfEmp->count();
        }
        elseif($request->position == 'null' && $request->college != 'null' && $request->status != 'null'){
            $NumOfEmp = Employee::join('jobs_availables', 'jobs_availables.id', '=', 'employees.job_id')
                                ->where('employees.active', 'Y')
                                ->where('jobs_availables.college', $request->college)
                                ->where('jobs_availables.status', $request->status)
                                ->get([
                                    'jobs_availables.college',
                                ]);
            $NumOfEmp = $NumOfEmp->count();
        }
        else{
            $NumOfEmp = Employee::join('jobs_availables', 'jobs_availables.id', '=', 'employees.job_id')
                                ->where('employees.active', 'Y')
                                ->where('jobs_availables.college', $request->college)
                                ->where('jobs_availables.status', $request->status)
                                ->where('jobs_availables.job_name', 'LIKE','%'.$request->position.'%')
                                ->get([
                                    'jobs_availables.college',
                                ]);
            $NumOfEmp = $NumOfEmp->count();
        }

        $NumOnLeave = leaverequest::where('remarks', 'Approved')
                                    ->where('inclusive_start_date', '<=' ,Carbon::today())
                                    ->where('inclusive_end_date', '>=' ,Carbon::today());
        $NumOnLeave = $NumOnLeave->count();

        $applications = Application::join('jobs_availables', 'jobs_availables.id', '=', 'applications.job_id')
                                    ->get([
                                        'applications.remarks',
                                        'applications.first_name',
                                        'applications.middle_name',
                                        'applications.last_name',
                                        'applications.remarks',
                                        'jobs_availables.college',
                                        'jobs_availables.job_name',
                                    ]);

        $leaves = leaverequest::orderBy('leaverequests.inclusive_start_date', 'ASC')
                                ->join('employees', 'employees.employee_id', '=', 'leaverequests.employee_id')
                                ->whereMonth('leaverequests.inclusive_start_date', Carbon::now()->month)
                                ->get([
                                    'leaverequests.inclusive_start_date',
                                    'leaverequests.inclusive_end_date',
                                    'leaverequests.type_of_leave',
                                    'leaverequests.remarks',
                                    'employees.first_name',
                                    'employees.last_name',
                                    'employees.middle_name',
                                ]);
                                
        foreach($leaves as $leave){
            $leave->inclusive_start_date = date("d M", strtotime($leave->inclusive_start_date));
            $leave->inclusive_end_date = date("d M", strtotime($leave->inclusive_end_date));
        }
        
        return view('hr.dashboard.chief-index', [
            "num_employees" => $NumOfEmp,
            "num_onleave" => $NumOnLeave,
            "applications" => $applications,
            "leaves" => $leaves,
            "selected_college" => $request->college,
            "selected_position" => $request->position,
            "selected_status" => $request->status,
        ]);
    }

    public function leave_request_id($id, $type){
        $req = leaverequest::where('employee_id', $id)
                            ->whereMonth('inclusive_start_date', Carbon::now()->month)
                            ->where('type_of_leave', $type)
                            ->first();

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
                                    'employees.last_name',
                                    'employees.middle_name', 
                                    'jobs_availables.status',
                                    'jobs_availables.college',
                                ]);
        return view('hr.leave-request-approve', [
            'req' => $req,
            'leaves' => $leaves,
        ]);
    }

    public function leave_request_not_hr(){
        $leaves = leaverequest::orderBy('leaverequests.inclusive_start_date', 'ASC')
                                ->join('employees', 'employees.employee_id', '=', 'leaverequests.employee_id')
                                ->join('jobs_availables', 'jobs_availables.id', '=', 'employees.job_id')
                                ->whereMonth('leaverequests.inclusive_start_date', Carbon::now()->month)
                                ->where('college', '!=', 'human resources')
                                ->get([
                                    'leaverequests.employee_id',
                                    'leaverequests.inclusive_start_date',
                                    'leaverequests.inclusive_end_date',
                                    'leaverequests.type_of_leave',
                                    'leaverequests.leave_form',
                                    'leaverequests.remarks',
                                    'employees.first_name',
                                    'employees.last_name',
                                    'employees.middle_name',
                                    'jobs_availables.status',
                                    'jobs_availables.college',
                                ]);
        return view('hr.leave-request-not-hr', [
            'leaves' => $leaves,
        ]);
    }

    public function approve_leave_request(Request $request){
        $req = leaverequest::where('employee_id', $request->id)
                            ->whereMonth('inclusive_start_date', Carbon::now()->month)
                            ->where('type_of_leave', $request->type)
                            ->whereNull('remarks')
                            ->first();
        if($req != null && $request->remarks == 'approved'){
            $req->remarks = $request->remarks;
            $req->status = $request->remarks;

            $lc_per_day = 0.005209*8;
            $start = Carbon::parse($req->inclusive_start_date);
            $end = Carbon::parse($req->inclusive_end_date);
            $days_on_leave = $start->diffInDays($end) + 1;
            $equivalent_lc = number_format($days_on_leave*$lc_per_day, 3, '.', '');

            $dtr = dailytimerecord::where('employee_id', $req->employee_id)
                        ->whereMonth('attendance_date', Carbon::now()->month)
                        ->first();
            
            $emp_record = Employee::where('employee_id', $req->employee_id)->first();

            // input equivalent leave credit in table
            if(strtolower($req->type_of_leave) == 'vacation' && $req->remarks == 'approved'){
                if($dtr == null){
                    dailytimerecord::create([
                        'employee_id' => $req->employee_id,
                        'job_id' => $emp_record->job_id,
                        'attendance_date' => Carbon::now()->toDateString(),
                        'vl_used' => $equivalent_lc,
                    ]);
                }
                elseif($dtr != null){
                    $dtr->vl_used += $equivalent_lc;
                    $dtr->attendance_date = Carbon::now()->toDateString();
                    $dtr->save();
                }
            }
            elseif(strtolower($req->type_of_leave) == 'sick' && $req->remarks == 'approved'){
                if($dtr == null){
                    dailytimerecord::create([
                        'employee_id' => $req->employee_id,
                        'job_id' => $emp_record->job_id,
                        'attendance_date' => Carbon::now()->toDateString(),
                        'sl_used' => $equivalent_lc,
                    ]);
                }
                elseif($dtr != null){
                    $dtr->sl_used += $equivalent_lc;
                    $dtr->attendance_date = Carbon::now()->toDateString();
                    $dtr->save();
                }
            }
            
            $req->save();
            $message = 'successfully saved.';

            //notif via db
            event(new LeaveReqApproval($req));
        }
        elseif($req != null && $request->remarks == 'authorized'){
            $req->remarks = $request->remarks;
            $req->status = $request->remarks;
            $req->save();
            $message = 'successfully saved.';

            //notif via db
            event(new LeaveReqApproval($req));

            //send to faculty module for leave approval of dept head
        }
        elseif($req != null && $request->remarks == 'declined'){
            $req->remarks = $request->remarks;
            $req->status = $request->remarks;
            $req->save();
            $message = 'successfully saved.';

            //notif via db
            event(new LeaveReqApproval($req));

            //send to faculty module for leave approval of dept head
        }
        else{
            $message = 'Employee ID not found.';
        }
        return redirect()->route('leave-request')->with('message', $message);
    }

    public function approve_leave_request_not_hr(){
        $datas = leaverequest::orderBy('leaverequests.inclusive_start_date', 'ASC')
                            ->join('employees', 'employees.employee_id', '=', 'leaverequests.employee_id')
                            ->join('jobs_availables', 'jobs_availables.id', '=', 'employees.job_id')
                            ->whereMonth('leaverequests.inclusive_start_date', Carbon::now()->month)
                            ->where('leaverequests.remarks', 'approved')
                            ->where('jobs_availables.college', '!=', 'human resources')
                            ->get([
                                'leaverequests.employee_id',
                                'leaverequests.inclusive_start_date',
                                'leaverequests.inclusive_end_date',
                                'leaverequests.type_of_leave',
                                'leaverequests.leave_form',
                                'leaverequests.remarks',
                                'employees.first_name',
                                'employees.last_name',
                                'employees.middle_name',
                                'jobs_availables.status',
                                'jobs_availables.college',
                            ]);
        $message = 'no approved.';

        foreach($datas as $data){
            if($data != null && $data->remarks == 'approved' && $data->college != 'human resources'){
                $lc_per_day = 0.005209*8;
                $start = Carbon::parse($data->inclusive_start_date);
                $end = Carbon::parse($data->inclusive_end_date);
                $days_on_leave = $start->diffInDays($end) + 1;
                $equivalent_lc = number_format($days_on_leave*$lc_per_day, 3, '.', '');
    
                $dtr = dailytimerecord::where('employee_id', $data->employee_id)
                            ->whereMonth('attendance_date', Carbon::now()->month)
                            ->first();
                
                $emp_record = Employee::where('employee_id', $data->employee_id)->first();
    
                // input equivalent leave credit in table
                if(strtolower($data->type_of_leave) == 'vacation' && $data->remarks == 'approved'){
                    if($dtr == null){
                        dailytimerecord::create([
                            'employee_id' => $data->employee_id,
                            'job_id' => $emp_record->job_id,
                            'attendance_date' => Carbon::now()->toDateString(),
                            'vl_used' => $equivalent_lc,
                        ]);
                    }
                    elseif($dtr != null){
                        $dtr->vl_used += $equivalent_lc;
                        $dtr->attendance_date = Carbon::now()->toDateString();
                        $dtr->save();
                    }
                }
                elseif(strtolower($data->type_of_leave) == 'sick' && $data->remarks == 'approved'){
                    if($dtr == null){
                        dailytimerecord::create([
                            'employee_id' => $data->employee_id,
                            'job_id' => $emp_record->job_id,
                            'attendance_date' => Carbon::now()->toDateString(),
                            'sl_used' => $equivalent_lc,
                        ]);
                    }
                    elseif($dtr != null){
                        $dtr->sl_used += $equivalent_lc;
                        $dtr->attendance_date = Carbon::now()->toDateString();
                        $dtr->save();
                    }
                }

                $message = 'successfully saved.';
                
            }
            elseif($data != null && $data->remarks == 'authorized' && $data->college == 'human resources'){
                $message = 'An employee under HR was found.';
            }
            else{
                $message = 'No Employee is found.';
            }
        }
        return redirect()->route('leave-request')->with('message', $message);
    }
}