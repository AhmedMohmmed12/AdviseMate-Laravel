<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudentAppointmentController;
use App\Http\Controllers\StudentTicketController;
use App\Http\Controllers\AdvisorDashboardController;
use App\Http\Controllers\AdvisorAppointmentController;
use App\Http\Controllers\AdvisorTicketController;
use App\Http\Controllers\AdvisorStudentsController;
use App\Http\Controllers\SupervisorController;
// use LaravelLocalization
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ //...
Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('supervisor')->middleware(['auth'])->group(function () {
    Route::get('create' , [UserController::class , 'create'])->name('create');
    Route::post('store' , [UserController::class , 'store'])->name('store');
    Route::get('/dashboard', function () {return view('supervisor.dashboard');})->name('supervisor.dashboard');
    Route::get('users' , [UserController::class , 'index'])->name('index');
    Route::get('activity-log', [ActivityLogController::class, 'activityLog'])->name('activity-log');
    Route::get('/supervisor/activity-log', [ActivityLogController::class, 'activityLog'])->name('supervisor.activity-log');
    Route::get('permission', [SupervisorController::class, 'permission'])->name('permission');
});


Route::name('student.')->prefix('student')->group(function(){
    Route::get('dashboard',[StudentDashboardController::class, 'stDashboard'])->name('dashboard'); 
    Route::get('appointment', [StudentAppointmentController::class,'stAppointment'])->name('appointment');
    Route::get('ticket', [StudentTicketController::class,'stTicket'])->name('ticket');
});


Route::name('advisor.')->prefix('advisor')->group(function(){
    Route::get('dashboard', [AdvisorDashboardController::class,'adDashboard'])->name('dashboard');
    Route::get('appointment', [AdvisorAppointmentController::class,'adAppointment'])->name('appointment');
    Route::get('ticket', [AdvisorTicketController::class,'adTicket'])->name('ticket');
    Route::get('student', [AdvisorStudentsController::class,'adStudents'])->name('student');
    });
});



