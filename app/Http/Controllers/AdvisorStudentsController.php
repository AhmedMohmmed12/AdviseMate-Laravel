<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvisorStudentsController extends Controller
{
    public function adStudents()
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

        // Get the advisor's assigned students
        $assignedStudents = Student::where('user_id', $advisor->id)->get();

        return view('advisor.advisor-student', compact('assignedStudents'));
    }
}
