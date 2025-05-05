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
                ->where('is_archived', false)
                ->with(['student'])
                ->orderBy('app_date', 'asc')
                ->get();
                
            // Get upcoming approved appointments
            $upcomingAppointments = Appoinment::where('user_id', $advisor->id)
                ->where('status', 'accepted')
                ->where('app_date', '>=', Carbon::now())
                ->where('is_archived', false)
                ->with(['student'])
                ->orderBy('app_date', 'asc')
                ->get();
                
            // Get archived appointments
            $archivedAppointments = Appoinment::where('user_id', $advisor->id)
                ->where('is_archived', true)
                ->with(['student'])
                ->orderBy('app_date', 'desc')
                ->get();
                
            \Log::info('Advisor ID: ' . $advisor->id);
            \Log::info('Pending appointments: ' . $pendingAppointments->count());
            \Log::info('Upcoming appointments: ' . $upcomingAppointments->count());
            \Log::info('Archived appointments: ' . $archivedAppointments->count());
            
            return view('advisor.advisor-appointment', compact('pendingAppointments', 'upcomingAppointments', 'archivedAppointments'));
        } catch (\Exception $e) {
            \Log::error('Error in advisor appointment page: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading appointments: ' . $e->getMessage());
        }
    }

    /**
     * Get appointments for calendar display
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAppointments()
    {
        try {
            // Get all non-rejected appointments for this advisor
            $appointments = Appoinment::where('user_id', Auth::id())
                ->where('status', '!=', 'rejected')
                ->where('app_date', '>=', Carbon::now()->subDays(30)) // Include recent + future appointments
                ->with('student')
                ->get();
                
            $formattedEvents = $appointments->map(function($appointment) {
                // Calculate end time (assuming 1 hour appointments)
                $startTime = Carbon::parse($appointment->app_date);
                $endTime = (clone $startTime)->addHour();
                
                // Set colors based on status
                $color = '#2196F3'; // Default blue
                if ($appointment->status === 'pending') {
                    $color = '#FFC107'; // Yellow for pending
                } else if ($appointment->status === 'accepted') {
                    $color = '#2196F3'; // Blue for accepted
                }
                
                $studentFullName = 'Unknown';
                if ($appointment->student) {
                    $studentFullName = ucfirst($appointment->student->Fname) . ' ' . ucfirst($appointment->student->LName);
                }
                
                return [
                    'id' => 'appt_' . $appointment->id, // Prefix to distinguish from availability IDs
                    'title' => $studentFullName,
                    'start' => $startTime->timezone(config('app.timezone'))->format('Y-m-d\TH:i:s'),
                    'end' => $endTime->timezone(config('app.timezone'))->format('Y-m-d\TH:i:s'),
                    'backgroundColor' => $color,
                    'borderColor' => $color,
                    'textColor' => '#ffffff',
                    'extendedProps' => [
                        'status' => $appointment->status,
                        'studentName' => $studentFullName,
                        'appointmentId' => $appointment->id
                    ]
                ];
            });
            
            return response()->json($formattedEvents);
        } catch (\Exception $e) {
            \Log::error('Error fetching appointments for calendar: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to fetch appointments: ' . $e->getMessage()
            ], 500);
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
