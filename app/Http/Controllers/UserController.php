<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function create(){
        return view('advisor.create-advisor');
    }

    public function store(Request $request)
    {
        $this->validate($request , [
            'fName' => 'required|min:3',
            'email' => 'email|unique:users,email    ',
            'password' => 'confirmed'
        ]);
        User::create([
            'fName' => $request->fName , 
            'lName' => $request->lName , 
            'email' => $request->email ,
            "password" => sha1($request->password) 
        ]);

        // return back();
        return view('advisor.advisor-dashboard');
    }
}
