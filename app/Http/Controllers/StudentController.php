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
        
        // Check if the student role for student guard exists, if not create it
        if (class_exists(Role::class)) {
            $studentRole = Role::where('name', 'student')->where('guard_name', 'student')->first();
            
            if (!$studentRole) {
                // Create the role with the proper guard name
                $studentRole = Role::create([
                    'name' => 'student',
                    'guard_name' => 'student'
                ]);
            }
            // Assign the role to the student
            $student->assignRole($studentRole);
        }
        
        return redirect()->route('supervisor.index')
            ->with('success', trans('site.supervisor.users.added_successfully'));
    }
}
