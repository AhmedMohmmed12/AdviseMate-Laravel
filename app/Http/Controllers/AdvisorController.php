<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketTypeDetails;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class AdvisorController extends Controller
{
    public function dashboard()
    {
        // Get the authenticated advisor's ID
        $advisorId = Auth::id();
        
        // Count total students assigned to this advisor
        $totalStudents = Student::where('user_id', $advisorId)->count();
        
        // Count pending tickets for this advisor
        $pendingTickets = TicketTypeDetails::where('user_id', $advisorId)
            ->where('ticket_status', 'pending')
            ->count();
            
        return view('advisor.advisor-dashboard', compact('totalStudents', 'pendingTickets'));
    }

    public function appointment()
    {
        return view('advisor.advisor-appointment');
    }

    public function ticket()
    {
        return view('advisor.advisor-ticket');
    }

    public function student()
    {
        return view('advisor.advisor-student');
    }
} 