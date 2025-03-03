<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdvisorController extends Controller
{
    public function dashboard()
    {
        return view('advisor.advisor-dashboard');
    }

    public function appointment()
    {
        return view('advisor.advisor-appointment');
    }

    public function ticket()
    {
        return view('advisor.advisor-ticket');
    }

    public function student()
    {
        return view('advisor.advisor-student');
    }
} 