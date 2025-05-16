<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\TicketType;
use App\Models\Student;
use App\Models\Appoinment;
use App\Models\TicketTypeDetails;
use App\Models\Availability;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    // Controller for API endpoints

    // Ensure no misplaced code or missing semicolon above this line
 // student 
  public function getStudent(){
    $student=Student::select(['Fname','LName','email','phoneNumber','user_id','id'])->get();
    return response()->json([
      'status' => '200',
      'data'=> $student
    ]);
  }



  public function editStudent($id , Request $request)
  {
    $student = Student::findOrFail($id);
  
    $this->validate($request, [
      'Fname' => 'required|min:3',
      'LName' => 'required|min:3',
      "phoneNumber" => 'required|min:10|max:13|unique:students,phoneNumber,'.$id,
      'email' => 'required|email|unique:students,email,'.$id,
      'password'=>"sometimes|confirmed"
  
    ]);
  
  $data = $request->except($request->password);
  if($request->password){
    $data['password'] = Hash::make($request->password);
  }
    $student->update($data);
    return response()->json([
      'status' => '200',
      'message' => 'Student updated successfully',
      'data' => $student
    ]);
  }
// end student

  
// Appoinment
  public function getAppoinment(){
    $appointment = Appoinment::select(['student_id', 'user_id', 'app_date', 'status'])->get();
    return response()->json([ 
        'status' => '200',
        'data' => $appointment
    ]);
}


public function getAvailability(){
  $availability = Availability::select(['start_time', 'end_time','user_id','is_booked'])->get();
  return response()->json([ 
      'status' => '200',
      'data' => $availability
  ]);
}


public function postappointment(Request $request)
{
  $this->validate($request, [
    'student_id' => 'required',
    'user_id' => 'required',
    'app_date' => 'required|date',
    'status' => 'required'
  ]);

  $appointment = Appoinment::create([
    'student_id' => $request->student_id,
    'user_id' => $request->user_id,
    'app_date' => $request->app_date,
    'status' => $request->status
  ]);

  return response()->json([
    'status' => 200,
    'data' => $appointment
  ]);

}

// end Appoinment

//TicketDetails
public function getTicketDetails(){

  $ticketDetails = TicketTypeDetails::select(['ticket_description', 'ticket_status', 'ticket_type_id', 'student_id','file','created_at'])->with(['ticketType' => function ($q){
    return $q->select(['id','ticket_type']);
  }])->get();
  return response()->json([ 
      'status' => '200',
      'data' => $ticketDetails
  ]);

}




public function createTicketDetails(Request $request)
{
    // Get the highest ticket type ID to determine the last 3 types
    $highestTypeId = TicketType::max('id');
    
    // Basic validation rules
    $validationRules = [
        'ticket_description' => 'required|string',
        'ticket_status' => 'required|string',
        'ticket_type' => 'required|string',
        'student_id' => 'required|exists:students,id',
        'user_id' => 'required|exists:users,id',
    ];
    
    // Get or create the ticket type
    $ticketType = TicketType::firstOrCreate([
        'ticket_type' => $request->ticket_type
    ]);
    
    // Make file required for the last 3 ticket types
    if ($ticketType->id > ($highestTypeId - 3)) {
        $validationRules['file'] = 'required|file|mimes:jpg,jpeg,png,pdf|max:2048';
    } else {
        $validationRules['file'] = 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048';
    }
    
    $validator = Validator::make($request->all(), $validationRules);

    if ($validator->fails()) {
        return response()->json([
            'status' => 422,
            'errors' => $validator->errors()
        ], 422);
    }

    $data = $request->except(['file']);

    // Handle file upload if present
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $studentID = $request->student_id;
        $filename = time() . '_' . $studentID . '_' . rand(1, 9999) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);
        $data['file'] = $filename;
    }

    // Create the ticket
    $ticket = TicketTypeDetails::create([
        'ticket_description' => $request->ticket_description,
        'ticket_status' => $request->ticket_status,
        'ticket_type_id' => $ticketType->id,
        'student_id' => $request->student_id,
        'user_id' => $request->user_id,
        'file' => $data['file'] ?? null,
    ]);

    return response()->json([
        'status' => 201,
        'message' => 'Ticket created successfully',
        'data' => [
            'id' => $ticket->id,
            'ticket_description' => $ticket->ticket_description,
            'ticket_status' => $ticket->ticket_status,
            'ticket_type_id' => $ticket->ticket_type_id,
            'student_id' => $ticket->student_id,
            'user_id' => $ticket->user_id,
            'file' => $ticket->file,
            'created_at' => $ticket->created_at->toDateTimeString(),
        ]
    ], 201);
}

// end TicketDetails




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
          'LName' => $request->LName,
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
