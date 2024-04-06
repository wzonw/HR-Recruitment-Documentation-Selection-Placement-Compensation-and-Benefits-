<?php

namespace App\Http\Controllers\Chief;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeLeave;
use App\Models\JobsAvailable;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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

        $PTJobs = JobsAvailable::where('status', 'COS/JO')
                ->where('active', 'Y')
                ->get();
        $FTJobs = JobsAvailable::where('status', 'Plantilla')
                ->where('active', 'Y')
                ->get();
        return view('hr.dashboard.chief_index', [
            "num_employees" => $NumOfEmployees,
            "num_onleave" => $NumOnLeave,
            "part_time" => $PTJobs,
            "full_time" => $FTJobs,
        ]);
    }
}
