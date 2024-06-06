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

Route::get('/applicant/dashboard', [\App\Http\Controllers\Applicant\ApplicantController::class, 'index'])
->name('applicant-dashboard');

Route::get('/applicant/login', function () {
    return view('livewire.sample');
})->name('sample');

Route::post('/success', [\App\Http\Controllers\Applicant\ApplicantController::class, 'applicant_login_success'])
->name('applicant-login-success');

Route::get('/applicant/personal/info', function () {
    return view('livewire.user-personal-info');
})->name('personal-info');

Route::get('/applicant/personal/info/s', [\App\Http\Controllers\Applicant\ApplicantController::class, 'update_info'])
->name('personal-info-update');

Route::post('/applicant/personal/info/success', [\App\Http\Controllers\Applicant\ApplicantController::class, 'update_personal_info'])
->name('personal-info-success');

Route::get('/view/applicant/profile/{file}', [\App\Http\Controllers\Applicant\ApplicantController::class, 'view_file'])
->name('view-file');

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
