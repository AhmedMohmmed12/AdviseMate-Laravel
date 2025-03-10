<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function permission()
    {
        return view('supervisor.permission');
    }
} 