<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create(){
        return view('supervisor.users');
    }

    public function index(){
        $users = User::where('id' , '!=' , auth()->id())->where('id','!=',1)->get();

        return view('supervisor.users' , compact('users'));
    }


    public function store(Request $request)
    {
        $this->validate($request , [
            'fName' => 'required|min:3',
            'email' => 'email|unique:users',
            'password' => 'required'
        ]);

        User::create([
            'fName' => $request->fName , 
            'lName' => $request->lName , 
            'email' => $request->email ,
            'gender' => $request->gender ,
            "password" => Hash::make($request->password)
        ])->assignRole($request->role);

        session()->flash('success' , trans('site.supervisor.users.added_successfully'));
        return view('supervisor.users');
    }
}
