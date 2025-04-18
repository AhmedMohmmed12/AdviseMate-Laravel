<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;
use App\Models\Appoinment;
use App\Models\TicketTypeDetails;
use App\Models\Availability;

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
  $ticketDetails = TicketTypeDetails::select(['ticket_description', 'ticket_status', 'ticket_type_id', 'student_id'])->get();
  return response()->json([ 
      'status' => '200',
      'data' => $ticketDetails
  ]);
}



public function getAvailability(){
  $availability = Availability::select(['start_time', 'end_time','user_id'])->get();
  return response()->json([ 
      'status' => '200',
      'data' => $availability
  ]);
}

}

