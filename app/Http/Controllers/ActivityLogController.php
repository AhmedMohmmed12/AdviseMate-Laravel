<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function activityLog()
    {
        $activities = Activity::latest()->paginate(20);
        return view('supervisor.activitylog', compact('activities'));
    }
} 