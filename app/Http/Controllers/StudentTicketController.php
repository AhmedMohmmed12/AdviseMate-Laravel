<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentTicketController extends Controller
{
    public function stTicket(){
        return view('ticket');
    }
}
