<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// RouteRoute::

Route::post('/login', [ApiController::class , 'login']);

Route::middleware('auth:sanctum')->group(function (){
    // ::name('api.')->group(function(){
        Route::get('/get-TicketDetails', [ApiController::class , 'getTicketDetails']);
    // });
    
    // 
    // Route::name('api.')->group(function(){
        Route::get('/get-student', [ApiController::class , 'getStudent']);
        
        Route::put('/student/{id}', [ApiController::class , 'editStudent']);
    // });
    // 
    // Route::name('api.')->group(function(){
        Route::get('/get-Appoinment', [ApiController::class , 'getAppoinment']);
    // });
    
    // Route::name('api.')->group(function(){
        Route::get('/get-Availability', [ApiController::class , 'getAvailability']);

        Route::post('/logout', [ApiController::class , 'logout']);
        Route::post('/test', [ApiController::class , 'test']);

    // });
    });

