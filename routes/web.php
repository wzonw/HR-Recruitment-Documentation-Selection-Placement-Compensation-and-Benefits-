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

Route::get('/landing', function () {
    return view('livewire.landing-page');
})->name('landing-page');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/applicant/user/info/personal', function () {
        return view('livewire.user-personal-info');
    })->name('user-personal-info');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/applicant/dashboard', [\App\Http\Controllers\Applicant\ApplicantController::class, 'index'])
    ->name('applicant-dashboard');
});

Route::get('/view/applicant/profile/{file}', [\App\Http\Controllers\Applicant\ApplicantController::class, 'view_file'])
->name('view-file');


/*
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

Route::get('/view/applicant/profile/{file}', [\App\Http\Controllers\Recruitment\RecruitmentController::class, 'view_file'])
->name('view-file');*/

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
