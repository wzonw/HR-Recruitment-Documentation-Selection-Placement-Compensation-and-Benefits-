<?php

namespace App\Http\Controllers\Recruitment;

use App\Http\Controllers\Controller;
use App\Mail\ApplicantProceed;
use App\Mail\ApplicantRejected;
use App\Models\Application;
use App\Models\JobsAvailable;
use App\Models\User;
use App\Actions\Fortify\PasswordValidationRules;
use App\Models\EmployeeLeave;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RecruitmentController extends Controller
{
    use PasswordValidationRules;

    public function index()
    {
        if(Gate::denies('for-recruitment')){
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

    public function applicant_profile($id)
    {
        $applicant = Application::where('id', $id)->first();

        return view('hr.view-applicant-profile', [
            'applicant' => $applicant,
        ]);
    }

    public function view_file($id)
    {   
        $data = Application::find($id);

        return view('livewire.view-file', compact('data'));
    }

    public function join_data(){
        $data = Application::join('jobs_availables', 'jobs_availables.id', '=', 'applications.job_id')
                            ->get([
                                'applications.id',
                                'applications.name',
                                'applications.contact_number',
                                'applications.remarks',
                                'jobs_availables.job_name', 
                                'jobs_availables.college', 
                                'jobs_availables.status'
                            ]);
        
        return view('hr.applicant-list', compact('data'));

    }

    public function job_posting(){
        
        $jobs_even = DB::table('jobs_availables')
                     ->select(DB::raw('*'))
                     ->whereRaw('MOD(id, 2) = 0')
                     ->get();

        $jobs_odd = DB::table('jobs_availables')
                     ->select(DB::raw('*'))
                     ->whereRaw('MOD(id, 2) = 1')
                     ->get();
        return view('hr.job-posting', [
            "jobs_e" => $jobs_even,
            "jobs_o" => $jobs_odd,
        ]);
    }

    public function job_post(){
        JobsAvailable::create([
            'job_name' => request('position'),
            'job_desc' => request('description'),
            'status' => request('status'),
            'college' => request('college'),
            'dept' => request('dept'),
            'salary' => request('salary'),
            'deadline' => request('deadline'),
        ]);

        
        $message = 'Successfully added a Job!';

        return redirect()->route('job-posting')->with('message', $message);
    }

    public function sendmail_rejected($id): RedirectResponse
    {
        $applicant = Application::where('id', $id)->first();
        $applicant->remarks = 'Declined';
        $applicant->save();
        Mail::to($applicant->email)->send(new ApplicantRejected($applicant));
        return redirect()->route('view-applicant-profile', $applicant->id);
    }

    public function sendmail_proceed($id): RedirectResponse
    {
        $applicant = Application::where('id', $id)->first();
        $password = Str::of($applicant->name)->remove(' ');
        $password = strtolower($password);
        $pass = $password;
        User::create([
            'name' => $applicant->name,
            'email' => $applicant->email,
            'password' => Hash::make($password),
            'application_id' => $id,
        ]); 
        $applicant->remarks = 'Requirements';
        $applicant->save();
        Mail::to($applicant->email)->send(new ApplicantProceed($applicant, $password));
        return redirect()->route('view-applicant-profile', $applicant->id);
    }
}
