<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdvisorAppointmentController extends Controller
{
    public function adAppointment(){
        return view('advisor.advisor-appointment');
    }
}
