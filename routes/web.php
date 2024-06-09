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

/*Route::get('/', function () {
    return view('livewire.landing-page');
})->name('landing-page');*/

Route::get('/dtr/report', function () { 
    return view('hr.dtr-report');
})->name('dtr-report');

Route::get('/dtr/report/full-time/{day}', [\App\Http\Controllers\Compensation\CompensationController::class, 'dtr_report_full_time'])
->name('dtr-report-full-time');

Route::get('/dtr/report/part-time/{day}', [\App\Http\Controllers\Compensation\CompensationController::class, 'dtr_report_part_time'])
->name('dtr-report-part-time');

Route::get('/dtr/report/generate', [\App\Http\Controllers\Compensation\CompensationController::class, 'dtr_report_generate'])
->name('dtr-report-generate');

// hr
Route::get('/', [\App\Http\Controllers\PM\PMController::class, 'index'])
->name('dashboard-1');

Route::get('/dashboard/update', [\App\Http\Controllers\PM\PMController::class, 'update_index'])
->name('update-dashboard');

Route::get('/chief/dashboard', [\App\Http\Controllers\Chief\ChiefController::class, 'index'])
->name('dashboard-2');

Route::get('/chief/dashboard/update', [\App\Http\Controllers\Chief\ChiefController::class, 'update_index'])
->name('update-dashboard-chief');

// for pm & chief
Route::get('/view/employee/list', [\App\Http\Controllers\PM\PMController::class, 'emp_list'])
->name('view-employee-list');

Route::get('/view/employee/profile/{id}', [\App\Http\Controllers\PM\PMController::class, 'emp_detail'])
->name('view-employee-profile');

Route::get('/view/request', [\App\Http\Controllers\PM\PMController::class, 'document_request'])
->name('view-request');

Route::get('/view/employee/list/emp_search', [\App\Http\Controllers\PM\PMController::class, 'emp_search'])
->name('search_employee');

Route::get('/view/request/emp_search', [\App\Http\Controllers\PM\PMController::class, 'req_search'])
->name('req_search');

// for pm
Route::get('/view/request/notify/{id}', [\App\Http\Controllers\PM\PMController::class, 'notify_emp'])
->name('notify-employee');

Route::get('/view/request/document-1/export/{id}', [\App\Http\Controllers\PM\PMController::class, 'export_document_1'])
->name('export-document');

Route::get('/view/request/document-2/export/{id}', [\App\Http\Controllers\PM\PMController::class, 'export_document_2'])
->name('export-document-w-compensation');

// for recruitment and chief
Route::get('/view/applicant/list', [\App\Http\Controllers\Recruitment\RecruitmentController::class, 'join_data'])
->name('applicant-list');

Route::get('/view/applicant/profile/{id}', [\App\Http\Controllers\Recruitment\RecruitmentController::class, 'applicant_profile'])
->name('view-applicant-profile');

Route::get('/view/applicant/profile/view/{file}', [\App\Http\Controllers\Recruitment\RecruitmentController::class, 'view_file'])
->name('view-file');

Route::get('/job/posting', [\App\Http\Controllers\Recruitment\RecruitmentController::class, 'job_posting_dropdown'])
->name('job-posting-1');

// for recruitment
Route::get('/view/applicant/profile/{file}/approved', [\App\Http\Controllers\Recruitment\RecruitmentController::class, 'approved_file'])
->name('approved-file');

Route::get('/view/applicant/profile/{file}/declined', [\App\Http\Controllers\Recruitment\RecruitmentController::class, 'declined_file'])
->name('declined-file');

Route::get('/view/applicant/profile/{id}/reject', [\App\Http\Controllers\Recruitment\RecruitmentController::class, 'sendmail_rejected'])
->name('email-reject');

Route::get('/view/applicant/profile/{id}/success', [\App\Http\Controllers\Recruitment\RecruitmentController::class, 'sendmail_proceed'])
->name('email-proceed');

Route::get('/job/posting/input', [\App\Http\Controllers\Recruitment\RecruitmentController::class, 'job_posting_input'])
->name('job-posting-2');

Route::post('/job/posting/success', [\App\Http\Controllers\Recruitment\RecruitmentController::class, 'job_post'])
->name('job-post');

Route::get('/job/update', [\App\Http\Controllers\Recruitment\RecruitmentController::class, 'job_update'])
->name('job-update');

Route::get('/job/update/{job_id}', [\App\Http\Controllers\Recruitment\RecruitmentController::class, 'job_update_id'])
->name('job-update-id');

Route::post('/job/update/success', [\App\Http\Controllers\Recruitment\RecruitmentController::class, 'job_update_success'])
->name('job-update-id-success');

Route::get('/view/applicant/profile/{id}/signed', [\App\Http\Controllers\Recruitment\RecruitmentController::class, 'become_employee'])
->name('emp-accept');

// for compensation n chief
Route::get('/leave/request', [\App\Http\Controllers\Compensation\CompensationController::class, 'leave_request'])
->name('leave-request');

Route::get('/leave/list', [\App\Http\Controllers\Compensation\CompensationController::class, 'leave_list'])
->name('leave-list');

Route::get('/time-keeping', [\App\Http\Controllers\Compensation\CompensationController::class, 'time_keeping'])
->name('time-keeping');

Route::get('/time-keeping/manage', [\App\Http\Controllers\Compensation\CompensationController::class, 'dtr'])
->name('add-dtr');

Route::post('/time-keeping/manage/success', [\App\Http\Controllers\Compensation\CompensationController::class, 'add_record'])
->name('add-dtr-success');

Route::get('/leave-credit', function () {return view('hr.leave-credit');})
->name('leave-credit');

Route::get('/leave-credit/computation/complete-attendance', [
    \App\Http\Controllers\Compensation\CompensationController::class, 'lc_computation_complete_attendance'
])->name('lc-complete-attendance');

Route::post('/leave-credit/computation/complete-attendance/success', [
    \App\Http\Controllers\Compensation\CompensationController::class, 'save_new_leave_credit'
])->name('lc-complete-attendance-success');

Route::post('/leave-credit/computation', [\App\Http\Controllers\Compensation\CompensationController::class, 'lc_computation'])
->name('lc-computation');

Route::post('/leave-credit/computation/save', [\App\Http\Controllers\Compensation\CompensationController::class, 'lc_computation_save'])
->name('leave-computation-save');

Route::post('/leave-credit/computation/resignation', [\App\Http\Controllers\Compensation\CompensationController::class, 'lc_resignation'])
->name('lc-resignation');

Route::get('/leave-credit/computation/resignation/monetization/{id}', [\App\Http\Controllers\Compensation\CompensationController::class, 'monetize_lc_resignation'])
->name('lc-resignation-monetization');

Route::get('/leave-credit/computation/resignation/transfer/{id}', [\App\Http\Controllers\Compensation\CompensationController::class, 'transfer_lc_resignation'])
->name('lc-resignation-transfer');

Route::get('/leave-credit/computation/retirement', [\App\Http\Controllers\Compensation\CompensationController::class, 'monetize_lc_retirement'])
->name('lc-retirement');

Route::get('/leave-credit/computation/retirement/{id}/download', [\App\Http\Controllers\Compensation\CompensationController::class, 'download_file'])
->name('download-lc');

Route::get('/leave-credit/computation/resignation/{id}/download', [\App\Http\Controllers\Compensation\CompensationController::class, 'download_file_transfer'])
->name('download-lc-transfer');

Route::get('/compensation/leave/list/leave_search', [\App\Http\Controllers\Compensation\CompensationController::class, 'leave_search'])
->name('leave_search');

Route::get('/compensation/leave/request/lr_search', [\App\Http\Controllers\Compensation\CompensationController::class, 'lr_search'])
->name('lr_search');

Route::get('/compensation/time-keeping/filter', [\App\Http\Controllers\Compensation\CompensationController::class, 'tk_filter'])
->name('time-keeping-filter');

// for chief
Route::get('/leave/request/{id}/{type}', [\App\Http\Controllers\Chief\ChiefController::class, 'leave_request_id'])
->name('leave-request-id');

Route::post('/leave/request/{id}/success', [\App\Http\Controllers\Chief\ChiefController::class, 'approve_leave_request'])
->name('leave-request-success');

Route::get('/leave/req/outside/hr', [\App\Http\Controllers\Chief\ChiefController::class, 'leave_request_not_hr'])
->name('leave-request-not-hr');

Route::post('/leave/req/outside/hr/success', [\App\Http\Controllers\Chief\ChiefController::class, 'approve_leave_request_not_hr'])
->name('leave-request-not-hr-success');

// applicant account
Route::get('/applicant/dashboard', [\App\Http\Controllers\Applicant\ApplicantController::class, 'index'])
->name('applicant-dashboard');

Route::get('/applicant/jobs/application', [\App\Http\Controllers\Applicant\ApplicantController::class, 'application'])
->name('application-section');

Route::post('/applicant/file/upload/success', [\App\Http\Controllers\Applicant\ApplicantController::class, 'add_file'])
->name('add-file-success');

// guest applicants
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
