<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityLogController;

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
Route::get("/test/ahmad" , [StudentController::class , "ahmad"]);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('supervisor')->middleware(['auth'])->group(function () {
    Route::get('create' , [UserController::class , 'create'])->name('create');
    Route::post('store' , [UserController::class , 'store'])->name('store');
    Route::get('/dashboard', function () {
        return view('supervisor.dashboard');
    })->name('supervisor.dashboard');
    
    Route::get('users' , [UserController::class , 'index'])->name('index');

    
    Route::get('/activity-log', function () {
        return view('supervisor.activitylog');
    })->name('supervisor.activity-log');
});


Route::name('student.')->prefix('student')->group(function(){
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/appointment', function () {
        return view('appointment');
    })->name('appointment');
    
    Route::get('/ticket', function () {
        return view('ticket');
    })->name('ticket');
});



Route::name('advisor.')->prefix('advisor')->group(function(){
    Route::get('dashboard', function(){
        return view('advisor.advisor-dashboard');
    })->name('dashboard');
    
    Route::get('appointment', function(){
        return view('advisor.advisor-appointment');
    })->name('appointment');
    
    Route::get('ticket', function(){
        return view('advisor.advisor-ticket');
    })->name('ticket');
    
    Route::get('student', function(){
        return view('advisor.advisor-student');
    })->name('student');
    });
});

Route::get('/supervisor/activity-log', [ActivityLogController::class, 'index'])->name('supervisor.activity-log');


