<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function create(){
        return view('supervisor.users');
    }

    public function index(){
        $users = User::all();
        return view('supervisor.users' , compact('users'));
    }


    public function store(Request $request)
    {
        $this->validate($request , [
            'fName' => 'required|min:3',
            'email' => 'email|unique:users',
            'password' => 'confirmed'
        ]);
        User::create([
            'fName' => $request->fName , 
            'lName' => $request->lName , 
            'email' => $request->email ,
            'gender' => $request->gender ,
            "password" => sha1($request->password) 
        ]);

        
        session()->flash('success' , trans('site.added_successfully'));
        // return back();
        return view('supervisor.dashboard');
    }
}
