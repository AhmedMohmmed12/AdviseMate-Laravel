<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appoinment;
use App\Models\TicketTypeDetails;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StudentDashboardController extends Controller
{
    public function stDashboard(){
        // Get authenticated student
        $student = Auth::guard('student')->user();
        
        // Count upcoming appointments
        $upcomingAppointments = Appoinment::where('student_id', $student->id)
            ->where('status', 'accepted')
            ->where('app_date', '>=', Carbon::now())
            ->count();
        
        // Count active tickets
        $activeTickets = TicketTypeDetails::where('student_id', $student->id)
            ->where('ticket_status', 'pending')
            ->count();
        
        // Get advisor information
        $advisor = null;
        if ($student->user_id) {
            $advisor = User::find($student->user_id);
        }
        
        // Get recent appointments
        $recentAppointments = Appoinment::where('student_id', $student->id)
            ->orderBy('app_date', 'asc')
            ->where('app_date', '>=', Carbon::now())
            ->take(2)
            ->get();
        
        // Get recent tickets
        $recentTickets = TicketTypeDetails::with('ticketType')
            ->where('student_id', $student->id)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
        
        return view('dashboard', compact(
            'upcomingAppointments',
            'activeTickets',
            'advisor',
            'recentAppointments',
            'recentTickets'
        ));
    }
}
