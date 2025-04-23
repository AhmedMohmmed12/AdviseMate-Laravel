<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketType;
use App\Models\Student;
use App\Models\TicketTypeDetails;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketCreated;
use Spatie\Activitylog\Models\Activity;

class StudentTicketController extends Controller
{
    public function stTicket(){
        // Get the authenticated student
        $student = Auth::guard('student')->user();
        
        // Get all tickets for this student with their types
        $studentTickets = TicketTypeDetails::with('ticketType')
            ->where('student_id', $student->id)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('ticket', compact('studentTickets'));
    }

    // public function ticketTypess(){
    //     $types = TicketType::pluck('ticket_type')->toArray();
    //         return view('test', compact('types'));
        
    // }

    public function AddTiketTypeDeteails(Request $request)
    
    {
        $data = $request->except(['file']);
        if($request->hasFile('file')) {
            $file = $request->file('file');
            $studentID = auth()->user('student')->id;
            $filename = time() .  $studentID . rand(1 , 9999)  . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $data['file'] = $filename;
        }
    }


    public function getAllTicketTypes()
    {
        $ticketTypes = TicketType::select('id', 'ticket_type')->get();
        return response()->json($ticketTypes);
    }
    
     function createTicket(Request $request)
    {
        $request->validate([
            'ticket_type_id' => 'required|exists:ticket_type,id',
            'ticket_description' => 'required|string',
            'file' => 'nullable|file|mimes:pdf|max:2048',
        ]);
        
        $data = $request->except(['file']);
        
        // Get the authenticated student
        $student = Auth::guard('student')->user();
        
        if (!$student) {
            return response()->json(['success' => false, 'message' => 'Student not authenticated.'], 401);
        }
        
        // Get advisor ID from student's user_id field
        $advisorId = $student->user_id;
        
        if (!$advisorId) {
            return response()->json(['success' => false, 'message' => 'No advisor linked to this student.'], 400);
        }
        
        if($request->hasFile('file')) {
            $file = $request->file('file');
            $studentID = $student->id;
            $filename = time() . '_' . $studentID . '_' . rand(1, 9999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $data['file'] = $filename;
        }
        
        try {
            \DB::beginTransaction();
            
            // Create the ticket and link it to the student and advisor
            $ticket = new TicketTypeDetails([
                'ticket_type_id' => $request->ticket_type_id,
                'student_id' => $student->id,
                'user_id' => $advisorId,
                'ticket_status' => 'pending',
                'ticket_description' => $request->ticket_description,
                'file' => $data['file'] ?? null,
            ]);
            
            $ticket->save();
            
            // Log the ticket creation activity
            activity()
                ->causedBy($student)
                ->performedOn($ticket)
                ->withProperties([
                    'ticket_id' => $ticket->id,
                    'ticket_type' => $ticket->ticketType->ticket_type ?? 'Unknown',
                    'student_name' => ucfirst($student->Fname) . ' ' . ucfirst($student->LName),
                    'advisor_id' => $advisorId,
                    'advisor_name' => $advisor->fName
                ])
                ->log('Ticket Created');
            
            // Load relationships for email
            $ticket->load(['ticketType', 'student']);
            
            // Send email to student asynchronously
            Mail::to($student->email)->queue(new TicketCreated($ticket));
            
            // Send email to advisor asynchronously
            $advisor = User::find($advisorId);
            if ($advisor) {
                Mail::to($advisor->email)->queue(new TicketCreated($ticket));
            }
            
            \DB::commit();
            
            return response()->json(['success' => true, 'message' => 'Ticket created successfully.']);
            
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to create ticket: ' . $e->getMessage()], 500);
        }
    }
}
