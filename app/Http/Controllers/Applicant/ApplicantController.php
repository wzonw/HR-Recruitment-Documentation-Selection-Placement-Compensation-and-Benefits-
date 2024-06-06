<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Mail\SendOTP;
use App\Models\Application;
use App\Models\JobApplication;
use App\Models\JobsAvailable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /*if(Gate::denies('for-applicants')){
            abort(403);
        }*/

        // Application::where('id',  application_id of user who logged in)->first();
        $applicant = Application::where('id', Auth::user()->id)->first();
        $applicant->file = json_decode($applicant->file);
        $applicant->file_remarks = json_decode($applicant->file_remarks);
        return view('applicant-dashboard', ['applicant'=>$applicant]);
    }

    public function detail($id)
    {

        $job = JobsAvailable::where([
            'id' => $id,
            ])->first();

        return view('job-details', ['job' => $job]);
    }

    public function view_file($file)
    {
        $data = $file;
        return view('livewire.view-file', compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    public function application()
    {
        $application = Application::where('id', Auth::user()->application_id)->first();
        $job = JobsAvailable::where('id', $application->job_id)->first();
        return view('livewire.application-section', [
            'application'=>$application,
            'job'=>$job,
        ]);
    }

    public function guest_application(Request $request){
        $job = JobsAvailable::findOrFail($request->input('job_id'));
        
        return view('livewire.app-profile', [
            'job' =>$job
        ]);

    }

    public function g($id){
        $job = JobsAvailable::findOrFail($id);
        
        return view('livewire.app-profile', [
            'job' =>$job
        ]);

    }

    public function apply(Request $request){
        
        $request->validate([
            'job_id'=> ['required', 'numeric'], //only numbers
            'first_name'=> ['required', 'min:3', 'max:50', 'regex:/^[a-zA-Z \-\.]*$/'], //alpha, space, -, .
            'last_name'=> ['required', 'min:3', 'max:50', 'regex:/^[a-zA-Z \-\.]*$/'], //alpha, space, -, .
            'email'=> ['required', 'regex:/^.+@.+\.com$/'], //must have @ and .com
            'number'=> ['required', 'regex:/^(09\d{9}|\+639\d{9})+$/', 'min:11', 'max:13'], //"09,9digits", "+63,9digits"
            'file.*'=> ['required', 'mimes:pdf', 'max:1024'], //only accept pdf w/ max size 1mb
        ]);

        //checks if there's an ongoing application via email/number
        $application = Application::orderBy('created_at', 'desc')
                                    ->where('email', $request->email)
                                    ->orWhere('contact_number', $request->number)
                                    ->first();
        $name = $request->input('first_name').$request->input('last_name');
        
        $files = [];
        if($application == null){
            if( $request -> has('file')){
                foreach($request->file('file') as $f)
                {
                    $filename = Str::of($name)->remove(' ');
                    $filename = $filename . '_' . $f->getClientOriginalName();
                    $path = ('uploads/file');
                    $f->move($path, $filename);
                    $files[] = $filename;
                }
                
                $upload = json_encode($files); //encodes array, must be decoded when displayed
            };
            Application::create([
                'job_id' => $request->input('job_id'),
                'first_name' => $request->input('first_name'),
                'middle_name' => $request->input('middle_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'contact_number' => $request->input('number'),
                'file'=> $upload,
            ]);

            $message = 'Successfully Applied!';
        }
        else{
            if($application->remarks == 'Employee'){
                if( $request -> has('file')){
                    foreach($request->file('file') as $f)
                    {
                        $filename = Str::of($request->input('name'))->remove(' ');
                        $filename = $filename . '_' . $f->getClientOriginalName();
                        $path = ('uploads/file');
                        $f->move($path, $filename);
                        $files[] = $filename;
                    }
                    
                    $upload = json_encode($files); //encodes array, must be decoded when displayed
                };
                Application::create([
                    'job_id' => $request->input('job_id'),
                    'first_name' => $request->input('first_name'),
                    'middle_name' => $request->input('middle_name'),
                    'last_name' => $request->input('last_name'),
                    'email' => $request->input('email'),
                    'contact_number' => $request->input('number'),
                    'file'=> $upload,
                ]);
    
                $message = 'Successfully Applied!';
            }
            elseif($application->remarks == 'Inactive'){
                $days = NOW()->diffInDays($application->created_at);

                if($days > 182){
                    if( $request -> has('file')){
                        foreach($request->file('file') as $f)
                        {
                            $filename = Str::of($request->input('name'))->remove(' ');
                            $filename = $filename . '_' . $f->getClientOriginalName();
                            $path = ('uploads/file');
                            $f->move($path, $filename);
                            $files[] = $filename;
                        }
                        
                        $upload = json_encode($files); //encodes array, must be decoded when displayed
                    };
                    Application::create([
                        'job_id' => $request->input('job_id'),
                        'first_name' => $request->input('first_name'),
                        'middle_name' => $request->input('middle_name'),
                        'last_name' => $request->input('last_name'),
                        'email' => $request->input('email'),
                        'contact_number' => $request->input('number'),
                        'file'=> $upload,
                    ]);
        
                    $message = 'Successfully Applied!';
                }
                else{
                    $month = date('F', strtotime($application->created_at));
                    $message = 'You had an application in '.$month.'. Apply 6 months after your previous application.';
                }
            }
            else{
                $message = 'You have an ongoing application with id: '.''.$application->id;
            }
        }

        return redirect()->route('guest-application-get', ['id'=>$request->job_id])->with('message', $message);
    }

    public function update_personal_info(Request $request){
        $applicant = Application::where('id', $request->id)->first();
        if($applicant != null && $request != null){
            $applicant->first_name = $request->first_name;
            $applicant->middle_name = $request->middle_name;
            $applicant->last_name = $request->last_name;
            $applicant->suffix = $request->suffix;
            if ($request->gender != 'x'){
                $applicant->gender = $request->gender;
            }
            $applicant->birth_date = $request->birthdate;
            $applicant->age = $request->age;
            $applicant->email = $request->email;
            $applicant->address = $request->address;
            $applicant->contact_number = $request->mobile;
            $applicant->save();
            $message = "Successfully updated.";
        }
        else{
            $message = "Error found.";
        }
        return redirect()->route('personal-info')->with('message', $message);

    }

    public function add_file(Request $request){
        $request->validate([
            'file.*'=> ['required', 'mimes:pdf', 'max:1024'], //only accept pdf w/ max size 1mb
        ]);

        $applicant = Application::where('id', Auth::user()->application_id)->first();
        $applicant->file = json_decode($applicant->file); // convert string to array

        $files = [];
        if( $request -> has('file')){
            foreach($applicant->file as $value)
                {
                    $files[] = $value; // insert old files in array files[]
                }
            foreach($request->file('file') as $f)
                {
                    $filename = Str::of($applicant->name)->remove(' ');
                    $filename = $filename . '_' . $f->getClientOriginalName();
                    $path = ('uploads/file');
                    $f->move($path, $filename);
                    $files[] = $filename; // insert new upload file in array files[]
                }
            
            $upload = json_encode($files); // convert array to string
            $applicant->file = $upload; // update table, column file...
            $applicant->save();

            $message = "Successfully added file(s)";
        }
        else{
            $message = 'Error in uploading file.';
        }

        return redirect()->route('applicant-dashboard')->with('message', $message);
    }

    public function send_otp(Request $request){

        $data = Application::where('id', $request->id)
                    ->where('email', $request->email)
                    ->where('job_id', $request->job_id)
                    ->where('remarks', 'Requirements')
                    ->first();
        if($data != null){
            $id = $data->id;

            $otp = mt_rand(100000, 999999);
            // send otp via email
            Mail::to($data->email)->send(new SendOTP($data, $otp));

            $data->otp = $otp;
            $data->save();
            return redirect()->route('upload-file', $id); 
        }
        else{
            $message = 'Application not found.';
            
            return redirect()->route('verify')->with('message', $message);
        }
    }

    public function upload_file(Request $request){
        $request->validate([
            'otp' => ['required', 'numeric', 'digits:6'],
            'file.*'=> ['required', 'mimes:pdf', 'max:1024'], //only accept pdf w/ max size 1mb
        ]);

        $applicant = Application::where('id', $request->id)->first();
        $applicant->file = json_decode($applicant->file); // convert string to array

        $files = [];
        if( $request -> has('file') && $request->otp == $applicant->otp){
            foreach($applicant->file as $value)
                {
                    $files[] = $value; // insert old files in array files[]
                }
            foreach($request->file('file') as $f)
                {
                    $filename = Str::of($applicant->name)->remove(' ');
                    $filename = $filename . '_' . $f->getClientOriginalName();
                    $path = ('uploads/file');
                    $f->move($path, $filename);
                    $files[] = $filename; // insert new upload file in array files[]
                }
            
            $upload = json_encode($files); // convert array to string
            $applicant->file = $upload; // update table, column file...
            $applicant->save();

            $message = "Successfully added file(s)";
        }
        else{
            $message = 'OTP is incorrect.';
        }
        return redirect()->route('verify')->with('message', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}