<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvisorStudentsController extends Controller
{
    public function adStudents(Request $request)
    {
        $advisor = Auth::user();
        
        // Get all unassigned active students
        $unassignedStudents = Student::where('status', 'active')
            ->whereNull('user_id')
            ->get();

        // Get all active advisors
        $activeAdvisors = User::role('advisor')
            ->where('status', 'active')
            ->get();

        // If there are unassigned students and active advisors, assign them randomly
        if ($unassignedStudents->count() > 0 && $activeAdvisors->count() > 0) {
            foreach ($unassignedStudents as $student) {
                // Get a random advisor
                $randomAdvisor = $activeAdvisors->random();
                
                // Assign the student to the advisor
                $student->update(['user_id' => $randomAdvisor->id]);
            }
        }

        // Start building the query for assigned students
        $query = Student::where('user_id', $advisor->id);

        // Apply search filter
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('Fname', 'like', "%{$search}%")
                  ->orWhere('LName', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Apply program filter
        if ($request->has('program') && !empty($request->program)) {
            $query->where('Program', $request->program);
        }

        // Apply status filter
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        // Get the filtered students
        $assignedStudents = $query->get();

        return view('advisor.advisor-student', compact('assignedStudents'));
    }
}
