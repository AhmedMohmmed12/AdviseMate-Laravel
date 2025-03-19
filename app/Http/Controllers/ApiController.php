<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Appoinment;
class ApiController extends Controller
{
    //

  public function getUsers(){
    $users = User::select(['id' ,'fName','lName','gender', 'email'])->get(); 
    return response()->json([
        'status' =>'200',
        'data' => $users
    ]);
  }


  public function getStudent(){
    $student=Student::select(['Fname','LName','email'])->get();
    return response()->json([
      'status' => '200',
      'data'=> $student
    ]);
  }

  public function getAppoinment(){
    $appointment = Appoinment::select(['student_id', 'user_id', 'app_date', 'status'])->get();
    return response()->json([ 
        'status' => '200',
        'data' => $appointment
    ]);
}

}

