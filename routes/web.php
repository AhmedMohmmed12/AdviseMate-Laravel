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
use App\Http\Controllers\AdvisorAvailabilityController;
use App\Http\Controllers\AdvisorProfileController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
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
Route::post('/test', [StudentController::class, 'test']);

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ //...
Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::name('supervisor.')->middleware(['auth'])->prefix('supervisor')->group(function () {
    // Public routes (login)
    // Route::get('login', [SupervisorLoginController::class, 'showLoginForm'])->name('login');
    // Route::post('login', [SupervisorLoginController::class, 'login']);
    
    // Protected routes - require supervisor authentication
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('store', [UserController::class, 'store'])->name('store');
        Route::post('delete/{id}', [UserController::class, 'delete'])->name('delete');
        Route::put('edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::get('dashboard', function () { return view('supervisor.dashboard'); })->name('dashboard');
        Route::get('users', [UserController::class, 'index'])->name('index');
        Route::get('activity-log', [ActivityLogController::class, 'activityLog'])->name('activity-log');
        Route::get('permission', [SupervisorController::class, 'permission'])->name('permission');
        Route::get('profile', [SupervisorController::class, 'profile'])->name('profile');
        Route::put('profile/{id}', [SupervisorController::class, 'profileEdit'])->name('profile.edit');
        Route::post('profile/password', [SupervisorController::class, 'changePassword'])->name('profile.password');
        Route::post('logout', [SupervisorLoginController::class, 'logout'])->name('logout');
});


Route::name('student.')->prefix('student')->middleware(['auth:student'])->group(function(){
    Route::get('dashboard',[StudentDashboardController::class, 'stDashboard'])->name('dashboard'); 
    Route::get('appointment', [StudentAppointmentController::class,'stAppointment'])->name('appointment');
    Route::get('get-availabilities', [StudentAppointmentController::class, 'getAvailabilities'])->name('get-availabilities');
    Route::post('book-appointment', [StudentAppointmentController::class, 'bookAppointment'])->name('book-appointment');
    Route::post('cancel-appointment/{appointmentId}', [StudentAppointmentController::class, 'cancelAppointment'])->name('cancel-appointment');
    Route::get('ticket', [StudentTicketController::class,'stTicket'])->name('ticket');
    Route::get('get-ticket-types', [StudentTicketController::class, 'getAllTicketTypes'])->name('get-ticket-types');
    Route::post('ticket/create', [StudentTicketController::class, 'createTicket'])->name('ticket.create');
    
    // Add profile routes
    Route::get('profile', [StudentProfileController::class, 'profile'])->name('profile');
    Route::put('profile/{id}', [StudentProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile/password', [StudentProfileController::class, 'changePassword'])->name('profile.password');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

// Student registration route
Route::post('student/store', [StudentController::class, 'store'])->name('student.store');
Route::put('student/edit/{id}', [StudentController::class, 'edit'])->name('student.edit');
Route::post('student/delete/{id}', [StudentController::class, 'delete'])->name('student.delete');

Route::name('advisor.')->middleware(['auth'])->prefix('advisor')->group(function(){
    Route::get('dashboard', [AdvisorDashboardController::class,'adDashboard'])->name('dashboard');
    Route::get('appointment', [AdvisorAppointmentController::class,'adAppointment'])->name('appointment');
    Route::get('ticket', [AdvisorTicketController::class,'adTicket'])->name('ticket');
    Route::get('student', [AdvisorStudentsController::class,'adStudents'])->name('student');
    Route::get('profile', [AdvisorProfileController::class, 'profile'])->name('profile');
    Route::put('profile/{id}', [AdvisorProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile/password', [AdvisorProfileController::class, 'changePassword'])->name('profile.password');
    Route::post('ticket/update-status/{id}', [AdvisorTicketController::class, 'updateTicketStatus'])->name('ticket.update-status');
    
    // Appointment Routes
    Route::get('get-appointments', [AdvisorAppointmentController::class, 'getAppointments'])->name('get-appointments');
    Route::post('appointment-status/{id}', [AdvisorAppointmentController::class, 'updateStatus'])->name('appointment-status');
    
    // Availability Routes
    Route::prefix('availability')->middleware(['auth'])->group(function() {
        Route::post('/', [AdvisorAvailabilityController::class, 'store'])->name('availability.store');
        Route::put('/{availability}', [AdvisorAvailabilityController::class, 'update'])->name('availability.update');
        Route::post('/{availability}', [AdvisorAvailabilityController::class, 'delete'])->name('availability.delete');
        Route::get('/fetch', [AdvisorAvailabilityController::class, 'fetch'])->name('availability.fetch');
    });
});

});



