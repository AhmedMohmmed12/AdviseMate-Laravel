<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketTypeDetails;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketStatusChanged;
use Spatie\Activitylog\Models\Activity;

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
        
        try {
            \DB::beginTransaction();
            
            $oldStatus = $ticket->ticket_status;
            $ticket->ticket_status = $request->ticket_status;
            $ticket->save();
            
            // Log the ticket status update activity
            activity()
                ->causedBy(Auth::user())
                ->performedOn($ticket)
                ->withProperties([
                    'ticket_id' => $ticket->id,
                    'old_status' => $oldStatus,
                    'new_status' => $request->ticket_status,
                    'ticket_type' => $ticket->ticketType->ticket_type ?? 'Unknown',
                    'student_id' => $ticket->student_id,
                    'advisor_name' => Auth::user()->fName
                ])
                ->log('Ticket Status Updated');
            
            // Load relationships for email
            $ticket->load(['ticketType', 'student']);
            
            // Send email to student
            $student = Student::find($ticket->student_id);
            if ($student) {
                Mail::to($student->email)->send(new TicketStatusChanged($ticket));
            }
            
            // Send email to advisor (confirmation)
            Mail::to(Auth::user()->email)->send(new TicketStatusChanged($ticket));
            
            \DB::commit();
            
            return response()->json(['success' => true, 'message' => 'Ticket status updated successfully.']);
            
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to update ticket status: ' . $e->getMessage()], 500);
        }
    }
}
