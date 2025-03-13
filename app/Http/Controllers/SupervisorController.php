<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    
    public function profile()
    {
        return view('supervisor.profile');
    }
    public function permission()
    {
        return view('supervisor.permission');
    }
} 