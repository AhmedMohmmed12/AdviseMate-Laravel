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
use App\Http\Controllers\Auth\SupervisorLoginController;
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

Route::name('supervisor.')->middleware(['auth'])->prefix('supervisor')->group(function () {
    // Public routes (login)
    // Route::get('login', [SupervisorLoginController::class, 'showLoginForm'])->name('login');
    // Route::post('login', [SupervisorLoginController::class, 'login']);
    
    // Protected routes - require supervisor authentication
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('store', [UserController::class, 'store'])->name('store');
        Route::get('dashboard', function () { return view('supervisor.dashboard'); })->name('dashboard');
        Route::get('users', [UserController::class, 'index'])->name('index');
        Route::get('activity-log', [ActivityLogController::class, 'activityLog'])->name('activity-log');
        Route::get('permission', [SupervisorController::class, 'permission'])->name('permission');
        Route::post('logout', [SupervisorLoginController::class, 'logout'])->name('logout');
});


Route::name('student.')->middleware(['auth'])->prefix('student')->group(function(){
    Route::get('dashboard',[StudentDashboardController::class, 'stDashboard'])->name('dashboard'); 
    Route::get('appointment', [StudentAppointmentController::class,'stAppointment'])->name('appointment');
    Route::get('ticket', [StudentTicketController::class,'stTicket'])->name('ticket');
});


Route::name('advisor.')->prefix('advisor')->middleware(['auth'])->group(function(){
    Route::get('dashboard', [AdvisorDashboardController::class,'adDashboard'])->name('dashboard');
    Route::get('appointment', [AdvisorAppointmentController::class,'adAppointment'])->name('appointment');
    Route::get('ticket', [AdvisorTicketController::class,'adTicket'])->name('ticket');
    Route::get('student', [AdvisorStudentsController::class,'adStudents'])->name('student');
});
});



