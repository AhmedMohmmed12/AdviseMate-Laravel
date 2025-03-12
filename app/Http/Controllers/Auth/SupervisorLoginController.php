<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupervisorLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:supervisor')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.supervisor.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('supervisor')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('supervisor.dashboard'));
        }

        return back()->withErrors([
            'email' => __('site.supervisor.login.failed'),
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('supervisor')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('supervisor.login');
    }
} 