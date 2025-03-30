<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class SupervisorController extends Controller
{
    

public function profileEdit( Request $request, $id)
{
    $user = User::findOrFail($id); // Fetch the user

    // Check if this is a POST/PUT request for updating
    if ($request->isMethod('put')) {

        if (Auth::id() !== $user->id) {
            abort(403, 'Unauthorized action.');
        }
        $data = array_filter($request->only(['fName', 'lName', 'email', 'mobileNumber']), function ($value) {
            return $value !== null;
        });

        if (!empty($data)) {
            $user->update($data);
        }

        return redirect()->route('supervisor.profile')->with('success', trans('site.supervisor.users.updated_successfully'));
    }
}

public function changePassword(Request $request)
{
    
    $request->validate([
        'new_password' => [
            'required', 
            'confirmed',
        ],
    ]);

    Auth::user()->update([
        'password' => Hash::make($request->new_password)
    ]);

    return back()->with('success', trans('site.supervisor.profile.password_updated'));
}

    public function profile()
    {
        return view('supervisor.profile');
    }
    public function permission()
    {
        return view('supervisor.permission');
    }
} 