<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Availability;
use App\Models\User;
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
            $availability = Availability::create([
                'user_id' => Auth::id(),
                'start_time' => Carbon::parse($request->start_time)->timezone(config('app.timezone')),
                'end_time' => Carbon::parse($request->end_time)->timezone(config('app.timezone')),
                'is_booked' => false
            ]);

            return response()->json([
                'message' => 'Availability slot created successfully',
                'data' => $availability
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create availability slot'
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
            $availability->update([
                'start_time' => Carbon::parse($request->start_time)->timezone(config('app.timezone')),
                'end_time' => Carbon::parse($request->end_time)->timezone(config('app.timezone'))
            ]);
            
            return response()->json([
                'message' => 'Availability slot updated successfully',
                'data' => $availability
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update availability slot'
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
                ->get();

            return response()->json(
                $availabilities->map(function ($slot) {
                    return [
                        'id' => $slot->id,
                        'title' => 'Available',
                        'start' => $slot->start_time->timezone(config('app.timezone'))->format('Y-m-d\TH:i:s'),
                        'end' => $slot->end_time->timezone(config('app.timezone'))->format('Y-m-d\TH:i:s'),
                        'allDay' => false
                    ];
                })
            );
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch slots',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
