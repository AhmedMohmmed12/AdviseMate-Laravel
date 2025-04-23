<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appoinment;
use App\Models\Availability;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentStatusChanged;
use App\Models\Student;
use Spatie\Activitylog\Models\Activity;

class AdvisorAppointmentController extends Controller
{
    public function adAppointment()
    {
        $advisor = Auth::user();
        
        try {
            // Get pending appointments for this advisor
            $pendingAppointments = Appoinment::where('user_id', $advisor->id)
                ->where('status', 'pending')
                ->with(['student'])
                ->orderBy('app_date', 'asc')
                ->get();
                
            // Get upcoming approved appointments
            $upcomingAppointments = Appoinment::where('user_id', $advisor->id)
                ->where('status', 'accepted')
                ->where('app_date', '>=', Carbon::now())
                ->with(['student'])
                ->orderBy('app_date', 'asc')
                ->get();
                
            // Debug information - you can remove after fixing
            \Log::info('Advisor ID: ' . $advisor->id);
            \Log::info('Pending appointments: ' . $pendingAppointments->count());
            \Log::info('Upcoming appointments: ' . $upcomingAppointments->count());
            
            return view('advisor.advisor-appointment', compact('pendingAppointments', 'upcomingAppointments'));
        } catch (\Exception $e) {
            \Log::error('Error loading advisor appointments: ' . $e->getMessage());
            return view('advisor.advisor-appointment')->with('error', 'Unable to load appointments. Please try again later.');
        }
    }
    
    public function getAppointments()
    {
        $advisor = Auth::user();
        
        try {
            $appointments = Appoinment::where('user_id', $advisor->id)
                ->whereIn('status', ['pending', 'accepted'])
                ->with('student')
                ->get();
                
            return response()->json(
                $appointments->map(function ($appointment) {
                    return [
                        'id' => 'appt_' . $appointment->id,
                        'title' => ($appointment->student ? $appointment->student->Fname . ' ' . $appointment->student->LName : 'Unknown Student'),
                        'start' => Carbon::parse($appointment->app_date)->format('Y-m-d\TH:i:s'),
                        'end' => Carbon::parse($appointment->app_date)->addHour()->format('Y-m-d\TH:i:s'),
                        'color' => $appointment->status === 'pending' ? '#FFC107' : '#2196F3',
                        'extendedProps' => [
                            'appointmentId' => $appointment->id,
                            'studentName' => ($appointment->student ? $appointment->student->Fname . ' ' . $appointment->student->LName : 'Unknown Student'),
                            'status' => $appointment->status
                        ]
                    ];
                })
            );
        } catch (\Exception $e) {
            \Log::error('Error fetching appointments for calendar: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to load appointments'], 500);
        }
    }
    
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:accepted,rejected'
        ]);
        
        $appointment = Appoinment::findOrFail($id);
        
        // Check if appointment belongs to this advisor
        if ($appointment->user_id != Auth::id()) {
            return response()->json([
                'error' => 'You are not authorized to update this appointment'
            ], 403);
        }
        
        try {
            \DB::beginTransaction();
            
            $oldStatus = $appointment->status;
            // Update appointment status
            $appointment->update([
                'status' => $request->status
            ]);
            
            // Log the appointment status update activity
            activity()
                ->causedBy(Auth::user())
                ->performedOn($appointment)
                ->withProperties([
                    'appointment_id' => $appointment->id,
                    'advisor_name' => Auth::user()->fName,
                    'student_id' => $appointment->student_id,
                    'old_status' => $oldStatus,
                    'new_status' => $request->status
                ])
                ->log('Appointment Status Updated');
            
            // If rejected, make the availability slot available again
            if ($request->status === 'rejected') {
                $availability = Availability::where('user_id', $appointment->user_id)
                    ->where('start_time', $appointment->app_date)
                    ->first();
                    
                if ($availability) {
                    $availability->update(['is_booked' => false]);
                }
            }
            
            // Load relationships for email
            $appointment->load(['student', 'advisor']);
            
            // Send email to student asynchronously
            $student = Student::find($appointment->student_id);
            if ($student) {
                Mail::to($student->email)->queue(new AppointmentStatusChanged($appointment));
            }
            
            // Send email to advisor asynchronously
            Mail::to(Auth::user()->email)->queue(new AppointmentStatusChanged($appointment));
            
            \DB::commit();
            
            return response()->json([
                'message' => 'Appointment status updated successfully',
                'data' => $appointment
            ]);
            
        } catch (\Exception $e) {
            \DB::rollBack();
            
            return response()->json([
                'error' => 'Failed to update appointment status',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
