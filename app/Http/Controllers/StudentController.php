<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\TicketTypeDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class StudentController extends Controller
{
    public function ahmad(){
        return view('students.ahmad');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function appointment()
    {
        return view('appointment');
    }

    public function ticket()
    {
        return view('ticket');
    }
    
    /**
     * Store a new student in the database
     */
    public function store(Request $request)
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
        
        return redirect()->route('supervisor.index')
            ->with('success', trans('site.supervisor.users.added_successfully'));
    }

    /**
     * Edit an existing student
     */
    public function edit($id, Request $request)
    {
        $student = Student::findOrFail($id);
        
        // Only take fields that are provided and remove null values
        $data = array_filter($request->only(['Fname', 'LName', 'email', 'phoneNumber', 'status']), function ($value) {
            return $value !== null;
        });

        // Only update if there is any data provided
        if (!empty($data)) {
            $student->update($data);
        }

        return redirect()->route('supervisor.index')
            ->with('success', trans('site.supervisor.users.updated_successfully'));
    }
    
    /**
     * Delete a student
     */
    public function delete($id)
    {
        Student::destroy($id);
        
        return redirect()->route('supervisor.index')
            ->with('success', trans('site.supervisor.users.deleted_successfully'));
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
