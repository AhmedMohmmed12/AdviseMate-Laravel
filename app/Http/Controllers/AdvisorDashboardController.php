<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\TicketTypeDetails;
use App\Models\Appoinment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdvisorDashboardController extends Controller
{
    public function adDashboard(){
        $advisor = Auth::user();
        $totalStudents = Student::where('user_id', $advisor->id)->count();
        
        // Count pending tickets for this advisor
        $pendingTickets = TicketTypeDetails::where('user_id', $advisor->id)
            ->where('ticket_status', 'pending')
            ->count();
        
        // Count upcoming appointments for this advisor
        $upcomingAppointments = Appoinment::where('user_id', $advisor->id)
            ->where('status', 'accepted')
            ->where('app_date', '>=', Carbon::now())
            ->count();
            
        // Get recent tickets
        $recentTickets = TicketTypeDetails::with(['ticketType', 'student'])
            ->where('user_id', $advisor->id)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
            
        // Get today's appointments
        $todaysAppointments = Appoinment::with('student')
            ->where('user_id', $advisor->id)
            ->where('status', 'accepted')
            ->whereDate('app_date', Carbon::today())
            ->orderBy('app_date', 'asc')
            ->take(2)
            ->get();
        
        return view('advisor.advisor-dashboard', compact(
            'totalStudents', 
            'pendingTickets', 
            'upcomingAppointments', 
            'recentTickets', 
            'todaysAppointments'
        ));
    }
}
