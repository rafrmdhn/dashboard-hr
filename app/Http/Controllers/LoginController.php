<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $intendedUrl = session()->pull('url.intended', '/fdashboard');
            return redirect()->intended($intendedUrl);
        }

        return back()->with('loginError', 'Login failed!');
    }

    public function logout()
    {
        session(['url.intended' => url()->previous()]);
        
        Auth::logout();

        session()->invalidate();
 
        session()->regenerateToken();
 
        return redirect('/flogin');
    }
}
