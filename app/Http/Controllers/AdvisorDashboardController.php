<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvisorDashboardController extends Controller
{
    public function adDashboard(){
        $advisor = Auth::user();
        $totalStudents = Student::where('user_id', $advisor->id)->count();
        
        return view('advisor.advisor-dashboard', compact('totalStudents'));
    }
}
