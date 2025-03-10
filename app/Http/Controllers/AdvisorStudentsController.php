<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdvisorStudentsController extends Controller
{
    public function adStudents(){
        return view('advisor.advisor-student');
    }
}
