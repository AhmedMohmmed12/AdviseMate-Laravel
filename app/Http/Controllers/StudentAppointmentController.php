<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Availability;
use App\Models\Appoinment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StudentAppointmentController extends Controller
{
    public function stAppointment()
    {
        // Get the student's current appointments
        $studentId = Auth::guard('student')->user()->id;
        $appointments = Appoinment::where('student_id', $studentId)
            ->with('advisor')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('appointment', compact('appointments'));
    }
    
    public function getAvailabilities()
    {
        try {
            // Check if the student is authenticated
            if (!Auth::guard('student')->check()) {
                return response()->json([
                    'error' => 'Not authenticated as a student'
                ], 401);
            }
            
            $student = Auth::guard('student')->user();
            $advisorId = $student->user_id;
            
            if (!$advisorId) {
                return response()->json([
                    'error' => 'You have not been assigned an advisor yet.'
                ], 404);
            }
            
            // Get advisor's available slots
            $availabilities = Availability::where('user_id', $advisorId)
                ->where('is_booked', false)
                ->where('start_time', '>', Carbon::now())
                ->get();
            
            // Format availabilities for FullCalendar
            $formattedAvailabilities = $availabilities->map(function ($slot) {
                return [
                    'id' => $slot->id,
                    'title' => 'Available',
                    'start' => $slot->start_time->timezone(config('app.timezone'))->format('Y-m-d\TH:i:s'),
                    'end' => $slot->end_time->timezone(config('app.timezone'))->format('Y-m-d\TH:i:s'),
                    'availabilityId' => $slot->id
                ];
            });
                
            return response()->json($formattedAvailabilities);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error fetching availabilities: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function bookAppointment(Request $request)
    {
        $request->validate([
            'availability_id' => 'required|exists:availabilities,id'
        ]);
        
        $student = Auth::guard('student')->user();
        $studentId = $student->id;
        
        $availability = Availability::findOrFail($request->availability_id);
        
        // Check if the availability belongs to the student's advisor
        if ($availability->user_id != $student->user_id) {
            return response()->json([
                'error' => 'This availability slot does not belong to your advisor.'
            ], 403);
        }
        
        // Check if already booked
        if ($availability->is_booked) {
            return response()->json([
                'error' => 'This slot has already been booked.'
            ], 400);
        }
        
        try {
            // Start a transaction
            \DB::beginTransaction();
            
            // Create a new appointment
            $appointment = Appoinment::create([
                'user_id' => $availability->user_id,
                'student_id' => $studentId,
                'app_date' => $availability->start_time,
                'status' => 'pending'
            ]);
            
            // Mark the availability as booked
            $availability->update(['is_booked' => true]);
            
            \DB::commit();
            
            return response()->json([
                'message' => 'Appointment booked successfully',
                'data' => $appointment
            ]);
            
        } catch (\Exception $e) {
            \DB::rollBack();
            
            return response()->json([
                'error' => 'Failed to book appointment',
                'details' => $e->getMessage()
            ], 500);
        }
    }
    
    public function cancelAppointment(Request $request, $appointmentId)
    {
        $student = Auth::guard('student')->user();
        $appointment = Appoinment::findOrFail($appointmentId);
        
        // Check if the appointment belongs to this student
        if ($appointment->student_id != $student->id) {
            return response()->json([
                'error' => 'You are not authorized to cancel this appointment'
            ], 403);
        }
        
        try {
            \DB::beginTransaction();
            
            // Find the associated availability slot
            $availability = Availability::where('user_id', $appointment->user_id)
                ->where('start_time', $appointment->app_date)
                ->first();
                
            if ($availability) {
                // Mark the availability as not booked
                $availability->update(['is_booked' => false]);
            }
            
            // Update appointment status to cancelled
            $appointment->update(['status' => 'cancelled']);
            
            \DB::commit();
            
            return response()->json([
                'message' => 'Appointment cancelled successfully'
            ]);
            
        } catch (\Exception $e) {
            \DB::rollBack();
            
            return response()->json([
                'error' => 'Failed to cancel appointment',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
