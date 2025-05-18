<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AssignUnassignedStudents extends Command
{
    protected $signature = 'students:assign-unassigned';
    protected $description = 'Assign unassigned students to random active advisors';

    public function handle()
    {
        // Get all unassigned active students
        $unassignedStudents = Student::where('status', 'active')
            ->whereNull('user_id')
            ->get();

        // Get all active advisors
        $activeAdvisors = User::role('advisor')
            ->where('status', 'active')
            ->get();

        if ($unassignedStudents->isEmpty()) {
            $this->info('No unassigned students found.');
            return;
        }

        if ($activeAdvisors->isEmpty()) {
            $this->error('No active advisors found.');
            return;
        }

        $assignedCount = 0;
        foreach ($unassignedStudents as $student) {
            // Get a random advisor
            $randomAdvisor = $activeAdvisors->random();
            
            // Assign the student to the advisor
            $student->update(['user_id' => $randomAdvisor->id]);
            
            // Log the assignment
            Log::info('Student assigned to advisor', [
                'student_id' => $student->id,
                'student_name' => $student->Fname . ' ' . $student->LName,
                'advisor_id' => $randomAdvisor->id,
                'advisor_name' => $randomAdvisor->fName . ' ' . $randomAdvisor->lName
            ]);
            
            $assignedCount++;
        }

        $this->info("Successfully assigned {$assignedCount} students to advisors.");
    }
} 