<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentAppointmentController extends Controller
{
    public function stAppointment(){
        return view('appointment');
    }
}
