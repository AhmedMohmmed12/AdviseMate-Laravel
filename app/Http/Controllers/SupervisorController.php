<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use App\Models\Student;


class SupervisorController extends Controller
{
    

public function profileEdit( Request $request, $id)
{
    $user = User::findOrFail($id); // Fetch the user

    // Check if this is a POST/PUT request for updating
    if ($request->isMethod('put')) {

        if (Auth::id() !== $user->id) {
            abort(403, 'Unauthorized action.');
        }
        $data = array_filter($request->only(['fName', 'lName', 'email', 'mobileNumber']), function ($value) {
            return $value !== null;
        });

        if (!empty($data)) {
            $user->update($data);
        }

        return redirect()->route('supervisor.profile')->with('success', trans('site.supervisor.users.updated_successfully'));
    }
}

public function changePassword(Request $request)
{
    
    $request->validate([
        'new_password' => [
            'required', 
            'confirmed',
        ],
    ]);

    Auth::user()->update([
        'password' => Hash::make($request->new_password)
    ]);

    return back()->with('success', trans('site.supervisor.profile.password_updated'));
}

    public function profile()
    {
        return view('supervisor.profile');
    }
    public function permission(Request $request)
    {
        // Build the student query with advisor relation
        $query = Student::with('advisor');
        
        // Apply filters if provided
        if ($request->has('advisor_id') && $request->advisor_id) {
            $query->where('user_id', $request->advisor_id);
        }
        
        if ($request->has('program') && $request->program) {
            $query->where('program', $request->program);
        }
        
        if ($request->has('status') && $request->status) {
            if ($request->status === 'assigned') {
                $query->whereNotNull('user_id');
            } elseif ($request->status === 'unassigned') {
                $query->whereNull('user_id');
            }
        }
        
        // Get all students based on filters
        $students = $query->get();
        
        // Get unassigned students for the assignment dropdown
        $unassignedStudents = Student::whereNull('user_id')->get();
        
        // Get all active advisors
        $advisors = User::role('advisor')->where('status', 'active')->get();
        
        return view('supervisor.permission', compact('students', 'advisors', 'unassignedStudents'));
    }
    
    /**
     * Get students based on filters
     */
    public function getStudents(Request $request)
    {
        $query = Student::with('advisor');
        
        // Apply filters if provided
        if ($request->has('advisor_id') && $request->advisor_id) {
            $query->where('user_id', $request->advisor_id);
        }
        
        if ($request->has('program') && $request->program) {
            $query->where('program', $request->program);
        }
        
        if ($request->has('status') && $request->status) {
            if ($request->status === 'assigned') {
                $query->whereNotNull('user_id');
            } elseif ($request->status === 'unassigned') {
                $query->whereNull('user_id');
            }
        }
        
        $students = $query->get();
        
        return response()->json(['students' => $students]);
    }
    
    /**
     * Get all active advisors
     */
    public function getAdvisors()
    {
        $advisors = User::role('advisor')->where('status', 'active')->get();
        
        return response()->json(['advisors' => $advisors]);
    }
    
    /**
     * Assign a student to an advisor
     */
    public function assignStudent(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'advisor_id' => 'required|exists:users,id',
        ]);
        
        $student = Student::findOrFail($request->student_id);
        $advisor = User::findOrFail($request->advisor_id);
        
        // Make sure the advisor has the advisor role
        if (!$advisor->hasRole('advisor')) {
            return back()->with('error', 'Selected user is not an advisor.');
        }
        
        // Update the student's advisor
        $student->user_id = $advisor->id;
        $student->save();
        
        // Log the activity
        activity()
            ->causedBy(Auth::user())
            ->performedOn($student)
            ->withProperties([
                'student_id' => $student->id,
                'student_name' => $student->Fname . ' ' . $student->LName,
                'advisor_id' => $advisor->id,
                'advisor_name' => $advisor->fName . ' ' . $advisor->lName,
            ])
            ->log('Student assigned to advisor');
        
        return redirect()->route('supervisor.permission')
            ->with('success', $student->Fname . ' ' . $student->LName . ' has been assigned to ' . $advisor->fName . ' ' . $advisor->lName);
    }
    
    /**
     * Unassign a student from their advisor
     */
    public function unassignStudent(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
        ]);
        
        $student = Student::findOrFail($request->student_id);
        
        // Store the old advisor's information for the log
        $oldAdvisor = $student->advisor;
        
        // Remove the advisor association
        $student->user_id = null;
        $student->save();
        
        // Log the activity
        if ($oldAdvisor) {
            activity()
                ->causedBy(Auth::user())
                ->performedOn($student)
                ->withProperties([
                    'student_id' => $student->id,
                    'student_name' => $student->Fname . ' ' . $student->LName,
                    'advisor_id' => $oldAdvisor->id,
                    'advisor_name' => $oldAdvisor->fName . ' ' . $oldAdvisor->lName,
                ])
                ->log('Student unassigned from advisor');
        }
        
        return redirect()->route('supervisor.permission')
            ->with('success', $student->Fname . ' ' . $student->LName . ' has been unassigned from their advisor.');
    }
    
    public function activityLog()
    {
        $activities = Activity::latest()->paginate(20);
        return view('supervisor.activitylog', compact('activities'));
    }
    
    public function ticketActivity()
    {
        $ticketActivities = Activity::where(function($query) {
            $query->where('description', 'like', '%Ticket Created%')
                ->orWhere('description', 'like', '%Ticket Status Updated%');
        })->latest()->paginate(20);
        
        return view('supervisor.activitylog', compact('ticketActivities'));
    }
    
    public function appointmentActivity()
    {
        $appointmentActivities = Activity::where(function($query) {
            $query->where('description', 'like', '%Appointment Created%')
                ->orWhere('description', 'like', '%Appointment Status Updated%');
        })->latest()->paginate(20);
        
        return view('supervisor.activitylog', compact('appointmentActivities'));
    }
} 