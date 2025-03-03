<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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


}
