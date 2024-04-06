<?php

namespace App\Http\Controllers\Chief;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Employee;
use App\Models\EmployeeLeave;
use App\Models\JobsAvailable;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ChiefController extends Controller
{
    public function index()
    {
        if(Gate::denies('for-chief')){
            abort(403);
        }

        $NumOfEmployees = Employee::all();
        $NumOfEmployees = $NumOfEmployees->count();

        $NumOnLeave = EmployeeLeave::where('remarks', 'Approved')
                                    ->where('start_date', '<=' ,Carbon::today())
                                    ->where('end_date', '>=' ,Carbon::today());
        $NumOnLeave = $NumOnLeave->count();

        $applications = Application::all();

        $leaves = EmployeeLeave::join('employees', 'employees.id', '=', 'employee_leaves.emp_id')
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
        ]);
    }

}
