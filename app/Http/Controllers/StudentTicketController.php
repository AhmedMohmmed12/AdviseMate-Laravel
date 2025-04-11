<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketType;
use App\Models\Student;

class StudentTicketController extends Controller
{
    public function stTicket(){
        //  dd(public_path());
        return view('ticket');
    }

    // public function ticketTypess(){
    //     $types = TicketType::pluck('ticket_type')->toArray();
    //         return view('test', compact('types'));
        
    // }

    public function AddTiketTypeDeteails(Request $request)
    
    {
        $data = $request->except(['file']);
        if($request->hasFile('file')) {
            $file = $request->file('file');
            $studentID = auth()-user('student')->id;
            $filename = time() .  $studentID . rand(1 , 9999)  . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $data['file'] = $filename;
        }
    }


    public function getAllTicketTypes()
    {
        $ticketTypes = TicketType::select('id', 'ticket_type')->get();
        return response()->json($ticketTypes);
    }

    
}
