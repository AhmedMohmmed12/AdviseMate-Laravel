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
            "password" => Hash::make($request->password),
            "status" => $request->status
        ])->assignRole($request->role);
        return redirect()->route('supervisor.index')->with('success' , trans('site.supervisor.users.added_successfully'));
    }

    public function delete($id){
        User::destroy($id);
        return redirect()->route('supervisor.index')->with('success',trans('site.supervisor.users.deleted_successfully'));
    }
    
    public function edit($id, Request $request){
        $user = User::findOrFail($id);

    // Only take fields that are provided and remove null values
    $data = array_filter($request->only(['fName', 'lName', 'email', 'status']), function ($value) {
        return $value !== null;
    });

    // Only update if there is any data provided
    if (!empty($data)) {
        $user->update($data);
    }
        return redirect()->route('supervisor.index')->with('success', trans('site.supervisor.users.updated_successfully'));
    }
    
}
