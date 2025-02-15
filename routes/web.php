<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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
    return view('welcome');
});
Route::get("/test/ahmad" , [StudentController::class , "ahmad"]);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('student/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('student/appointment', function () {
    return view('appointment');
})->name('appointment');

Route::get('student/ticket', function () {
    return view('ticket');
})->name('ticket');


Route::get('advisor/dashboard', function(){
    return view('advisor.advisor-dashboard');
})->name('advisor.dashboard');

Route::get('advisor/appointment', function(){
    return view('advisor.advisor-appointment');
})->name('advisor.appointment');

Route::get('advisor/ticket', function(){
    return view('advisor.advisor-ticket');
})->name('advisor.ticket');

Route::get('advisor/student', function(){
    return view('advisor.advisor-student');
})->name('advisor.student');
});
