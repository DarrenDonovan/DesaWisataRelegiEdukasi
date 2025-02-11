<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function login(){ //sesuaikan nama function dengan yang dibuat pada route
        return view('login');
    }

    function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('admin');
        }

        return back()->withErrors([
            'email' => 'Login Invalid',
        ])->onlyInput('email');
    
    }
}
