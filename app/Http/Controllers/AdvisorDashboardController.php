<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\TicketTypeDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvisorDashboardController extends Controller
{
    public function adDashboard(){
        $advisor = Auth::user();
        $totalStudents = Student::where('user_id', $advisor->id)->count();
        
        // Count pending tickets for this advisor
        $pendingTickets = TicketTypeDetails::where('user_id', $advisor->id)
            ->where('ticket_status', 'pending')
            ->count();
        
        return view('advisor.advisor-dashboard', compact('totalStudents', 'pendingTickets'));
    }
}
