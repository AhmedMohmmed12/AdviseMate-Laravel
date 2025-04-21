<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;
use App\Models\Appoinment;
use App\Models\TicketTypeDetails;
use App\Models\Availability;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    // Controller for API endpoints

    // Ensure no misplaced code or missing semicolon above this line
 
  public function getStudent(){
    $student=Student::select(['Fname','LName','email','phoneNumber','user_id',])->get();
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



public function getTicketDetails(){

  $ticketDetails = TicketTypeDetails::select(['ticket_description', 'ticket_status', 'ticket_type_id', 'student_id','created_at'])->with(['ticketType' => function ($q){
    return $q->select(['id','ticket_type']);
  }])->get();
  return response()->json([ 
      'status' => '200',
      'data' => $ticketDetails
  ]);

}


public function getAvailability(){
  $availability = Availability::select(['start_time', 'end_time','user_id','is_booked'])->get();
  return response()->json([ 
      'status' => '200',
      'data' => $availability
  ]);
}


public function editStudent($id , Request $request)
{
  $student = Student::findOrFail($id);

  $this->validate($request, [
    'Fname' => 'required|min:3',
    'LName' => 'required|min:3',
    'phoneNumber' => 'required|unique:students,phoneNumber|min:10|max:13'
  ]);

  $student->update($request->all()
);
  return response()->json([
    'status' => '200',
    'message' => 'Student updated successfully',
    'data' => $student
  ]);
}




public function login( Request $request){
  $request->validate([
    'email' => 'required|email',
    'password' => 'required'
  ]); // end validate

  $credentials = $request->only('email', 'password');

  if (!Auth::guard('student')->attempt($credentials)) {
    return response()->json([
      'status' => '401',
      'message' => 'Login failed'
    ]); 
  }
  
  $s = Student::select(['id','email','password'])->where ('email', $request->email)->first();
  $token = $s->createToken('student')->plainTextToken;
  return response()->json([
    'status' => '200',
    'message' => 'Login successfully',
    'token' => $token,
    'stdents_informations' => $s
  ]);

}



  public function logout(Request $request){
    $request->user()->currentAccessToken()->delete();
    return response()->json([
      'status' => '200',
      'message' => 'Logout successful'
    ]);
  }




  public function test(Request $request)
  {
      $this->validate($request, [
          'fName' => 'required|min:3',
          'email' => 'email|unique:students',
          'mobileNumber' => 'required|unique:students,phoneNumber|min:10|max:13',
          'password' => 'required|min:6|confirmed'
      ]);
      
      $student = Student::create([
          'Fname' => $request->fName,
          'LName' => $request->lName,
          'phoneNumber' => $request->mobileNumber,
          'gender' => $request->gender,
          'email' => $request->email,
          'password' => Hash::make($request->password),
          'status' => $request->status
      ]);

      
      
      // Assign the student role
      $student->assignRole('student');
      return response()->json([
          'status' => 200, 
          'data' => $student,
      ]);
  }
}
