<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdvisorTicketController extends Controller
{
    public function adTicket(){
        return view('advisor.advisor-ticket');
    }
}
