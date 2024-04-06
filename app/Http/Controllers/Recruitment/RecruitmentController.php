<?php

namespace App\Http\Controllers\Recruitment;

use App\Http\Controllers\Controller;
use App\Mail\ApplicantProceed;
use App\Mail\ApplicantRejected;
use App\Models\Application;
use App\Models\JobsAvailable;
use App\Models\User;
use App\Actions\Fortify\PasswordValidationRules;
use App\Events\FileRemarksChanged;
use App\Events\StatusChanged;
use App\Mail\ProceedToOffice;
use App\Models\Employee;
use App\Models\EmployeeLeave;
use App\Notifications\NewStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
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

        $applicant->file = json_decode($applicant->file);
        $applicant->file_remarks = json_decode($applicant->file_remarks);

        return view('hr.view-applicant-profile', [
            'applicant' => $applicant,
        ]);
    }

    public function view_file($file)
    {
        $data = $file;

        $remarks = [];
        $applicant = Application::where('file', 'LIKE', '%'.$file.'%')->first();
        $index = array_search($file, json_decode($applicant->file));
        $files = json_decode($applicant->file);

        if($applicant != null && $applicant->file_remarks == null){
            foreach($files as $key => $value){
                if($key == $index){
                    $remarks[$index] = 'viewed';        // change the remarks of the viewed file
                }
                else{
                    $remarks[$key] = '';                // no remarks
                }
            }
            
            $applicant->file_remarks = json_encode($remarks);
            $applicant->save();
        }
        elseif($applicant != null && $applicant->file_remarks != null){
            $file_remarks = json_decode($applicant->file_remarks);

            foreach($file_remarks as $value){
                $remarks[] = $value;                    // insert old remarks in array files[]
            }
            foreach($files as $key => $value){
                if($key == $index){
                    $remarks[$index] = 'viewed';        // change the remarks of the viewed file
                }
            }

            $applicant->file_remarks = json_encode($remarks);
            $applicant->save();
        }

        return view('livewire.view-file', compact('data'));
    }

    public function approved_file($file){
        $remarks = [];
        $applicant = Application::where('file', 'LIKE', '%'.$file.'%')->first();
        $index = array_search($file, json_decode($applicant->file));
        $files = json_decode($applicant->file);

        if($applicant != null && $applicant->file_remarks != null){
            $file_remarks = json_decode($applicant->file_remarks);

            foreach($file_remarks as $value){
                $remarks[] = $value;                    // insert old remarks in array files[]
            }
            foreach($files as $key => $value){
                if($key == $index){
                    $remarks[$index] = 'approved';        // change the remarks of the viewed file
                }
            }

            $applicant->file_remarks = json_encode($remarks);
            $applicant->save();

            $message = $files[$index] .' is approved.';
            
            //notif via db
            event(new FileRemarksChanged($applicant, $index));
        }
        else{
            $message = 'Invalid..';  
        }

        return redirect()->route('view-applicant-profile', $applicant->id)->with('message', $message);
    }

    public function declined_file($file){
        $remarks = [];
        $applicant = Application::where('file', 'LIKE', '%'.$file.'%')->first();
        $index = array_search($file, json_decode($applicant->file));
        $files = json_decode($applicant->file);

        if($applicant != null && $applicant->file_remarks != null){
            $file_remarks = json_decode($applicant->file_remarks);

            foreach($file_remarks as $value){
                $remarks[] = $value;                    // insert old remarks in array files[]
            }
            foreach($files as $key => $value){
                if($key == $index){
                    $remarks[$index] = 'declined';        // change the remarks of the viewed file
                }
            }

            $applicant->file_remarks = json_encode($remarks);
            $applicant->save();

            $message = $files[$index] .' is declined.';

            //notif via db
            event(new FileRemarksChanged($applicant, $index));
        }
        else{
            $message = 'Invalid..';  
        }

        return redirect()->route('view-applicant-profile', $applicant->id)->with('message', $message);
    }

    public function join_data(){            // retrieving of application and job details
        $data = Application::join('jobs_availables', 'jobs_availables.id', '=', 'applications.job_id')
                            ->where('applications.remarks', '!=', 'Inactive')
                            ->where('applications.remarks', '!=', 'Employee')
                            ->orWhere('applications.remarks', null)
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
        
        $jobs = JobsAvailable::where('active', 'Y')->get();
        return view('hr.job-posting', [
            "jobs" => $jobs,
        ]);
    }

    public function job_update(){
        $jobs = JobsAvailable::all();
        return view('hr.job-update', [
            "jobs" => $jobs,
        ]);
    }

    public function job_update_id($job_id){
        $job = JobsAvailable::findOrFail($job_id);
        
        $jobs = JobsAvailable::all();
        return view('hr.job-update-id', [
            "job" => $job,
            "jobs" => $jobs,
        ]);
    }

    public function job_update_success(Request $request){
        $job = JobsAvailable::where('id', $request->job_id)->first();
        $job->active = $request->active;
        $job->save();
        $message = 'Successfully Updated a Job!';

        return redirect()->route('job-update')->with('message', $message);
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
        $status = $applicant->remarks;
        if ($status == null){
            $applicant->remarks = 'Declined';
            $applicant->save();

            //notif via mail
            Mail::to($applicant->email)->send(new ApplicantRejected($applicant));

            $message = 'This applicant failed the initial screening.';
        }
        else{
            $message = 'This applicant status is '.$status;
        }
        return redirect()->route('view-applicant-profile', $applicant->id)->with('message', $message);
    }

    public function sendmail_proceed(Request $request): RedirectResponse
    {
        $applicant = Application::where('id', $request->id)->first();
        $status = $applicant->remarks;

        $account = User::where('application_id', $request->id)->first();

        if ($status == null && $request->status != null){
            $password = Str::of($applicant->name)->remove(' ');
            $password = strtolower($password);
            $pass = $password;
            if($account == null){
                User::create([
                    'name' => $applicant->name,
                    'email' => $applicant->email,
                    'password' => Hash::make($password),
                    'application_id' => $request->id,
                ]); 
            }

            $applicant->remarks = $request->status;
            $applicant->save();

            if($request->status == 'Requirements'){
                //notif via mail
                Mail::to($applicant->email)->send(new ApplicantProceed($applicant, $password));

                $message = 'This applicant passed the initial screening, but has incomplete requirement.';
            }
            elseif($request->status == 'Proceed (Hiring Office)'){
                //notif via mail
                Mail::to($applicant->email)->send(new ProceedToOffice($applicant, $password));

                $message = 'This applicant passed the initial screening, and proceeded to Hiring Office.';
            }
            else{
                $message = 'Something wrong.';
            }
        }
        elseif($status != null && $request->status != null){
            $applicant->remarks = $request->status;
            $applicant->save();
            //notif via db (system)
            event(new StatusChanged($applicant));
            $message = 'This applicant status is updated to '.$request->status;
        }
        elseif($status != null && $request->status == 'Signing of Documents'){
            //notif via mail

            $message = 'This applicant status is updated to '.$request->status;
        }
        else{
            $message = 'This applicant status is null.';
        }
        
        return redirect()->route('view-applicant-profile', $applicant->id)->with('message', $message);
    }

    public function become_employee($id){
        $applicant = Application::where('id', $id)->first();

        $emp_acc = Employee::where('job_id', $applicant->job_id)
                            ->where('active', 'Y')
                            ->count();
                            
        // set applicant account to inactive
        $others = Application::where('job_id', $applicant->job_id)
                            ->where('id', '!=', $applicant->id)
                            ->get();
        foreach($others as $other){
            $other->remarks = "Inactive";
            $other->save();
            $other = User::where('role_id', 1)
                    ->where('application_id', $other->id)
                    ->get();
            foreach($other as $o){
                $o->email = 'Inactive';
                $o->password = 'Inactive';
                $o->save();
            }
            
        }

        if($emp_acc == 0){
            // create employee record
            Employee::create([
                'job_id' => $applicant->job_id,
                'name' => $applicant->name,
            ]);

            $applicant->remarks = 'Employee';
            $applicant->save();
            
            $message = $applicant->name.' is now an employee!';
        }
        else{
            $message = 'There is still an employee with the same job.';
        }

        return redirect()->route('applicant-list')->with('message', $message);
    }
}
