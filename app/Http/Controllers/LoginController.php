<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class loginController extends Controller
{
    //login function mo login kwaon sa db
    public function login(){
        return view('login');
        
    }
    public function loginPost(Request $request): RedirectResponse{
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('home');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // public function loginPost(Request $request){
    //     $credentials = $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => ['required'],
    //     ]);
    //     if(Auth::attempt($credentials)){
    //         $request->session()->regenerate();
 
    //         return redirect()->intended('home');
    //     }
    //     return back()->with('error', 'Incorrect email and password');
    // }
}
