<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketTypeDetails;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class AdvisorTicketController extends Controller
{
    public function adTicket(){
        // Get tickets assigned to the logged-in advisor
        $advisorId = Auth::id();
        
        // Make sure we're getting the tickets with eager loading
        $tickets = TicketTypeDetails::with(['ticketType', 'student'])
            ->where('user_id', $advisorId)
            ->orderBy('created_at', 'desc')
            ->get();
            
        // Debug to make sure we have tickets and are passing them correctly
        // dd($tickets);
            
        return view('advisor.advisor-ticket', compact('tickets'));
    }
    
    public function updateTicketStatus(Request $request, $id)
    {
        $request->validate([
            'ticket_status' => 'required|in:pending,completed,rejected',
        ]);
        
        $ticket = TicketTypeDetails::findOrFail($id);
        
        // Check if ticket belongs to the advisor
        if ($ticket->user_id != Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized action.'], 403);
        }
        
        $ticket->ticket_status = $request->ticket_status;
        $ticket->save();
        
        return response()->json(['success' => true, 'message' => 'Ticket status updated successfully.']);
    }
}
