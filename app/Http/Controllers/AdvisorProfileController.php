<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdvisorProfileController extends Controller
{
    public function profile()
    {
        return view('advisor.advisor-profile');
    }

    public function edit(Request $request, $id)
    {
        $user = Auth::user();
        
        if ($user->id != $id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $validated = $request->validate([
            'fName' => 'required|string|max:255',
            'lName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'mobileNumber' => 'required|string|max:20',
        ]);

        $user->update($validated);

        return redirect()->route('advisor.profile')->with('success', __('site.advisor.profile.updated_successfully'));
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

        return back()->with('success', __('site.advisor.profile.password_updated'));
    }
}