<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Availability;
use App\Models\User;
use App\Models\Appoinment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class AdvisorAvailabilityController extends Controller
{
    public function index()
    {
        return view('advisor.advisor-appointment');
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        try {
            $startTime = Carbon::parse($request->start_time)->timezone(config('app.timezone'));
            $endTime = Carbon::parse($request->end_time)->timezone(config('app.timezone'));
            
            // Check for overlapping appointments
            $conflictingAppointments = Appoinment::where('user_id', Auth::id())
                ->where(function($query) use ($startTime, $endTime) {
                    $query->where(function($q) use ($startTime, $endTime) {
                        // Start time falls within existing appointment
                        $q->where('app_date', '<=', $startTime)
                          ->where(function($innerQ) use ($startTime) {
                              // Assuming each appointment is 1 hour long
                              $innerQ->where(\DB::raw('DATE_ADD(app_date, INTERVAL 1 HOUR)'), '>', $startTime);
                          });
                    })
                    ->orWhere(function($q) use ($startTime, $endTime) {
                        // End time falls within existing appointment
                        $q->where('app_date', '<', $endTime)
                          ->where('app_date', '>=', $startTime);
                    });
                })
                ->where('status', '!=', 'rejected')
                ->exists();
                
            if ($conflictingAppointments) {
                return response()->json([
                    'message' => 'Cannot create availability - you already have an appointment scheduled during this time'
                ], 422);
            }
            
            // Also check for overlapping availability slots
            $conflictingAvailabilities = Availability::where('user_id', Auth::id())
                ->where(function($query) use ($startTime, $endTime) {
                    $query->where(function($q) use ($startTime, $endTime) {
                        // Start time falls within existing slot
                        $q->where('start_time', '<=', $startTime)
                          ->where('end_time', '>', $startTime);
                    })
                    ->orWhere(function($q) use ($startTime, $endTime) {
                        // End time falls within existing slot
                        $q->where('start_time', '<', $endTime)
                          ->where('end_time', '>=', $endTime);
                    })
                    ->orWhere(function($q) use ($startTime, $endTime) {
                        // New slot completely contains existing slot
                        $q->where('start_time', '>=', $startTime)
                          ->where('end_time', '<=', $endTime);
                    });
                })
                ->exists();
                
            if ($conflictingAvailabilities) {
                return response()->json([
                    'message' => 'Cannot create availability - this time slot overlaps with an existing availability slot'
                ], 422);
            }

            $availability = Availability::create([
                'user_id' => Auth::id(),
                'start_time' => $startTime,
                'end_time' => $endTime,
                'is_booked' => false
            ]);

            return response()->json([
                'message' => 'Availability slot created successfully',
                'data' => $availability
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create availability slot: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, Availability $availability)
    {
        if (auth()->user()->id !== $availability->user_id) {
            return response()->json(['message' => 'You are not authorized to modify this availability'], 403);
        }

        $request->validate([
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        try {
            $startTime = Carbon::parse($request->start_time)->timezone(config('app.timezone'));
            $endTime = Carbon::parse($request->end_time)->timezone(config('app.timezone'));
            
            // Skip conflict check if the slot is already booked and being repositioned
            if (!$availability->is_booked) {
                // Check for overlapping appointments
                $conflictingAppointments = Appoinment::where('user_id', Auth::id())
                    ->where(function($query) use ($startTime, $endTime) {
                        $query->where(function($q) use ($startTime, $endTime) {
                            // Start time falls within existing appointment
                            $q->where('app_date', '<=', $startTime)
                              ->where(function($innerQ) use ($startTime) {
                                  // Assuming each appointment is 1 hour long
                                  $innerQ->where(\DB::raw('DATE_ADD(app_date, INTERVAL 1 HOUR)'), '>', $startTime);
                              });
                        })
                        ->orWhere(function($q) use ($startTime, $endTime) {
                            // End time falls within existing appointment
                            $q->where('app_date', '<', $endTime)
                              ->where('app_date', '>=', $startTime);
                        });
                    })
                    ->where('status', '!=', 'rejected')
                    ->exists();
                    
                if ($conflictingAppointments) {
                    return response()->json([
                        'message' => 'Cannot update availability - you already have an appointment scheduled during this time'
                    ], 422);
                }
                
                // Also check for overlapping availability slots (excluding this one)
                $conflictingAvailabilities = Availability::where('user_id', Auth::id())
                    ->where('id', '!=', $availability->id)
                    ->where(function($query) use ($startTime, $endTime) {
                        $query->where(function($q) use ($startTime, $endTime) {
                            // Start time falls within existing slot
                            $q->where('start_time', '<=', $startTime)
                              ->where('end_time', '>', $startTime);
                        })
                        ->orWhere(function($q) use ($startTime, $endTime) {
                            // End time falls within existing slot
                            $q->where('start_time', '<', $endTime)
                              ->where('end_time', '>=', $endTime);
                        })
                        ->orWhere(function($q) use ($startTime, $endTime) {
                            // New slot completely contains existing slot
                            $q->where('start_time', '>=', $startTime)
                              ->where('end_time', '<=', $endTime);
                        });
                    })
                    ->exists();
                    
                if ($conflictingAvailabilities) {
                    return response()->json([
                        'message' => 'Cannot update availability - this time slot overlaps with an existing availability slot'
                    ], 422);
                }
            }

            $availability->update([
                'start_time' => $startTime,
                'end_time' => $endTime
            ]);
            
            return response()->json([
                'message' => 'Availability slot updated successfully',
                'data' => $availability
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update availability slot: ' . $e->getMessage()
            ], 500);
        }
    }

    public function delete(Availability $availability)
    {
        if (auth()->user()->id !== $availability->user_id) {
            return response()->json(['message' => 'You are not authorized to delete this availability'], 403);
        }

        try {
            $availability->delete();
            return response()->json([
                'message' => 'Availability slot deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete availability slot'
            ], 500);
        }
    }

    public function fetch()
    {
        try {
            $availabilities = Availability::where('user_id', auth()->id())
                ->where('is_booked', false)
                ->orderBy('start_time', 'asc')
                ->get();

            return response()->json(
                $availabilities->map(function ($slot) {
                    return [
                        'id' => $slot->id,
                        'title' => 'Available',
                        'start' => $slot->start_time->timezone(config('app.timezone'))->format('Y-m-d\TH:i:s'),
                        'end' => $slot->end_time->timezone(config('app.timezone'))->format('Y-m-d\TH:i:s'),
                        'allDay' => false,
                        'backgroundColor' => '#4CAF50',
                        'borderColor' => '#4CAF50'
                    ];
                })
            );
        } catch (\Exception $e) {
            \Log::error('Failed to fetch availability slots: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to fetch slots',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
