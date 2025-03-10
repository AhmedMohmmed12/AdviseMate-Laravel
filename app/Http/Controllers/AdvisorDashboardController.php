<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdvisorDashboardController extends Controller
{
    public function adDashboard(){
        return view('advisor.advisor-dashboard');
    }
}
