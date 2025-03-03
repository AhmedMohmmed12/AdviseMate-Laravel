<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function ahmad(){
        return view('students.ahmad');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function appointment()
    {
        return view('appointment');
    }

    public function ticket()
    {
        return view('ticket');
    }
}
