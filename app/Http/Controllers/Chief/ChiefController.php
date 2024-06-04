<?php

namespace App\Http\Controllers\Chief;

use App\Events\LeaveReqApproval;
use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\dtr;
use App\Models\Employee;
use App\Models\EmployeeLeave;
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

        $NumOnLeave = EmployeeLeave::where('remarks', 'Approved')
                                    ->where('start_date', '<=' ,Carbon::today())
                                    ->where('end_date', '>=' ,Carbon::today());
        $NumOnLeave = $NumOnLeave->count();

        $applications = Application::join('jobs_availables', 'jobs_availables.id', '=', 'applications.job_id')
                                    ->get([
                                        'applications.remarks',
                                        'applications.name',
                                        'applications.remarks',
                                        'jobs_availables.college',
                                        'jobs_availables.job_name',
                                    ]);

        $leaves = EmployeeLeave::orderBy('employee_leaves.start_date', 'ASC')
                                ->join('employees', 'employees.id', '=', 'employee_leaves.emp_id')
                                ->whereMonth('employee_leaves.start_date', Carbon::now()->month)
                                ->get([
                                    'employee_leaves.start_date',
                                    'employee_leaves.end_date',
                                    'employee_leaves.type',
                                    'employee_leaves.remarks',
                                    'employees.name',
                                ]);
                                
        foreach($leaves as $leave){
            $leave->start_date = date("d M", strtotime($leave->start_date));
            $leave->end_date = date("d M", strtotime($leave->end_date));
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

        $NumOnLeave = EmployeeLeave::where('remarks', 'Approved')
                                    ->where('start_date', '<=' ,Carbon::today())
                                    ->where('end_date', '>=' ,Carbon::today());
        $NumOnLeave = $NumOnLeave->count();

        $applications = Application::join('jobs_availables', 'jobs_availables.id', '=', 'applications.job_id')
                                    ->get([
                                        'applications.remarks',
                                        'applications.name',
                                        'applications.remarks',
                                        'jobs_availables.college',
                                        'jobs_availables.job_name',
                                    ]);

        $leaves = EmployeeLeave::orderBy('employee_leaves.start_date', 'ASC')
                                ->join('employees', 'employees.id', '=', 'employee_leaves.emp_id')
                                ->whereMonth('employee_leaves.start_date', Carbon::now()->month)
                                ->get([
                                    'employee_leaves.start_date',
                                    'employee_leaves.end_date',
                                    'employee_leaves.type',
                                    'employee_leaves.remarks',
                                    'employees.name',
                                ]);
                                
        foreach($leaves as $leave){
            $leave->start_date = date("d M", strtotime($leave->start_date));
            $leave->end_date = date("d M", strtotime($leave->end_date));
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
        $req = EmployeeLeave::where('emp_id', $id)
                            ->whereMonth('start_date', Carbon::now()->month)
                            ->where('type', $type)
                            ->first();

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
        return view('hr.leave-request-approve', [
            'req' => $req,
            'leaves' => $leaves,
        ]);
    }

    public function leave_request_not_hr(){
        $leaves = EmployeeLeave::orderBy('employee_leaves.start_date', 'ASC')
                                ->join('employees', 'employees.id', '=', 'employee_leaves.emp_id')
                                ->join('jobs_availables', 'jobs_availables.id', '=', 'employees.job_id')
                                ->whereMonth('employee_leaves.start_date', Carbon::now()->month)
                                ->where('college', '!=', 'human resources')
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
        return view('hr.leave-request-not-hr', [
            'leaves' => $leaves,
        ]);
    }

    public function approve_leave_request(Request $request){
        $req = EmployeeLeave::where('emp_id', $request->id)
                            ->whereMonth('start_date', Carbon::now()->month)
                            ->where('type', $request->type)
                            ->whereNull('remarks')
                            ->first();
        if($req != null && $request->remarks == 'approved'){
            $req->remarks = $request->remarks;

            $lc_per_day = 0.005209*8;
            $start = Carbon::parse($req->start_date);
            $end = Carbon::parse($req->end_date);
            $days_on_leave = $start->diffInDays($end) + 1;
            $equivalent_lc = number_format($days_on_leave*$lc_per_day, 3, '.', '');

            $dtr = dtr::where('emp_id', $req->emp_id)
                        ->whereMonth('date', Carbon::now()->month)
                        ->first();
            
            $emp_record = Employee::where('id', $req->emp_id)->first();

            // input equivalent leave credit in table
            if(strtolower($req->type) == 'vacation' && $req->remarks == 'approved'){
                if($dtr == null){
                    dtr::create([
                        'emp_id' => $req->emp_id,
                        'job_id' => $emp_record->job_id,
                        'date' => Carbon::now()->toDateString(),
                        'vl_used' => $equivalent_lc,
                    ]);
                }
                elseif($dtr != null){
                    $dtr->vl_used = $equivalent_lc;
                    $dtr->date = Carbon::now()->toDateString();
                    $dtr->save();
                }
            }
            elseif(strtolower($req->type) == 'sick' && $req->remarks == 'approved'){
                if($dtr == null){
                    dtr::create([
                        'emp_id' => $req->emp_id,
                        'job_id' => $emp_record->job_id,
                        'date' => Carbon::now()->toDateString(),
                        'sl_used' => $equivalent_lc,
                    ]);
                }
                elseif($dtr != null){
                    $dtr->sl_used = $equivalent_lc;
                    $dtr->date = Carbon::now()->toDateString();
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
        $datas = EmployeeLeave::orderBy('employee_leaves.start_date', 'ASC')
                            ->join('employees', 'employees.id', '=', 'employee_leaves.emp_id')
                            ->join('jobs_availables', 'jobs_availables.id', '=', 'employees.job_id')
                            ->whereMonth('employee_leaves.start_date', Carbon::now()->month)
                            ->where('employee_leaves.remarks', 'approved')
                            ->where('jobs_availables.college', '!=', 'human resources')
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

        foreach($datas as $data){
            if($data != null && $data->remarks == 'approved' && $data->college != 'human resources'){
                $lc_per_day = 0.005209*8;
                $start = Carbon::parse($data->start_date);
                $end = Carbon::parse($data->end_date);
                $days_on_leave = $start->diffInDays($end) + 1;
                $equivalent_lc = number_format($days_on_leave*$lc_per_day, 3, '.', '');
    
                $dtr = dtr::where('emp_id', $data->emp_id)
                            ->whereMonth('date', Carbon::now()->month)
                            ->first();
                
                $emp_record = Employee::where('id', $data->emp_id)->first();
    
                // input equivalent leave credit in table
                if(strtolower($data->type) == 'vacation' && $data->remarks == 'approved'){
                    if($dtr == null){
                        dtr::create([
                            'emp_id' => $data->emp_id,
                            'job_id' => $emp_record->job_id,
                            'date' => Carbon::now()->toDateString(),
                            'vl_used' => $equivalent_lc,
                        ]);
                    }
                    elseif($dtr != null){
                        $dtr->vl_used = $equivalent_lc;
                        $dtr->date = Carbon::now()->toDateString();
                        $dtr->save();
                    }
                }
                elseif(strtolower($data->type) == 'sick' && $data->remarks == 'approved'){
                    if($dtr == null){
                        dtr::create([
                            'emp_id' => $data->emp_id,
                            'job_id' => $emp_record->job_id,
                            'date' => Carbon::now()->toDateString(),
                            'sl_used' => $equivalent_lc,
                        ]);
                    }
                    elseif($dtr != null){
                        $dtr->sl_used = $equivalent_lc;
                        $dtr->date = Carbon::now()->toDateString();
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