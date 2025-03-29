<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketType;

class StudentTicketController extends Controller
{
    public function stTicket(){
        return view('ticket');
    }

    // public function ticketTypess(){
    //     $types = TicketType::pluck('ticket_type')->toArray();
    //         return view('test', compact('types'));
        
    // }

    public function getAllTicketTypes()
    {
        $ticketTypes = TicketType::select('id', 'ticket_type')->get();
        return response()->json($ticketTypes);
    }

    
}
