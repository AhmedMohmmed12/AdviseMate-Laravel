<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentProfileController extends Controller
{
    public function profile()
    {
        return view('profile');
    }

    public function edit(Request $request, $id)
    {
        $student = Auth::guard('student')->user();
        
        if ($student->id != $id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $validated = $request->validate([
            'Fname' => 'required|string|max:255',
            'LName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students,email,' . $student->id,
            'phoneNumber' => 'required|string|max:20',
        ]);

        $student->update($validated);

        return redirect()->route('student.profile')->with('success', __('site.student.profile.updated_successfully'));
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'new_password' => [
                'required', 
                'confirmed',
            ],
        ]);

        Auth::guard('student')->user()->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', __('site.student.profile.password_updated'));
    }
} 