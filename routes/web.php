<?php

use App\Models\Application;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('livewire.landing-page');
})->name('landing-page');


Route::get('/plm/jobs', [\App\Http\Controllers\JobsAvailableController::class, 'index'])->name('guest-jobs');


Route::post('/plm/jobs/application/{id}', [\App\Http\Controllers\Applicant\ApplicantController::class, 'guest_application'])
->name('guest-application');

Route::get('/plm/jobs/application/{id}', [\App\Http\Controllers\Applicant\ApplicantController::class, 'g'])
->name('guest-application-get');

Route::post('/plm/jobs/application/{id}/success', [\App\Http\Controllers\Applicant\ApplicantController::class, 'apply'])
->name('guest-application-success');

Route::get('/plm/jobs/search', [\App\Http\Controllers\JobsAvailableController::class, 'search'])
->name('search');

Route::get('/application/verify', function () {
    return view('livewire.verify-application');
})->name('verify');

Route::post('/application/verify/otp', [\App\Http\Controllers\Applicant\ApplicantController::class, 'send_otp'])
->name('send-otp');

Route::get('/applicant/upload/file/{id}', function ($id) {
    return view('livewire.upload-file-otp', ['id'=> $id]);
})->name('upload-file');

Route::post('/applicant/upload/file/{id}/success', [\App\Http\Controllers\Applicant\ApplicantController::class, 'upload_file'])
->name('upload-file-success');



Route::get('/create', function () {
    return view('form');
});

Route::post('/create', function () {
    Application::create([
        'name' => request('name'),
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/applicant/user/info/personal', function () {
        return view('livewire.user-personal-info');
    })->name('user-personal-info');
});

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::group(['middleware' => 'role:personnel management', 'prefix' => 'pm', 'as' => 'pm.'], function(){
        Route::resource('dashboard', \App\Http\Controllers\PM\PMController::class);
    });

    Route::group(['middleware' => 'role:recruitment', 'prefix' => 'recruitment', 'as' => 'r.'], function(){
        Route::resource('dashboard', \App\Http\Controllers\Recruitment\RecruitmentController::class);
    });

    Route::group(['middleware' => 'role:compensation', 'prefix' => 'compensation', 'as' => 'c.'], function(){
        Route::resource('dashboard', \App\Http\Controllers\Compensation\CompensationController::class);
    });

    Route::group(['middleware' => 'role:hr chief', 'prefix' => 'chief', 'as' => 'chief.'], function(){
        Route::resource('dashboard', \App\Http\Controllers\Chief\ChiefController::class);
    });

    Route::group(['middleware' => 'role:applicant', 'prefix' => 'applicant', 'as' => 'applicant.'], function(){
        Route::resource('dashboard', \App\Http\Controllers\Applicant\ApplicantController::class);
    });

    // application section
    Route::group(['middleware' => 'role:applicant'], function(){
        Route::get('/applicant/jobs/application', [\App\Http\Controllers\Applicant\ApplicantController::class, 'application'])
        ->name('application-section');
    });

    // add file
    Route::group(['middleware' => 'role:applicant'], function(){
        Route::post('/applicant/file/upload/success', [\App\Http\Controllers\Applicant\ApplicantController::class, 'add_file'])
        ->name('add-file-success');
    });

    Route::group(['middleware' => 'role:applicant'], function(){
        Route::post('/applicant/jobs/detail/{id}', [\App\Http\Controllers\Applicant\ApplicantController::class, 'store'])
        ->name('applicant.apply');
    });

    Route::group([['middleware' => 'role:personnel management', 'middleware' => 'role:hr chief'], 'prefix' => 'pm'], function(){
        Route::get('/view/employee/list', [\App\Http\Controllers\PM\PMController::class, 'emp_list'
        ])->name('view-employee-list');
    });

    Route::group([['middleware' => 'role:personnel management', 'middleware' => 'role:hr chief'], 'prefix' => 'pm'], function(){
        Route::get('/view/employee/profile/{id}', [\App\Http\Controllers\PM\PMController::class, 'emp_detail'])
        ->name('view-employee-profile');
    });

    Route::group([['middleware' => 'role:personnel management', 'middleware' => 'role:hr chief'], 'prefix' => 'pm'], function(){
        Route::get('/view/request', [\App\Http\Controllers\PM\PMController::class, 'document_request'])
        ->name('view-request');
    });

    Route::group(['middleware' => 'role:personnel management', 'prefix' => 'pm'], function(){
        Route::get('/view/request/notify/{id}', [\App\Http\Controllers\PM\PMController::class, 'notify_emp'])
        ->name('notify-employee');
    });

    Route::group([['middleware' => 'role:recruitment', 'middleware' => 'role:hr chief'], 'prefix' => 'recruitment'], function(){
        Route::get('/view/applicant/list', [\App\Http\Controllers\Recruitment\RecruitmentController::class, 'join_data'])
        ->name('applicant-list');
    });

    Route::group([['middleware' => 'role:recruitment', 'middleware' => 'role:hr chief'], 'prefix' => 'recruitment'], function(){
        Route::get('/view/applicant/profile/{id}', [\App\Http\Controllers\Recruitment\RecruitmentController::class, 'applicant_profile'])
        ->name('view-applicant-profile');
    });

    Route::get('/view/applicant/profile/{file}', [\App\Http\Controllers\Recruitment\RecruitmentController::class, 'view_file'])
    ->name('view-file');

    Route::group(['middleware' => 'role:recruitment', 'prefix' => 'recruitment'], function(){
        Route::get('/view/applicant/profile/{file}/approved', [\App\Http\Controllers\Recruitment\RecruitmentController::class, 'approved_file'])
        ->name('approved-file');
    });

    Route::group(['middleware' => 'role:recruitment', 'prefix' => 'recruitment'], function(){
        Route::get('/view/applicant/profile/{file}/declined', [\App\Http\Controllers\Recruitment\RecruitmentController::class, 'declined_file'])
        ->name('declined-file');
    });

    Route::group(['middleware' => 'role:recruitment', 'prefix' => 'recruitment'], function(){
        Route::get('/view/applicant/profile/{id}/reject', [\App\Http\Controllers\Recruitment\RecruitmentController::class, 'sendmail_rejected'])
        ->name('email-reject');
    });

    Route::group(['middleware' => 'role:recruitment', 'prefix' => 'recruitment'], function(){
        Route::get('/view/applicant/profile/{id}/success', [\App\Http\Controllers\Recruitment\RecruitmentController::class, 'sendmail_proceed'])
        ->name('email-proceed');
    });

    Route::group([['middleware' => 'role:recruitment', 'middleware' => 'role:hr chief'], 'prefix' => 'recruitment'], function(){
        Route::get('/job/posting', [\App\Http\Controllers\Recruitment\RecruitmentController::class, 'job_posting'])
        ->name('job-posting');
    });

    Route::group(['middleware' => 'role:recruitment', 'prefix' => 'recruitment'], function(){
        Route::post('/job/posting/success', [\App\Http\Controllers\Recruitment\RecruitmentController::class, 'job_post'])
        ->name('job-post');
    });

    Route::group(['middleware' => 'role:recruitment', 'prefix' => 'recruitment'], function(){
        Route::get('/job/update', [\App\Http\Controllers\Recruitment\RecruitmentController::class, 'job_update'])
        ->name('job-update');
    });

    Route::group(['middleware' => 'role:recruitment', 'prefix' => 'recruitment'], function(){
        Route::get('/job/update/{job_id}', [\App\Http\Controllers\Recruitment\RecruitmentController::class, 'job_update_id'])
        ->name('job-update-id');
    });

    Route::group(['middleware' => 'role:recruitment', 'prefix' => 'recruitment'], function(){
        Route::post('/job/update/success', [\App\Http\Controllers\Recruitment\RecruitmentController::class, 'job_update_success'])
        ->name('job-update-id-success');
    });

    Route::group(['middleware' => 'role:recruitment', 'prefix' => 'recruitment'], function(){
        Route::get('/view/applicant/profile/{id}/signed', [\App\Http\Controllers\Recruitment\RecruitmentController::class, 'become_employee'])
        ->name('emp-accept');
    });

    Route::group([['middleware' => 'role:compensation', 'middleware' => 'role:hr chief'], 'prefix' => 'compensation'], function(){
        Route::get('/leave/request', [\App\Http\Controllers\Compensation\CompensationController::class, 'leave_request'])
        ->name('leave-request');
    });

    Route::group(['middleware' => 'role:hr chief', 'prefix' => 'chief'], function(){
        Route::get('/leave/request/{id}/{type}', [\App\Http\Controllers\Chief\ChiefController::class, 'leave_request_id'])
        ->name('leave-request-id');
    });

    Route::group(['middleware' => 'role:hr chief', 'prefix' => 'chief'], function(){
        Route::post('/leave/request/{id}/success', [\App\Http\Controllers\Chief\ChiefController::class, 'approve_leave_request'])
        ->name('leave-request-success');
    });

    Route::group([['middleware' => 'role:compensation', 'middleware' => 'role:hr chief'], 'prefix' => 'compensation'], function(){
        Route::get('/leave/list', [\App\Http\Controllers\Compensation\CompensationController::class, 'leave_list'])
        ->name('leave-list');
    });

    Route::group([['middleware' => 'role:compensation', 'middleware' => 'role:hr chief'], 'prefix' => 'compensation'], function(){
        Route::get('/time-keeping', [\App\Http\Controllers\Compensation\CompensationController::class, 'time_keeping'])
        ->name('time-keeping');
    });

    Route::group(['middleware' => 'role:compensation', 'prefix' => 'compensation'], function(){
        Route::get('/time-keeping/manage', [\App\Http\Controllers\Compensation\CompensationController::class, 'dtr'])
        ->name('add-dtr');
    });

    Route::group(['middleware' => 'role:compensation', 'prefix' => 'compensation'], function(){
        Route::post('/time-keeping/manage/success', [\App\Http\Controllers\Compensation\CompensationController::class, 'add_record'])
        ->name('add-dtr-success');
    });

    Route::group(['middleware' => 'role:compensation', 'prefix' => 'compensation'], function(){
        Route::get('/leave-credit', function () {
            return view('hr.leave-credit');
        })->name('leave-credit');
    });

    Route::group(['middleware' => 'role:compensation', 'prefix' => 'compensation'], function(){
        Route::get('/leave-credit/computation/complete-attendance', [
            \App\Http\Controllers\Compensation\CompensationController::class, 'lc_computation_complete_attendance'
            ])->name('lc-complete-attendance');
    });

    Route::group(['middleware' => 'role:compensation', 'prefix' => 'compensation'], function(){
        Route::post('/leave-credit/computation/complete-attendance/success', [
            \App\Http\Controllers\Compensation\CompensationController::class, 'save_new_leave_credit'
            ])->name('lc-complete-attendance-success');
    });

    Route::group(['middleware' => 'role:compensation', 'prefix' => 'compensation'], function(){
        Route::post('/leave-credit/computation', [\App\Http\Controllers\Compensation\CompensationController::class, 'lc_computation'])
        ->name('lc-computation');
    });

    Route::group(['middleware' => 'role:compensation', 'prefix' => 'compensation'], function(){
        Route::post('/leave-credit/computation/save', [\App\Http\Controllers\Compensation\CompensationController::class, 'lc_computation_save'])
        ->name('leave-computation-save');
    });
}); 